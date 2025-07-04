<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen p-8">
    
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="mb-3 p-4">
            <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text text-center">
                AjkerHisab <span class="text-6xl">৳</span>
            </h1>
        </div>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            <i class="fas fa-plus-circle mr-2"></i>Add New Expense
        </h2>
        
        <form method="post" action="index.php?route=expense-store" class="space-y-4">
            <div class="relative">
                <i class="fas fa-header absolute left-3 top-3 text-gray-400"></i>
                <input type="text" name="title" placeholder="Title" 
                    class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="relative">
                <!-- <i class="fas fa-list absolute left-3 top-3 text-gray-400"></i> -->
                <div class="relative">
                    <i class="fas fa-list absolute left-3 top-3 text-gray-400"></i>
                    <select name="category" class="border border-gray-300 rounded px-10 py-2 w-full">
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat) ?>" 
                                <?= isset($expense['category']) && $expense['category'] === $cat ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            
            <div class="relative">
                <i class="fas fa-dollar-sign absolute left-3 top-3 text-gray-400"></i>
                <input type="number" name="amount" placeholder="Amount" 
                    class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="relative">
                <i class="fas fa-calendar absolute left-3 top-3 text-gray-400"></i>
                <input type="date" name="date" 
                    class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" 
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                <i class="fas fa-save mr-2"></i>Save
            </button>
        </form>
        
        <a href="index.php?route=dashboard" 
            class="block mt-4 text-center text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>
</body>
</html>