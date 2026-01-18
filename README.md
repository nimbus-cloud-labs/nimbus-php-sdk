# Nimbus PHP SDK

## Overview
The Nimbus PHP SDK provides generated service clients backed by a shared core runtime. Each service package is generated from Smithy models and depends on `nimbus-cloud/sdk-core`.

## Generate clients
Run the generator from the repository root:

```bash
node scripts/sdk/generate_php_sdk.mjs
```

To check that generated code is up to date:

```bash
./scripts/sdk/check_php_sdk.sh --check
```

## Quickstart
Install the core runtime and the service client (example: IAM):

```bash
composer require nimbus-cloud/sdk-core nimbus-cloud/iam-client
```

Create a client using environment credentials:

```php
<?php

declare(strict_types=1);

use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Iam\IamServiceClient;

$config = NimbusClient::builder()
    ->endpoint('https://api.nimbus.eu')
    ->build();

$client = IamServiceClient::fromConfig($config);
$tenants = $client->listTenants();
```

Environment variables follow the shared `NIMBUS_*` naming described in `docs/sdk/glossary.md`.

## Static access keys
Provide access key credentials directly when you do not want environment resolution:

```php
<?php

declare(strict_types=1);

use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\StaticKeyCredentialProvider;
use NimbusSdk\Iam\IamServiceClient;

$config = NimbusClient::builder()
    ->endpoint('https://api.nimbus.eu')
    ->withAuth(new StaticKeyCredentialProvider([
        'accessKey' => 'ZZYX1EXAMPLEKEY00001',
        'secretKey' => 'Zm9vYmFyLXNlY3JldC1leGFtcGxlLXN0cmluZw=='
    ]))
    ->build();

$client = IamServiceClient::fromConfig($config);
```

## Conformance checks
Run the PHP conformance suite locally:

```bash
php sdk/php/tests/conformance.php
```

## Packaging
Publish packages to the internal Composer registry after running the conformance checks and validating generated artifacts.
