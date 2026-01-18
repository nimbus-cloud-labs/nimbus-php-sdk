# Nimbus PHP SDK

Nimbus PHP SDK provides generated service clients and a shared core runtime. Packages mirror the Rust SDK surface and Smithy models.

## Install

```bash
composer require nimbus-cloud/sdk-core nimbus-cloud/iam-client
```

## Quickstart

```php
<?php

declare(strict_types=1);

use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\StaticTokenProvider;
use NimbusSdk\Iam\IamServiceClient;

$config = NimbusClient::builder()
    ->endpoint('https://api.nimbus.eu')
    ->withAuth(new StaticTokenProvider('token'))
    ->build();

$client = IamServiceClient::fromConfig($config);
$result = $client->emitToken([
    'urn' => 'urn:nimbus:iam::123',
    'typ' => 'access'
]);

var_dump($result['token']);
```

## Authentication
- **Environment provider (default):** Reads `NIMBUS_*` variables from the environment.
- **Static access keys:** Provide access/secret keys directly when you do not want environment resolution.

```php
<?php

declare(strict_types=1);

use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\StaticKeyCredentialProvider;

$config = NimbusClient::builder()
    ->endpoint('https://api.nimbus.eu')
    ->withAuth(new StaticKeyCredentialProvider([
        'accessKey' => 'ZZYX1EXAMPLEKEY00001',
        'secretKey' => 'Zm9vYmFyLXNlY3JldC1leGFtcGxlLXN0cmluZw=='
    ]))
    ->build();
```

## Pagination and LRO
Paginator helpers return iterators, and long-running operations expose `*AndWait` helpers.

## Development
- Regenerate clients with the bundled generator script.
- Run conformance checks with `php tests/conformance.php`.
