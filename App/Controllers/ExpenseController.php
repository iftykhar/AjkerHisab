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
            // 'id' => uniqid(), // Unique ID for deletion
            // 'user' => Session::get('user'),
            // 'title' => $title,
            // 'amount' => $amount,
            // 'date' => $date,
            // 'category' => $category
            'user' => Session::get('user'),
            'title' => $title,
            'amount' => $amount,
            'date' => $date,
            'category' => $category
        ]);

        header('Location: index.php?route=expenses');
        exit();
    }

    // public function list()
    // {
    //     $expense = new Expense();
    //     $expenses = $expense->getAll(Session::get('user'));

    //     require_once __DIR__ . '/../Views/expenses/list.php';
    // }

    public function list() {
        $expense = new Expense();
        $expenses = $expense->getAll(Session::get('user'));

        $total = 0;
        $monthly = [];
        $categories = [];

        foreach ($expenses as $e) {
            $amount = (float)$e['amount'];
            $total += $amount;

            // Monthly breakdown
            $month = date('Y-m', strtotime($e['date']));
            $monthly[$month] = ($monthly[$month] ?? 0) + $amount;

            // Category breakdown
            $cat = $e['category'];
            $categories[$cat] = ($categories[$cat] ?? 0) + $amount;
        }

        arsort($categories);
        $topCategories = array_slice($categories, 0, 3, true);

        require_once __DIR__ . '/../Views/expenses/list.php';
    }

    

    public function editForm() {
        $id = $_GET['id'] ?? null;
        $user = Session::get('user');
        $expenseModel = new Expense();
        $expenses = $expenseModel->getAll($user);

        foreach ($expenses as $e) {
            if ($e['id'] === $id) {
                $expense = $e;
                require_once __DIR__ . '/../Views/expenses/edit.php';
                return;
            }
        }

        header('Location: index.php?route=expenses&error=notfound');
    }

    public function update() {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $date = $_POST['date'] ?? '';
        $category = $_POST['category'] ?? '';
        $user = Session::get('user');

        if (!$id || !$title || !$amount || !$date || !$category) {
            $error = "All fields are required.";
            require_once __DIR__ . '/../Views/expenses/edit.php';
            return;
        }

        $expenseModel = new Expense();
        $expenseModel->update($id, [
            'title' => $title,
            'amount' => $amount,
            'date' => $date,
            'category' => $category,
        ], $user);

        header('Location: index.php?route=expenses');
    }


    public function delete() {
        $id = $_POST['id'] ?? '';
        $user = Session::get('user');

        // var_dump($id);
        
        // exit;

        $expenseModel = new Expense();
        $allExpenses = json_decode(file_get_contents(__DIR__ . '/../../Storage/expenses.json'), true) ?? [];

        $updated = array_filter($allExpenses, function ($e) use ($id, $user) {
            return !($e['id'] === $id && $e['user'] === $user);
        });

        file_put_contents(__DIR__ . '/../../Storage/expenses.json', json_encode(array_values($updated), JSON_PRETTY_PRINT));
        header('Location: index.php?route=expenses');
    }


}

