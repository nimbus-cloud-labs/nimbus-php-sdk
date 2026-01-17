<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

use NimbusSdk\Compute\ComputeServiceClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationStatusClient;
use NimbusSdk\Core\ProblemDetailsError;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\StaticTokenProvider;
use NimbusSdk\Core\Transport;
use NimbusSdk\Core\TransportRequest;
use NimbusSdk\Core\TransportResponse;
use NimbusSdk\Iam\IamServiceClient;
use NimbusSdk\Core\NimbusClient;

final class AssertionFailed extends RuntimeException
{
}

function assertTrue(bool $condition, string $message): void
{
    if (!$condition) {
        throw new AssertionFailed($message);
    }
}

function assertSame(mixed $expected, mixed $actual, string $message): void
{
    if ($expected !== $actual) {
        throw new AssertionFailed(sprintf('%s (expected %s, got %s)', $message, var_export($expected, true), var_export($actual, true)));
    }
}

function assertInstanceOf(string $class, mixed $value, string $message): void
{
    if (!($value instanceof $class)) {
        throw new AssertionFailed($message);
    }
}

function buildConfig(MockBackend $backend, ?OperationStatusClient $lro = null): SdkConfig
{
    $builder = NimbusClient::builder()
        ->withTransport($backend)
        ->withAuth(new StaticTokenProvider('integration-token'));
    if ($lro !== null) {
        $builder->withLroClient($lro);
    }
    return $builder->build();
}

final class StubOperationStatusClient implements OperationStatusClient
{
    /** @var OperationHandle[] */
    private array $states;
    private int $index = 0;

    /** @param OperationHandle[] $states */
    public function __construct(array $states)
    {
        $this->states = $states;
    }

    public function poll(OperationHandle $handle): OperationHandle
    {
        $current = $this->states[min($this->index, count($this->states) - 1)] ?? $handle;
        $this->index += 1;
        return $current;
    }
}

final class MockBackend implements Transport
{
    /** @var array<int, array{method: string, path: string, headers: array<string, string>, body: mixed}> */
    public array $requests = [];

    /** @var array{networkCalls: int, lastIdempotencyKey: string|null} */
    public array $state = ['networkCalls' => 0, 'lastIdempotencyKey' => null];

    public function execute(TransportRequest $request): TransportResponse
    {
        $this->requests[] = [
            'method' => $request->method,
            'path' => $request->path,
            'headers' => $request->headers,
            'body' => $request->body
        ];

        if ($request->method === SdkHttpMethod::POST && $request->path === '/iam/assume-role') {
            return $this->respond(200, ['principal' => 'test-principal']);
        }

        if ($request->method === SdkHttpMethod::POST && $request->path === '/iam/token') {
            return new TransportResponse(
                429,
                ['content-type' => 'application/problem+json'],
                [
                    'type' => 'about:blank',
                    'title' => 'Rate limited',
                    'status' => 429,
                    'detail' => 'Too many requests'
                ]
            );
        }

        if ($request->method === SdkHttpMethod::GET && $request->path === '/networks') {
            $page = $this->state['networkCalls'];
            $this->state['networkCalls'] += 1;
            if ($page === 0) {
                return new TransportResponse(200, ['content-range' => 'cursor:page-two'], ['page' => 1]);
            }
            return new TransportResponse(206, [], ['page' => 2]);
        }

        if ($request->method === SdkHttpMethod::POST && $request->path === '/vms') {
            $this->state['lastIdempotencyKey'] = $request->headers['idempotency-key'] ?? null;
            return $this->respond(202, ['id' => 'op-123', 'status' => 'pending']);
        }

        throw new RuntimeException(sprintf('Unhandled request %s %s', $request->method, $request->path));
    }

    /** @return array<int, array{method: string, path: string, headers: array<string, string>, body: mixed}> */
    public function findRequests(string $path): array
    {
        return array_values(array_filter($this->requests, fn ($req) => $req['path'] === $path));
    }

    /** @return array{method: string, path: string, headers: array<string, string>, body: mixed} */
    public function findRequest(string $path): array
    {
        $matches = $this->findRequests($path);
        if (!$matches) {
            throw new RuntimeException(sprintf('No request found for %s', $path));
        }
        return $matches[0];
    }

    private function respond(int $status, array $body, array $headers = []): TransportResponse
    {
        return new TransportResponse($status, $headers, $body);
    }
}

function runConformanceSuite(): void
{
    $backend = new MockBackend();
    $iam = IamServiceClient::fromConfig(buildConfig($backend));
    $result = $iam->assumeRole(['role' => 'admin', 'session' => 'default']);
    assertSame(['principal' => 'test-principal'], $result, 'IAM assumeRole response should match');
    $assumeCall = $backend->findRequest('/iam/assume-role');
    assertSame('Bearer integration-token', $assumeCall['headers']['authorization'] ?? null, 'Auth header should be attached');

    $compute = ComputeServiceClient::fromConfig(buildConfig($backend));
    $pages = [];
    foreach ($compute->paginateListNetworks() as $page) {
        $pages[] = $page;
    }
    assertSame(2, count($pages), 'Paginator should return two pages');
    assertSame(['page' => 1], $pages[0], 'First network page should match');
    assertSame(['page' => 2], $pages[1], 'Second network page should match');
    $secondCall = $backend->findRequests('/networks')[1] ?? null;
    assertSame('cursor:page-two', $secondCall['headers']['range'] ?? null, 'Paginator should send cursor header');

    $poller = new StubOperationStatusClient([
        new OperationHandle('op-123', 'pending'),
        new OperationHandle('op-123', 'succeeded')
    ]);
    $computeWithLro = ComputeServiceClient::fromConfig(buildConfig($backend, $poller));
    $handle = $computeWithLro->createVmAndWait(['name' => 'vm-1']);
    assertSame('succeeded', $handle->status, 'LRO helper should wait for success');
    assertTrue($backend->state['lastIdempotencyKey'] !== null, 'Idempotency key should be sent for LRO');

    $captured = null;
    try {
        $iam->emitToken(['urn' => 'urn:test', 'typ' => 'jwt']);
    } catch (Throwable $error) {
        $captured = $error;
    }
    assertInstanceOf(ProblemDetailsError::class, $captured, 'ProblemDetailsError should be thrown');
    assertSame(429, $captured->problem()['status'] ?? null, 'Problem status should be surfaced');

    echo "PHP SDK conformance checks passed.\n";
}

runConformanceSuite();
