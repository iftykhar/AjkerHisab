<?php
namespace App\Controllers;

use App\Models\Expense;
use App\Core\Session;
use Dompdf\Dompdf;

class ExpenseController
{
    private function loadCategories() {
        $categoryPath = __DIR__ . '/../../Storage/categories.json';
        $categories = [];

        
        if (file_exists($categoryPath)) {
            $categories = json_decode(file_get_contents($categoryPath), true);
        }

        
        $expensePath = __DIR__ . '/../Storage/expenses.json';
        if (file_exists($expensePath)) {
            $expenses = json_decode(file_get_contents($expensePath), true);
            foreach ($expenses as $exp) {
                if (!empty($exp['category']) && !in_array($exp['category'], $categories)) {
                    $categories[] = $exp['category'];
                }
            }
        }

        sort($categories);
        return $categories;
    }

    public function createForm()
    {
        $user = Session::get('user');

    
        $categories = $this->loadCategories();
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


    public function categoryReport() {
        $user = Session::get('user');
        $month = $_GET['month'] ?? '';
        $expenses = json_decode(file_get_contents(__DIR__ . '/../../Storage/expenses.json'), true);

        $filtered = array_filter($expenses, function ($exp) use ($user, $month) {
            $userMatch = $exp['user'] === $user;
            $monthMatch = $month ? (substr($exp['date'], 5, 2) === $month) : true;
            return $userMatch && $monthMatch;
        });

        $categoryData = [];
        foreach ($filtered as $exp) {
            $cat = $exp['category'] ?? 'Unknown';
            $amount = (float)$exp['amount'];
            if (!isset($categoryData[$cat])) {
                $categoryData[$cat] = 0;
            }
            $categoryData[$cat] += $amount;
        }

        require_once __DIR__ . '/../Views/reports/category_report.php';
    }


    public function exportCSV() {
        $user = Session::get('user');
        $expenses = json_decode(file_get_contents(__DIR__ . '/../../Storage/expenses.json'), true);
        $filtered = array_filter($expenses, fn($e) => $e['user'] === $user);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="expenses.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Date', 'Title', 'Category', 'Amount']);

        foreach ($filtered as $exp) {
            fputcsv($output, [$exp['date'], $exp['title'], $exp['category'], $exp['amount']]);
        }

        fclose($output);
        exit;
    }

    public function exportPDF() {
        $user = Session::get('user');
        $expenses = json_decode(file_get_contents(__DIR__ . '/../../Storage/expenses.json'), true);
        $filtered = array_filter($expenses, fn($e) => $e['user'] === $user);

        $html = "<h2 style='text-align:center;'>Expense Report</h2><table border='1' width='100%' style='border-collapse:collapse;'><tr><th>Date</th><th>Title</th><th>Category</th><th>Amount</th></tr>";

        foreach ($filtered as $exp) {
            $html .= "<tr><td>{$exp['date']}</td><td>{$exp['title']}</td><td>{$exp['category']}</td><td>৳{$exp['amount']}</td></tr>";
        }

        $html .= "</table>";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('expenses.pdf', ['Attachment' => 1]);
    }

    

    public function editForm() {
        $id = $_GET['id'] ?? null;
        $user = Session::get('user');
        $expenseModel = new Expense();
        $expenses = $expenseModel->getAll($user);

        foreach ($expenses as $e) {
            if ($e['id'] === $id) {
                $expense = $e;

                
                $categories = $this->loadCategories();

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

