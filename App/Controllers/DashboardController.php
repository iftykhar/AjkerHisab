<?php
namespace App\Controllers;

use App\Core\Session;

class DashboardController {

    public function index() {
        if (!Session::checkAuth()) {
            header('Location: index.php?route=login');
            exit;
        }

        $user = Session::get('user');

        // You can later fetch user expenses, summaries, etc.
        require_once __DIR__ . '/../Views/dashboard.php';
    }
}
