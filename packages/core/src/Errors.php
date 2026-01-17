<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

class SdkError extends \RuntimeException
{
}

class AuthError extends SdkError
{
}

class InvalidPathError extends SdkError
{
    public function __construct(string $param)
    {
        parent::__construct(sprintf('Missing path parameter: %s.', $param));
    }
}

class UnexpectedStatusError extends SdkError
{
    public function __construct(string $operation, int $status)
    {
        parent::__construct(sprintf('Unexpected status for %s: %d.', $operation, $status));
    }
}

class ProblemDetailsError extends SdkError
{
    private array $problem;

    public function __construct(array $problem)
    {
        $this->problem = $problem;
        $title = $problem['title'] ?? 'Problem response';
        $detail = $problem['detail'] ?? '';
        $message = $detail ? sprintf('%s: %s', $title, $detail) : (string) $title;
        parent::__construct($message);
    }

    public function problem(): array
    {
        return $this->problem;
    }
}

class OperationTimeoutError extends SdkError
{
    public function __construct(string $operationId, int $attempts)
    {
        parent::__construct(sprintf('Operation %s timed out after %d attempts.', $operationId, $attempts));
    }
}
