<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class SdkHttpMethod
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const PATCH = 'PATCH';
}

final class TransportRequest
{
    /** @param array<string, string> $headers */
    public function __construct(
        public string $method,
        public string $path,
        public array $headers = [],
        public mixed $body = null
    ) {
    }
}

final class TransportResponse
{
    /** @param array<string, string> $headers */
    public function __construct(
        public int $status,
        public array $headers,
        public mixed $body
    ) {
    }
}

interface Transport
{
    public function execute(TransportRequest $request): TransportResponse;
}

final class CurlTransport implements Transport
{
    public function __construct(private string $baseUrl, private int $timeoutSeconds = 30)
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function execute(TransportRequest $request): TransportResponse
    {
        $url = $this->baseUrl . $request->path;
        $handle = curl_init($url);
        if ($handle === false) {
            throw new SdkError('Unable to initialize HTTP transport.');
        }

        $headers = [];
        foreach ($request->headers as $name => $value) {
            $headers[] = sprintf('%s: %s', $name, $value);
        }

        $body = null;
        if ($request->body !== null) {
            $body = json_encode($request->body);
            if ($body === false) {
                throw new SdkError(sprintf('Failed to encode request body: %s.', json_last_error_msg()));
            }
            $headers[] = 'Content-Type: application/json';
        }
        $headers[] = 'Accept: application/json';

        $responseHeaders = [];
        curl_setopt_array($handle, [
            CURLOPT_CUSTOMREQUEST => $request->method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeoutSeconds,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADERFUNCTION => function ($curl, $header) use (&$responseHeaders) {
                $len = strlen($header);
                $header = trim($header);
                if ($header === '' || strpos($header, ':') === false) {
                    return $len;
                }
                [$name, $value] = explode(':', $header, 2);
                $responseHeaders[strtolower(trim($name))] = trim($value);
                return $len;
            }
        ]);

        if ($body !== null) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, $body);
        }

        $rawBody = curl_exec($handle);
        if ($rawBody === false) {
            $error = curl_error($handle);
            curl_close($handle);
            throw new SdkError(sprintf('Transport error: %s.', $error));
        }

        $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $parsedBody = $this->parseBody($rawBody, $responseHeaders['content-type'] ?? null);

        return new TransportResponse($status, $responseHeaders, $parsedBody);
    }

    private function parseBody(string $body, ?string $contentType): mixed
    {
        if ($body === '') {
            return null;
        }
        $isJson = $contentType && stripos($contentType, 'application/json') !== false;
        if ($isJson) {
            $decoded = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }
        return $body;
    }
}
