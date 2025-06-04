<?php
require_once '../App/Core/Router.php';
require_once '../App/Core/Session.php';

use App\Core\Router;
use App\Core\Session;

Session::start();


$url = $_GET['url'] ?? '';
$router = new Router();
$router->route($url);

