<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class AdditionalSuccessResponseSpec
{
    public function __construct(public int $code, public bool $hasBody)
    {
    }
}

final class PaginationSpec
{
    public function __construct(public string $requestHeader, public string $responseHeader)
    {
    }
}

final class OperationSpec
{
    /** @param AdditionalSuccessResponseSpec[] $additionalSuccessResponses */
    public function __construct(
        public string $name,
        public string $method,
        public string $uri,
        public int $successCode,
        public array $additionalSuccessResponses,
        public bool $idempotent,
        public ?PaginationSpec $pagination,
        public bool $lro
    ) {
    }
}

final class OperationResult
{
    public function __construct(
        public int $status,
        public mixed $body,
        public ?string $nextCursor
    ) {
    }
}

final class SdkConfig
{
    public function __construct(
        public Transport $transport,
        public AuthTokenProvider $auth,
        public IdempotencyTokenProvider $idempotency,
        public OperationStatusClient $lro
    ) {
    }
}

final class BuildError extends \RuntimeException
{
}

final class SdkConfigBuilder
{
    private ?string $endpointUrl = null;
    private ?Transport $transport = null;
    private ?AuthTokenProvider $auth = null;
    private ?IdempotencyTokenProvider $idempotency = null;
    private ?OperationStatusClient $lro = null;
    private bool $envProviderDisabled = false;

    public function endpoint(string $url): self
    {
        $this->endpointUrl = $url;
        return $this;
    }

    public function withTransport(Transport $transport): self
    {
        $this->transport = $transport;
        return $this;
    }

    public function withAuth(AuthTokenProvider $provider): self
    {
        $this->auth = $provider;
        return $this;
    }

    public function withIdempotency(IdempotencyTokenProvider $provider): self
    {
        $this->idempotency = $provider;
        return $this;
    }

    public function withLroClient(OperationStatusClient $client): self
    {
        $this->lro = $client;
        return $this;
    }

    public function disableEnvProvider(bool $disable = true): self
    {
        $this->envProviderDisabled = $disable;
        return $this;
    }

    public function build(): SdkConfig
    {
        $auth = $this->auth ?? $this->buildDefaultAuthProvider();
        if (!$auth) {
            throw new BuildError('Auth provider is required.');
        }

        $transport = $this->transport ?? $this->buildTransport();
        if (!$transport) {
            throw new BuildError('Either endpoint or transport must be provided.');
        }

        return new SdkConfig(
            $transport,
            $auth,
            $this->idempotency ?? Idempotency::defaultProvider(),
            $this->lro ?? new NoopOperationStatusClient()
        );
    }

    private function buildTransport(): ?Transport
    {
        if ($this->endpointUrl === null) {
            return null;
        }
        return new CurlTransport($this->endpointUrl);
    }

    private function buildDefaultAuthProvider(): ?AuthTokenProvider
    {
        if ($this->envProviderDisabled) {
            return null;
        }
        return DefaultAuthChain::build();
    }
}

final class NimbusClient
{
    public function __construct(private SdkConfig $config)
    {
    }

    public static function builder(): SdkConfigBuilder
    {
        return new SdkConfigBuilder();
    }

    /** @param array<string, string> $pathParams */
    public function invoke(OperationSpec $spec, array $pathParams, mixed $body = null, ?string $cursor = null): OperationResult
    {
        $path = $this->renderPath($spec->uri, $pathParams);
        $headers = [];

        if ($spec->idempotent) {
            $headers['idempotency-key'] = $this->config->idempotency->nextToken();
        }

        if ($cursor !== null && $spec->pagination !== null) {
            $headers[strtolower($spec->pagination->requestHeader)] = $cursor;
        }

        $headers['authorization'] = $this->config->auth->authorizationHeader();

        $request = new TransportRequest(
            $spec->method,
            $path,
            $headers,
            $body
        );

        $response = $this->config->transport->execute($request);
        if (!$this->acceptedStatus($spec, $response->status)) {
            $problem = $this->asProblemDetails($response->body);
            if ($problem !== null) {
                throw new ProblemDetailsError($problem);
            }
            throw new UnexpectedStatusError($spec->name, $response->status);
        }

        $nextCursor = null;
        if ($spec->pagination !== null) {
            $header = strtolower($spec->pagination->responseHeader);
            $nextCursor = $response->headers[$header] ?? null;
        }

        return new OperationResult($response->status, $response->body, $nextCursor);
    }

    public function paginator(OperationSpec $spec, array $pathParams): Paginator
    {
        return new Paginator($this, $spec, $pathParams);
    }

    public function waiter(): LroWaiter
    {
        return new LroWaiter($this->config->lro);
    }

    public function deserialize(mixed $value): mixed
    {
        return $value;
    }

    /** @param array<string, string> $pathParams */
    private function renderPath(string $template, array $pathParams): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use ($pathParams): string {
            $raw = $matches[1];
            $greedy = str_starts_with($raw, '*');
            $key = $greedy ? substr($raw, 1) : $raw;
            if (!array_key_exists($key, $pathParams)) {
                throw new InvalidPathError($key);
            }
            $value = (string) $pathParams[$key];
            return $greedy ? $value : rawurlencode($value);
        }, $template);
    }

    private function acceptedStatus(OperationSpec $spec, int $status): bool
    {
        if ($spec->successCode === $status) {
            return true;
        }
        foreach ($spec->additionalSuccessResponses as $response) {
            if ($response->code === $status) {
                return true;
            }
        }
        return false;
    }

    private function asProblemDetails(mixed $value): ?array
    {
        if (!is_array($value)) {
            return null;
        }
        if (!isset($value['type'], $value['title'], $value['status'])) {
            return null;
        }
        if (!is_string($value['type']) || !is_string($value['title'])) {
            return null;
        }
        return $value;
    }
}
