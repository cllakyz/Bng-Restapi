<?php
define('URL', 'http://' . $_SERVER['SERVER_NAME']);

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Application;
use App\Controllers\HomeController;
use App\Controllers\StocksController;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
    ]
];

$app = new Application(__DIR__, $config);

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/api', [HomeController::class, 'index']);

$app->router->get('/api/v1/stocks', [StocksController::class, 'index']);
$app->router->post('/api/v1/stocks', [StocksController::class, 'store']);

$app->run();