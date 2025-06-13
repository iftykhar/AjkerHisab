<?php
require_once '../App/Core/Router.php';
require_once '../App/Core/Session.php';
require_once '../App/Controllers/AuthControllers.php';
require_once '../App/Models/User.php';

use App\Core\Router;
use App\Core\Session;

Session::start();

$url = $_GET['url'] ?? 'login';

try {
    $router = new Router();
    $router->route($url);
} catch (Exception $e) {
    echo "Routing Error: " . $e->getMessage(); // Optional: show a custom error page
}
