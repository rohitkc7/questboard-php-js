<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Quest.php';
require_once __DIR__ . '/../app/controllers/QuestController.php';

use App\Core\Router;
use App\Core\Database;
use App\Models\Quest;
use App\Controllers\QuestController;

$config = require_once __DIR__ . '/../config/database.php';

$db = new Database($config);
$connection = $db->getConnection();

$questModel = new Quest($connection);
$questController = new QuestController($questModel);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($uri === false) {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $questController->store($_POST);
    exit;
}

$routes = require __DIR__ . '/../routes/web.php';

$router = new Router();
$success = isset($_GET['success']) && $_GET['success'] === '1';
$router->dispatch($uri, $method, $routes, [
    'controller' => $questController,
    'success' => $success
]);