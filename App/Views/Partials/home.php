<!-- <div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Welcome to AjkerHisab!</h2>
    <p>This is your dashboard overview. Use the menu to manage your expenses.</p>
</div>
 -->
<?php 
use App\Models\Expense;
require_once __DIR__ . '/../../../App/Models/Expense.php';

$expenseModel = new Expense();
$expenses = $expenseModel->getAll($_SESSION['user'] ?? '');
?>
 
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome to AjkerHisab 👋</h2>
    <p class="text-gray-600 mb-4">
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
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <div class="mt-4">
        <a href="index.php?route=expense-create" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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

    listViewBtn.addEventListener('click', () => {
        listViews.forEach(el => el.classList.remove('hidden'));
        gridViews.forEach(el => el.classList.add('hidden'));
    });

    gridViewBtn.addEventListener('click', () => {
        listViews.forEach(el => el.classList.add('hidden'));
        gridViews.forEach(el => el.classList.remove('hidden'));
    });
});
</script>


</body>
</html>