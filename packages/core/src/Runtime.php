<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class Runtime
{
    public static function encodeBase64(string $value): string
    {
        return base64_encode($value);
    }

    public static function decodeBase64Json(string $value): array
    {
        $decoded = base64_decode($value, true);
        if ($decoded === false) {
            throw new SdkError('Invalid Base64 payload.');
        }
        $data = json_decode($decoded, true);
        if (!is_array($data)) {
            $reason = json_last_error_msg();
            throw new SdkError(sprintf('Invalid Base64 JSON payload: %s.', $reason));
        }
        return $data;
    }

    public static function randomUuid(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $hex = bin2hex($bytes);
        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12)
        );
    }
}
