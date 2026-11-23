
<?php

if (isset($_GET['__diagnostic'])) {
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode([
        'php_version' => PHP_VERSION,
        'autoload_exists' => file_exists(__DIR__ . '/../vendor/autoload.php'),
        'public_index_exists' => file_exists(__DIR__ . '/../public/index.php'),
        'bootstrap_exists' => file_exists(__DIR__ . '/../bootstrap/app.php'),
        'storage_exists' => is_dir(__DIR__ . '/../storage'),
        'storage_writable' => is_writable(__DIR__ . '/../storage'),
        'views_writable' => is_writable(__DIR__ . '/../storage/framework/views'),
        'cache_writable' => is_writable(__DIR__ . '/../bootstrap/cache'),
    ], JSON_PRETTY_PRINT);

    exit;
}

require __DIR__ . '/../public/index.php';