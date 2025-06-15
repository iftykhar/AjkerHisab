<?php
namespace App\Core;

use App\Controllers\AuthController;

class Router {
    public function handle($route) {
        $auth = new AuthController();

        switch ($route) {
            case '':
            case 'login':
                $_SERVER['REQUEST_METHOD'] === 'POST' ? $auth->login() : $auth->showLogin();
                break;
            case 'register':
                $_SERVER['REQUEST_METHOD'] === 'POST' ? $auth->register() : $auth->showRegister();
                break;
            case 'logout':
                $auth->logout();
                break;
            case 'dashboard':
                echo "Welcome to the dashboard, " . ($_SESSION['user'] ?? 'Guest') . "!";
                break;
            default:
                http_response_code(404);
                echo "404 - Page not found";
        }
    }
}
