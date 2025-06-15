<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // ← autoload classes

use App\Core\Router;

$url = $_GET['route'] ?? '';

$router = new Router();
$router->route($url);
