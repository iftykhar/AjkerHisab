<?php
/*namespace App\Controllers;

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
    public function delete($id) {
        $expense = new Expense();
        $user = Session::get('user');

        // Get all expenses for the user
        $expenses = $expense->getAll($user);

        // Find the expense by ID
        $found = false;
        foreach ($expenses as $key => $item) {
            if ($item['id'] == $id) {
                $found = true;
                unset($expenses[$key]);
                break;
            }
        }

        if (!$found) {
            header('Location: index.php?route=expenses&error=notfound');
            return;
        }

        // Save the updated expenses back to storage
        $expense->saveAll($user, array_values($expenses));

        header('Location: index.php?route=expenses');
    }
}*/


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

    // public function delete()
    // {
    //     if (!isset($_GET['id'])) {
    //         header('Location: index.php?route=expenses&error=missing_id');
    //         return;
    //     }

    //     $id = $_GET['id'];
    //     $user = Session::get('user');

    //     $expenseModel = new Expense();
    //     $allExpenses = $expenseModel->getAllRaw(); // includes all users

    //     // Filter out the one to delete
    //     $updated = array_filter($allExpenses, function ($e) use ($id, $user) {
    //         return !($e['id'] == $id && $e['user'] == $user);
    //     });

    //     $expenseModel->saveAll(array_values($updated));

    //     header('Location: index.php?route=expenses');
    // }

    public function delete($id) {
        $user = Session::get('user');
        $expense = new Expense();
        $all = $expense->getAllData();

        $filtered = array_filter($all, fn($e) => !($e['id'] === $id && $e['user'] === $user));
        $expense->saveAll(array_values($filtered));

        header('Location: index.php?route=expenses');
    }

}

