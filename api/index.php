<?php

$runtimeRoot = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
    . DIRECTORY_SEPARATOR . 'laravel-' . substr(hash('sha256', dirname(__DIR__)), 0, 16);

$storagePath = $runtimeRoot . '/storage';
$cachePath = $runtimeRoot . '/bootstrap-cache';

$directories = [
    $storagePath . '/app/private',
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/framework/testing',
    $storagePath . '/logs',
    $cachePath,
];

foreach ($directories as $directory) {
    if (
        !is_dir($directory) &&
        !mkdir($directory, 0775, true) &&
        !is_dir($directory)
    ) {
        error_log('Cannot create Laravel runtime directory: ' . $directory);
        http_response_code(500);
        exit('Application runtime initialization failed.');
    }
}

$runtimeEnvironment = [
    'LARAVEL_STORAGE_PATH' => $storagePath,
    'APP_SERVICES_CACHE' => $cachePath . '/services.php',
    'APP_PACKAGES_CACHE' => $cachePath . '/packages.php',
    'APP_CONFIG_CACHE' => $cachePath . '/config.php',
    'APP_ROUTES_CACHE' => $cachePath . '/routes.php',
    'APP_EVENTS_CACHE' => $cachePath . '/events.php',
];

foreach ($runtimeEnvironment as $key => $value) {
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
    putenv($key . '=' . $value);
}

require __DIR__ . '/../public/index.php';