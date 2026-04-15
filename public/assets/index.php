<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../routes/web.php';

use App\Core\Router;

$router = new Router();
$routes = require_once __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $uri, $routes);