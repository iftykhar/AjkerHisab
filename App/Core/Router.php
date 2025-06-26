<?php
namespace App\Core;

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ExpenseController;
use App\Controllers\CategoryController;

class Router {
    public function route($url) {
        $auth = new AuthController();
        $dashboard = new DashboardController();
        $expense = new ExpenseController();
        $cat = new CategoryController();

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
            case str_starts_with($url, 'ajax-'):
                $partial = substr($url, 5);
                require_once __DIR__ . "/../Views/Partials/{$partial}.php";
                break;
            case 'expense-delete':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $expense->delete();
                }
                break;
            case 'expense-edit':
                $expense->editForm();
                break;
            case 'expense-update':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $expense->update();
                }
                break;
            case 'expense-category-report':
                $expense->categoryReport();
                break;
            case 'export-csv':
                $expense->exportCSV();
                break;
            case 'export-pdf':
                $expense->exportPDF();
                break;
            case 'categories':
                $cat->index();
                break;
            case 'category-store':
                $cat->store();
                break;
            case 'profile':
                $auth->profile();
                break;

            case 'profile-update':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $auth->updateProfile();
                }
                break;

            default:
                http_response_code(404);
                // echo "404 Not Found";
                $dashboard->error();
        }
    }
}
