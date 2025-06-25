<?php 
use App\Core\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-3 p-4">
            <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text text-center">
                AjkerHisab <span class="text-6xl">৳</span>
            </h1>
        </div>
        <h2 class="text-2xl font-bold mb-4">Edit Expense</h2>
        <form action="index.php?route=expense-update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($expense['id']) ?>">

            <div class="mb-4">
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($expense['title']) ?>" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Amount</label>
                <input type="number" name="amount" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($expense['amount']) ?>" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Date</label>
                <input type="date" name="date" class="w-full border px-3 py-2 rounded" value="<?= htmlspecialchars($expense['date']) ?>" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Category</label>
                <select name="category" class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>" 
                            <?= isset($expense['category']) && $expense['category'] === $cat ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</body>
</html>
