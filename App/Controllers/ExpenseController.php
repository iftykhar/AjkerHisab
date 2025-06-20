<?php
namespace App\Controllers;

use App\Models\Expense;
use App\Core\Session;

class ExpenseController
{
    public function createForm()
    {
        require_once __DIR__ . '/../Views/expenses/create.php';
    }

    public function store()
    {
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
            'id' => uniqid(), // Unique ID for deletion
            'user' => Session::get('user'),
            'title' => $title,
            'amount' => $amount,
            'date' => $date,
            'category' => $category
        ]);

        header('Location: index.php?route=expenses');
        exit();
    }

    public function list()
    {
        $expense = new Expense();
        $expenses = $expense->getAll(Session::get('user'));

        require_once __DIR__ . '/../Views/expenses/list.php';
    }

    

    // public function delete($id) {
    //     $user = Session::get('user');
    //     $expense = new Expense();
    //     $all = $expense->getAllData();

    //     $filtered = array_filter($all, fn($e) => !($e['id'] === $id && $e['user'] === $user));
    //     $expense->saveAll(array_values($filtered));

    //     header('Location: index.php?route=expenses');
    // }

    public function delete() {
        $id = $_POST['id'] ?? '';
        $user = Session::get('user');

        $expenseModel = new Expense();
        $allExpenses = json_decode(file_get_contents(__DIR__ . '/../../Storage/expenses.json'), true) ?? [];

        $updated = array_filter($allExpenses, function ($e) use ($id, $user) {
            return !($e['id'] === $id && $e['user'] === $user);
        });

        file_put_contents(__DIR__ . '/../../Storage/expenses.json', json_encode(array_values($updated), JSON_PRETTY_PRINT));
        header('Location: index.php?route=expenses');
    }


}

