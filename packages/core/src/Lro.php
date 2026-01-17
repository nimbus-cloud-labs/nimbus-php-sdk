<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class OperationStatus
{
    public const PENDING = 'pending';
    public const SUCCEEDED = 'succeeded';
    public const FAILED = 'failed';
}

final class OperationHandle
{
    public function __construct(
        public string $id,
        public string $status,
        public ?array $metadata = null,
        public ?array $error = null
    ) {
    }

    public static function fromArray(array $payload): self
    {
        return new self(
            (string) ($payload['id'] ?? ''),
            (string) ($payload['status'] ?? OperationStatus::PENDING),
            isset($payload['metadata']) && is_array($payload['metadata']) ? $payload['metadata'] : null,
            isset($payload['error']) && is_array($payload['error']) ? $payload['error'] : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'metadata' => $this->metadata,
            'error' => $this->error
        ];
    }
}

interface OperationStatusClient
{
    public function poll(OperationHandle $handle): OperationHandle;
}

final class NoopOperationStatusClient implements OperationStatusClient
{
    public function poll(OperationHandle $handle): OperationHandle
    {
        return $handle;
    }
}

final class LroWaiter
{
    public function __construct(
        private OperationStatusClient $poller,
        private int $intervalMs = 2000,
        private int $maxAttempts = 30
    ) {
    }

    public function withBackoff(int $intervalMs, int $maxAttempts): self
    {
        return new self($this->poller, $intervalMs, $maxAttempts);
    }

    public function wait(OperationHandle $handle): OperationHandle
    {
        for ($attempt = 0; $attempt < $this->maxAttempts; $attempt += 1) {
            $next = $this->poller->poll($handle);
            if ($next->status !== OperationStatus::PENDING) {
                return $next;
            }
            usleep($this->intervalMs * 1000);
        }
        throw new OperationTimeoutError($handle->id, $this->maxAttempts);
    }
}
