<?php 
use App\Core\Session;
require_once '../App/Core/Session.php';
require_once '../App/config.php';
Session::start();

$timeout = 3000;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    Session::destroy();
    header("Location: index.php?route=login?msg=session_expired");
    exit();
}
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AjkerHisab Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/AjkerHisab/Public/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Layout Header -->
    <div class="container mx-auto px-2 sm:px-4 py-4 sm:py-8">
        <div class="bg-white rounded-lg shadow-lg p-3 sm:p-6 max-w-full sm:max-w-2xl mx-auto">
            <div class="text-center">
                <h1 class="m-3 sm:m-5 text-center text-3xl sm:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text">
                    AjkerHisab <span class="text-4xl sm:text-6xl">৳</span>
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-between mb-4 sm:mb-6 gap-2">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-600 text-sm sm:text-base">Welcome, <?php echo htmlspecialchars(Session::get('user')); ?></p>
            </div>

            <!-- Navigation Links (for SPA) -->
            <nav class="mb-4 sm:mb-6 flex flex-col sm:flex-row justify-center gap-3 sm:gap-6">
                <a href="index.php?route=expenses" 
                   class="flex items-center p-3 sm:p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300 w-full sm:w-auto">
                    <div class="p-2 sm:p-3 bg-blue-500 rounded-full mr-3 sm:mr-4">
                        <i class="fas fa-chart-bar text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-gray-700">View Expenses</h2>
                        <p class="text-xs sm:text-sm text-gray-600">Check your expense history</p>
                    </div>
                </a>
                <a href="index.php?route=expense-category-report" 
                   class="flex items-center p-3 sm:p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300 w-full sm:w-auto">
                    <div class="p-2 sm:p-3 bg-green-500 rounded-full mr-3 sm:mr-4">
                        <i class="fas fa-chart-pie text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-gray-700">View Report</h2>
                        <p class="text-xs sm:text-sm text-gray-600">Report Based On Categories</p>
                    </div>
                </a>
            </nav>
            <div class="mt-4 sm:mt-6 text-center">
                <a href="index.php?route=logout" 
                   class="inline-flex items-center px-3 sm:px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-300 text-sm sm:text-base">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </div>
            <div class="m-2 sm:m-4 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                <a href="index.php?route=export-csv" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-green-600 text-sm sm:text-base text-center">
                    <i class="fas fa-file-csv mr-1"></i> Export CSV
                </a>
                <a href="index.php?route=export-pdf" class="px-3 py-1 bg-red-700 text-white rounded hover:bg-red-600 text-sm sm:text-base text-center">
                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                </a>
            </div>

            <!-- SPA Content -->
            <div id="app" class="mt-4 sm:mt-6 mb-4 sm:mb-6"></div>
            <div class="max-w-full sm:max-w-lg mx-auto bg-white p-3 sm:p-6 rounded shadow">
                <h2 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4">Manage Categories</h2>

                <form method="POST" action="index.php?route=category-store" class="mb-4 sm:mb-6">
                    <input type="text" name="name" placeholder="New Category"
                        class="border border-gray-300 rounded px-3 sm:px-4 py-2 w-full mb-2 text-sm sm:text-base" required>
                    <button type="submit"
                            class="bg-blue-600 text-white px-3 sm:px-4 py-2 rounded hover:bg-blue-700 text-sm sm:text-base">
                        Add Category
                    </button>
                </form>

                <h3 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">Existing Categories:</h3>
                <ul class="list-disc list-inside text-gray-700 text-sm sm:text-base">
                    <?php if (isset($categories) && is_array($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <li><?= htmlspecialchars($cat) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No categories found.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- SPA Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const app = document.getElementById('app');

            function loadContent(route) {
                fetch(`index.php?route=ajax-${route}`)
                    .then(res => {
                        if (!res.ok) throw new Error('404 Not Found');
                        return res.text();
                    })
                    .then(html => app.innerHTML = html)
                    .catch(() => app.innerHTML = '<p class="text-red-500 text-center">Content not found.</p>');
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const route = this.getAttribute('data-route');
                    loadContent(route);
                });
            });

            // Default load
            loadContent('home');
        });
    </script>
</body>
</html>
