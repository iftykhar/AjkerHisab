<?php
namespace App\Core;

use App\Controllers\AuthController;

class Router {
    public function route($url) {
        $auth = new AuthController();

        switch ($url) {
            case '':
            case 'login':
                $auth->showLoginForm();
                break;
            case 'register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $auth->register();
                } else {
                    $auth->showRegisterForm();
                }
                break;
            case 'do-login':
                $auth->login();
                break;
            case 'logout':
                $auth->logout();
                break;
            case 'dashboard':
                // echo "Dashboard here";
                require_once __DIR__ . '/../Views/dashboard.php';
                break;
    
            default:
                http_response_code(404);
                echo "404 Not Found";
        }
    }
}
