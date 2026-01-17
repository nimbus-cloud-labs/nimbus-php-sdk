<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

interface AuthTokenProvider
{
    public function authorizationHeader(): string;
}

final class StaticTokenProvider implements AuthTokenProvider
{
    public function __construct(private string $token)
    {
    }

    public function authorizationHeader(): string
    {
        if ($this->token === '') {
            throw new AuthError('Static token is empty.');
        }
        return sprintf('Bearer %s', $this->token);
    }
}

final class AuthProviderChain implements AuthTokenProvider
{
    /** @var AuthTokenProvider[] */
    private array $providers;

    /** @param AuthTokenProvider[] $providers */
    public function __construct(array $providers)
    {
        if (!$providers) {
            throw new AuthError('At least one auth provider must be configured.');
        }
        $this->providers = array_values($providers);
    }

    public function authorizationHeader(): string
    {
        $lastError = null;
        foreach ($this->providers as $provider) {
            try {
                return $provider->authorizationHeader();
            } catch (\Throwable $error) {
                $lastError = $error;
            }
        }
        if ($lastError instanceof AuthError) {
            throw $lastError;
        }
        throw new AuthError('No authentication providers were able to supply credentials.');
    }
}

final class DefaultAuthChain
{
    public static function build(bool $disableEnvProvider = false): AuthTokenProvider
    {
        $providers = [];
        if (!$disableEnvProvider) {
            $providers[] = new EnvironmentCredentialProvider();
        }
        if (!$providers) {
            throw new AuthError('No authentication providers have been configured.');
        }
        if (count($providers) === 1) {
            return $providers[0];
        }
        return new AuthProviderChain($providers);
    }
}
