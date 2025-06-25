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

        // Load categories.json
        $categoryPath = __DIR__ . '/../../Storage/categories.json';
        $categories = [];

        if (file_exists($categoryPath)) {
            $categories = json_decode(file_get_contents($categoryPath), true);
        }

        // Hybrid: also extract categories from expenses.json
        $expensePath = __DIR__ . '/../Storage/expenses.json';
        if (file_exists($expensePath)) {
            $expenses = json_decode(file_get_contents($expensePath), true);
            foreach ($expenses as $exp) {
                if (!empty($exp['category']) && !in_array($exp['category'], $categories)) {
                    $categories[] = $exp['category'];
                }
            }
        }

        // Sort alphabetically (optional)
        sort($categories);

        // Make $categories available in the view
        require_once __DIR__ . '/../Views/dashboard.php';
    }

    public function error() {
        require_once __DIR__ . '/../Views/error.php';
    }
}
