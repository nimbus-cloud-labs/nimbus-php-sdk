<?php

declare(strict_types=1);

$baseDir = __DIR__ . '/packages';

$coreFiles = [
    $baseDir . '/core/src/Auth.php',
    $baseDir . '/core/src/Client.php',
    $baseDir . '/core/src/Credentials.php',
    $baseDir . '/core/src/Errors.php',
    $baseDir . '/core/src/Idempotency.php',
    $baseDir . '/core/src/Lro.php',
    $baseDir . '/core/src/Paginator.php',
    $baseDir . '/core/src/Runtime.php',
    $baseDir . '/core/src/Transport.php'
];

foreach ($coreFiles as $file) {
    if (is_file($file)) {
        require_once $file;
    }
}

$prefixes = [
    'NimbusSdk\\Core\\' => $baseDir . '/core/src/',
    'NimbusSdk\\Iam\\' => $baseDir . '/iam/src/',
    'NimbusSdk\\Compute\\' => $baseDir . '/compute/src/',
    'NimbusSdk\\Dam\\' => $baseDir . '/dam/src/',
    'NimbusSdk\\Dns\\' => $baseDir . '/dns/src/',
    'NimbusSdk\\LoadBalancer\\' => $baseDir . '/loadbalancer/src/'
];

spl_autoload_register(function (string $class) use ($prefixes): void {
    foreach ($prefixes as $prefix => $dir) {
        if (str_starts_with($class, $prefix)) {
            $relative = substr($class, strlen($prefix));
            $path = $dir . str_replace('\\', '/', $relative) . '.php';
            if (is_file($path)) {
                require $path;
            }
            return;
        }
    }
});
