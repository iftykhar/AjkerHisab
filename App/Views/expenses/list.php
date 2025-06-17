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
        
        <div class="space-y-3">
            <?php foreach ($expenses as $exp): ?>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-gray-500 mr-3"></i>
                        <span class="text-gray-600"><?= htmlspecialchars($exp['date']) ?></span>
                        <i class="fas fa-arrow-right mx-3 text-gray-400"></i>
                        <span class="font-medium"><?= htmlspecialchars($exp['title']) ?></span>
                    </div>
                    <span class="font-bold text-green-600">৳<?= htmlspecialchars($exp['amount']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="index.php?route=dashboard" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-150">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Dashboard
        </a>
    </div>
</body>
</html>