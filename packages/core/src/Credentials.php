<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class EnvironmentCredentialProvider implements AuthTokenProvider
{
    private const PROFILE_ENV = 'NIMBUS_PROFILE';
    private const PROFILE_PREFIX = 'NIMBUS_PROFILE';
    private const GLOBAL_PREFIX = 'NIMBUS';
    private const ACCESS_KEY = 'ACCESS_KEY';
    private const SECRET_KEY = 'SECRET_KEY';
    private const REGION_KEY = 'REGION';
    private const SESSION_TOKEN_KEY = 'SESSION_TOKEN';
    private const ACCESS_KEY_REGEX = '/^[A-Z0-9]{20}$/';
    private const SECRET_KEY_REGEX = '/^[A-Za-z0-9_-]{44}$/';
    private const REGION_REGEX = '/^[a-z]+-[a-z]+-[0-9]{1,2}$/';

    /** @var array<string, string> */
    private array $env;

    /** @param array<string, string> $env */
    public function __construct(array $env = [])
    {
        $this->env = $env ?: array_filter($_ENV + $_SERVER, 'is_string');
    }

    public function authorizationHeader(): string
    {
        $scope = $this->resolveScope();
        $credentials = $this->loadCredentials($scope);
        if (!empty($credentials['sessionToken'])) {
            return sprintf('Bearer %s', $credentials['sessionToken']);
        }
        $raw = sprintf('%s:%s', $credentials['accessKey'], $credentials['secretKey']);
        return sprintf('Basic %s', Runtime::encodeBase64($raw));
    }

    private function resolveScope(): array
    {
        $profile = trim((string) ($this->env[self::PROFILE_ENV] ?? ''));
        if ($profile === '') {
            return ['type' => 'global'];
        }
        $normalized = strtoupper($profile);
        if (!preg_match('/^[A-Z0-9_]{1,16}$/', $normalized)) {
            throw new AuthError(sprintf('Profile "%s" is invalid. Expected 1-16 characters matching [A-Z0-9_].', $profile));
        }
        return ['type' => 'profile', 'profile' => $normalized];
    }

    private function loadCredentials(array $scope): array
    {
        $accessKey = $this->readRequired($scope, self::ACCESS_KEY, [self::class, 'validateAccessKey']);
        $secretKey = $this->readRequired($scope, self::SECRET_KEY, [self::class, 'validateSecretKey']);
        $region = $this->readRequired($scope, self::REGION_KEY, [self::class, 'validateRegion']);
        $sessionToken = $this->readOptionalSessionToken($scope);

        return [
            'accessKey' => $accessKey,
            'secretKey' => $secretKey,
            'region' => $region,
            'sessionToken' => $sessionToken
        ];
    }

    private function readRequired(array $scope, string $suffix, callable $validator): string
    {
        $candidates = $this->candidateKeys($scope, $suffix);
        foreach ($candidates as $key) {
            $value = trim((string) ($this->env[$key] ?? ''));
            if ($value === '') {
                continue;
            }
            try {
                $validator($value);
            } catch (\Throwable $error) {
                $reason = $error instanceof \Throwable ? $error->getMessage() : 'invalid value';
                throw new AuthError(sprintf('Environment variable %s is invalid: %s', $key, $reason));
            }
            return $value;
        }
        throw new AuthError(sprintf('Missing environment variable. Expected one of: %s', implode(', ', $candidates)));
    }

    private function readOptionalSessionToken(array $scope): ?string
    {
        $candidates = $this->candidateKeys($scope, self::SESSION_TOKEN_KEY);
        foreach ($candidates as $key) {
            $value = trim((string) ($this->env[$key] ?? ''));
            if ($value === '') {
                continue;
            }
            if (strlen($value) > 512) {
                throw new AuthError(sprintf('Environment variable %s exceeds 512 characters.', $key));
            }
            try {
                Runtime::decodeBase64Json($value);
            } catch (SdkError $error) {
                throw new AuthError(sprintf('Environment variable %s must be Base64-encoded JSON (%s).', $key, $error->getMessage()));
            }
            return $value;
        }
        return null;
    }

    /** @return string[] */
    private function candidateKeys(array $scope, string $suffix): array
    {
        $keys = [];
        if (($scope['type'] ?? '') === 'profile' && !empty($scope['profile'])) {
            $keys[] = sprintf('%s_%s_%s', self::PROFILE_PREFIX, $scope['profile'], $suffix);
        }
        $keys[] = sprintf('%s_%s', self::GLOBAL_PREFIX, $suffix);
        return $keys;
    }

    private static function validateAccessKey(string $value): void
    {
        if (!preg_match(self::ACCESS_KEY_REGEX, $value)) {
            throw new \InvalidArgumentException('Must be 20 uppercase alphanumeric characters.');
        }
    }

    private static function validateSecretKey(string $value): void
    {
        if (!preg_match(self::SECRET_KEY_REGEX, $value)) {
            throw new \InvalidArgumentException('Must be a 44-character URL-safe Base64 string without padding.');
        }
    }

    private static function validateRegion(string $value): void
    {
        if (!preg_match(self::REGION_REGEX, $value)) {
            throw new \InvalidArgumentException('Must match <prefix>-<segment>-<digits> (e.g., eu-north-2).');
        }
    }
}

final class StaticKeyCredentials
{
    private const ACCESS_KEY_REGEX = '/^[A-Z0-9]{20}$/';
    private const SECRET_KEY_REGEX = '/^[A-Za-z0-9_-]{44}$/';

    public function __construct(
        public readonly string $accessKey,
        public readonly string $secretKey,
        public readonly ?string $sessionToken = null
    ) {
        self::validateAccessKey($this->accessKey);
        self::validateSecretKey($this->secretKey);
        if ($this->sessionToken !== null) {
            self::validateSessionToken($this->sessionToken);
        }
    }

    /** @param array{accessKey: string, secretKey: string, sessionToken?: string} $config */
    public static function fromArray(array $config): self
    {
        return new self(
            (string) ($config['accessKey'] ?? ''),
            (string) ($config['secretKey'] ?? ''),
            isset($config['sessionToken']) ? (string) $config['sessionToken'] : null
        );
    }

    private static function validateAccessKey(string $value): void
    {
        if (!preg_match(self::ACCESS_KEY_REGEX, $value)) {
            throw new AuthError('Access key must be 20 uppercase alphanumeric characters.');
        }
    }

    private static function validateSecretKey(string $value): void
    {
        if (!preg_match(self::SECRET_KEY_REGEX, $value)) {
            throw new AuthError('Secret key must be a 44-character URL-safe Base64 string without padding.');
        }
    }

    private static function validateSessionToken(string $value): void
    {
        if (strlen($value) > 512) {
            throw new AuthError('Session token exceeds 512 characters.');
        }
        try {
            Runtime::decodeBase64Json($value);
        } catch (SdkError $error) {
            throw new AuthError(sprintf('Session token must be Base64-encoded JSON (%s).', $error->getMessage()));
        }
    }
}

final class StaticKeyCredentialProvider implements AuthTokenProvider
{
    private StaticKeyCredentials $credentials;

    public function __construct(StaticKeyCredentials|array $credentials)
    {
        $this->credentials = $credentials instanceof StaticKeyCredentials
            ? $credentials
            : StaticKeyCredentials::fromArray($credentials);
    }

    /** @param array{accessKey: string, secretKey: string, sessionToken?: string} $config */
    public static function fromArray(array $config): self
    {
        return new self(StaticKeyCredentials::fromArray($config));
    }

    public function authorizationHeader(): string
    {
        if ($this->credentials->sessionToken !== null && $this->credentials->sessionToken !== '') {
            return sprintf('Bearer %s', $this->credentials->sessionToken);
        }
        $raw = sprintf('%s:%s', $this->credentials->accessKey, $this->credentials->secretKey);
        return sprintf('Basic %s', Runtime::encodeBase64($raw));
    }
}
