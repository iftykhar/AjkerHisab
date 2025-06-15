<?php
session_start();

require_once __DIR__ . '../App/Core/Router.php';
require_once __DIR__ . '../App/Controllers/AuthController.php';
require_once __DIR__ . '../App/Models/User.php';

use App\Core\Router;

$route = $_GET['route'] ?? '';
$router = new Router();
$router->handle($route);
