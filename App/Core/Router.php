<?php
namespace App\Core;

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ExpenseController;

class Router {
    public function route($url) {
        $auth = new AuthController();
        $dashboard = new DashboardController();
        $expense = new ExpenseController();

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
                $dashboard->index();
                break;
            case 'expenses':
                $expense->list();
                break;
            case 'expense-create':
                $expense->createForm();
                break;
            case 'expense-store':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $expense->store();
                }
                break;
            default:
                http_response_code(404);
                echo "404 Not Found";
        }
    }
}
