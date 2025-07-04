<?php 

use App\Core\Session;
require_once '../App/Core/Session.php';

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
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="w-full sm:w-auto text-center sm:text-left"></div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center sm:justify-start">
                    <i class="fas fa-receipt mr-2"></i> <?php echo htmlspecialchars(Session::get('user')); ?> Expenses
                </h2>
            </div>
            <div class="w-full sm:w-auto text-center">
                <h1 class="text-4xl sm:text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text">
                    AjkerHisab <span class="text-6xl sm:text-6xl md:text-7xl">৳</span>
                </h1>
            </div>
        <!-- </div> -->
        
        
        <div class="mb-4 flex justify-end space-x-2">
            <button id="listViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
            <i class="fas fa-list"></i> List
            </button>
            <button id="gridViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
            <i class="fas fa-th-large"></i> Grid
            </button>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-chart-pie text-blue-500"></i> Expense Summary
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div class="bg-blue-100 text-blue-800 p-4 rounded-lg text-center shadow-sm">
                    <p class="text-sm font-medium">Total Spent</p>
                    <p class="text-2xl font-bold">৳<?= isset($total) ? number_format($total, 2) : '0.00' ?></p>
                </div>

                <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-sm">
                    <p class="text-sm font-medium mb-2 text-center">Top 3 Categories</p>
                    <ul class="text-sm space-y-1">
                        <?php if (isset($topCategories) && is_array($topCategories)): ?>
                            <?php foreach ($topCategories as $cat => $amt): ?>
                                <li class="flex justify-between border-b pb-1">
                                    <span><?= htmlspecialchars($cat) ?></span>
                                    <span class="font-semibold">৳<?= number_format($amt, 2) ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-600">No categories found.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="space-y-3">
            <?php foreach ($expenses as $index => $exp): ?>
            <div class="expense-item mb-4">
                <!-- List View (Mobile First) -->
                <div class="listView">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
                    <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-gray-500 mr-3"></i>
                    <span><?= htmlspecialchars($exp['date']) ?></span>
                    <i class="fas fa-heading mx-3 text-gray-400"></i>
                    <span><?= htmlspecialchars($exp['title']) ?></span>
                    <i class="fas fa-list mx-3 text-gray-400"></i>
                    <span><?= htmlspecialchars($exp['category']) ?></span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-green-600">৳<?= htmlspecialchars($exp['amount']) ?></span>
                        <!-- Edit Button -->
                        <a href="index.php?route=expense-edit&id=<?= htmlspecialchars($exp['id'] ?? '') ?>" 
                        class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="index.php?route=expense-delete" method="POST" onsubmit="return confirm('Delete this expense?')">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($exp['id'] ?? '') ?>">
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="gridView hidden grid grid-cols-2 gap-4">
                <!-- Grid View (Mobile First) -->
                <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 items-center ">
                    <div class="space-y-2">
                        <div><i class="fas fa-calendar-alt mr-2"></i><?= htmlspecialchars($exp['date']) ?></div>
                        <div><i class="fas fa-heading mr-2"></i><?= htmlspecialchars($exp['title']) ?></div>
                        <div><i class="fas fa-list mr-2"></i><?= htmlspecialchars($exp['category']) ?></div>
                        <div class="font-bold text-green-600">৳<?= htmlspecialchars($exp['amount']) ?></div>
                    </div>
                    <div class="">
                        <!-- <a href="index.php?route=expense-edit&id=<?= htmlspecialchars($exp['id']) ?>" class="text-blue-500 hover:text-blue-700 mr-3"> -->
                        <a href="index.php?route=expense-edit&id=<?= htmlspecialchars($exp['id'] ?? '') ?>" class="text-blue-500 hover:text-blue-700 mr-3"><i class="fas fa-edit"></i></a>
                        <?php var_dump($exp['id'] ?? 'no-id'); ?>

                    </div>
                    <div class="flex items-center gap-3">
                  
                    <!-- Delete button -->
                    <form action="index.php?route=expense-delete" method="POST" onsubmit="return confirm('Delete this expense?')">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($exp['id'] ?? '') ?>">
                        <?php var_dump($exp['id'] ?? 'no-id'); ?>

                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-white p-4 mt-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Monthly Spending Chart</h3>
            <canvas id="monthlyChart" height="150"></canvas>
        </div>

        <a href="index.php?route=dashboard" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-150">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Dashboard
        </a>
        </div>

    <script>
        const listViewBtn = document.getElementById('listViewBtn');
        const gridViewBtn = document.getElementById('gridViewBtn');
        
        listViewBtn.addEventListener('click', function() {
        document.querySelectorAll('.listView').forEach(view => view.classList.remove('hidden'));
        document.querySelectorAll('.gridView').forEach(view => view.classList.add('hidden'));
        });

        gridViewBtn.addEventListener('click', function() {
        document.querySelectorAll('.listView').forEach(view => view.classList.add('hidden'));
        document.querySelectorAll('.gridView').forEach(view => view.classList.remove('hidden'));
        });
    </script>
    <script>
        const monthlyData = <?= json_encode($monthly) ?>;

        const labels = Object.keys(monthlyData);
        const values = Object.values(monthlyData);

        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '৳ Spent',
                    data: values,
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Monthly Expenses'
                    }
                }
            }
        });
    </script>


</body>
</html>