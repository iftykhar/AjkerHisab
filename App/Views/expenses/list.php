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
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
            <i class="fas fa-receipt mr-2"></i> <?php echo htmlspecialchars(Session::get('user')); ?> Expenses
        </h2>
        
        <div class="mb-4 flex justify-end space-x-2">
            <button id="listViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
            <i class="fas fa-list"></i> List
            </button>
            <button id="gridViewBtn" class="px-3 py-1 bg-gray-200 rounded-lg">
            <i class="fas fa-th-large"></i> Grid
            </button>
        </div>

        <div class="space-y-3">
            <?php foreach ($expenses as $index => $exp): ?>
            <div class="expense-item mb-4">
                <div class="listView">
                <!-- List View -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
                    <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-gray-500 mr-3"></i>
                    <span><?= htmlspecialchars($exp['date']) ?></span>
                    <i class="fas fa-header mx-3 text-gray-400"></i>
                    <span><?= htmlspecialchars($exp['title']) ?></span>
                    <i class="fas fa-list mx-3 text-gray-400"></i>
                    <span><?= htmlspecialchars($exp['category']) ?></span>
                    </div>
                    <span class="font-bold text-green-600">৳<?= htmlspecialchars($exp['amount']) ?></span>
                </div>
                </div>
                <div class="gridView hidden grid grid-cols-2 gap-4">
                <!-- Grid View -->
                <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 items-center ">
                    <div class="space-y-2">
                    <div><i class="fas fa-calendar-alt mr-2"></i><?= htmlspecialchars($exp['date']) ?></div>
                    <div><i class="fas fa-header mr-2"></i><?= htmlspecialchars($exp['title']) ?></div>
                    <div><i class="fas fa-list mr-2"></i><?= htmlspecialchars($exp['category']) ?></div>
                    <div class="font-bold text-green-600">৳<?= htmlspecialchars($exp['amount']) ?></div>
                    </div>
                    <div class="flex items-center gap-3">
                  
                    <!-- Delete button -->
                    <form action="index.php?route=expense-delete" method="POST" onsubmit="return confirm('Delete this expense?')">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($exp['id'] ?? '') ?>">
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

</body>
</html>