<?php
namespace App\Controllers;

use App\Models\Expense;
use App\Core\Session;

class ExpenseController {

    public function createForm() {
        require_once __DIR__ . '/../Views/expenses/create.php';
    }

    public function store() {
        $title = $_POST['title'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $date = $_POST['date'] ?? '';
        $category = $_POST['category'] ?? '';

        if (!$title || !$amount || !$date || !$category) {
            $error = "All fields are required.";
            require_once __DIR__ . '/../Views/expenses/create.php';
            return;
        }

        $expense = new Expense();
        $expense->save([
            'user' => Session::get('user'),
            'title' => $title,
            'amount' => $amount,
            'date' => $date,
            'category' => $category
        ]);

        header('Location: index.php?route=expenses');
    }

    public function list() {
        $expense = new Expense();
        $expenses = $expense->getAll(Session::get('user'));

        require_once __DIR__ . '/../Views/expenses/list.php';
    }
}
