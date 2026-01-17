<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

interface IdempotencyTokenProvider
{
    public function nextToken(): string;
}

final class DefaultIdempotencyTokenProvider implements IdempotencyTokenProvider
{
    public function nextToken(): string
    {
        return Runtime::randomUuid();
    }
}

final class Idempotency
{
    public static function defaultProvider(): IdempotencyTokenProvider
    {
        return new DefaultIdempotencyTokenProvider();
    }
}
