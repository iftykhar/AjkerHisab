
<?php 
use App\Models\Expense;
require_once __DIR__ . '/../../../App/Models/Expense.php';

$expenseModel = new Expense();
$expenses = $expenseModel->getAll($_SESSION['user'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-2 sm:p-8">
<div class="p-4 sm:p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Welcome to AjkerHisab 👋</h2>
    <p class="text-gray-600 mb-4 text-sm sm:text-base">
        Track your daily expenses easily and stay on top of your finances.
    </p>

    <!-- <div class="mb-4 flex justify-end space-x-2">
        <button id="listViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
        <i class="fas fa-list"></i> List
        </button>
        <button id="gridViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
        <i class="fas fa-th-large"></i> Grid
        </button>
    </div> -->

    <div class="space-y-3">
        <?php foreach ($expenses as $index => $exp): ?>
        <div class="expense-item mb-4">
            <div class="listView">
            <!-- List View -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 sm:p-4 bg-gray-50 rounded-lg hover:bg-gray-100 gap-2 sm:gap-0">
                <div class="flex flex-col sm:flex-row items-start sm:items-center w-full sm:w-auto">
                    <span class="flex items-center text-gray-500 text-sm sm:text-base mb-1 sm:mb-0">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <?= htmlspecialchars($exp['date']) ?>
                    </span>
                    <span class="hidden sm:inline mx-3 text-gray-400"><i class="fas fa-header"></i></span>
                    <span class="flex items-center text-gray-700 text-sm sm:text-base mb-1 sm:mb-0 sm:ml-3">
                        <i class="fas fa-header mr-2 sm:mr-2"></i>
                        <?= htmlspecialchars($exp['title']) ?>
                    </span>
                    <span class="hidden sm:inline mx-3 text-gray-400"><i class="fas fa-list"></i></span>
                    <span class="flex items-center text-gray-700 text-sm sm:text-base sm:ml-3">
                        <i class="fas fa-list mr-2 sm:mr-2"></i>
                        <?= htmlspecialchars($exp['category']) ?>
                    </span>
                </div>
                <span class="font-bold text-green-600 text-base sm:text-lg mt-2 sm:mt-0">৳<?= htmlspecialchars($exp['amount']) ?></span>
            </div>
            </div>
            <div class="gridView hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Grid View -->
            <div class="p-3 sm:p-4 bg-gray-50 rounded-lg hover:bg-gray-100 flex flex-col items-start">
                <div class="space-y-2 w-full">
                    <div class="flex items-center text-gray-500 text-sm sm:text-base">
                        <i class="fas fa-calendar-alt mr-2"></i><?= htmlspecialchars($exp['date']) ?>
                    </div>
                    <div class="flex items-center text-gray-700 text-sm sm:text-base">
                        <i class="fas fa-header mr-2"></i><?= htmlspecialchars($exp['title']) ?>
                    </div>
                    <div class="flex items-center text-gray-700 text-sm sm:text-base">
                        <i class="fas fa-list mr-2"></i><?= htmlspecialchars($exp['category']) ?>
                    </div>
                    <div class="font-bold text-green-600 text-base sm:text-lg">৳<?= htmlspecialchars($exp['amount']) ?></div>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-4"></div></div>
        <a href="index.php?route=expense-create" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm sm:text-base sm:py-2 sm:m-2">
            + Add New Expense
        </a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const listViewBtn = document.getElementById('listViewBtn');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const listViews = document.querySelectorAll('.listView');
    const gridViews = document.querySelectorAll('.gridView');

    if(listViewBtn && gridViewBtn){
        listViewBtn.addEventListener('click', () => {
            listViews.forEach(el => el.classList.remove('hidden'));
            gridViews.forEach(el => el.classList.add('hidden'));
        });

        gridViewBtn.addEventListener('click', () => {
            listViews.forEach(el => el.classList.add('hidden'));
            gridViews.forEach(el => el.classList.remove('hidden'));
        });
    }
});
</script>
</body>
</html>