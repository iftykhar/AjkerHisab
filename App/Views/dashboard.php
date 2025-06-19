<!-- <?php 
// use App\Core\Session;
// require_once '../App/Core/Session.php';
// require_once '../App/config.php';
// Session::start();

// // Session timeout check
// $timeout = 60;
// if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
//     Session::destroy();
//     header("Location: index.php?route=login?msg=session_expired");
//     exit();
// }
// $_SESSION['last_activity'] = time();
// ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            <div class="text-center">
                 <h1 class="m-5 text-center text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400  text-transparent bg-clip-text">AjkerHisab</h1>
            </div>
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-600">Welcome, <?php //echo htmlspecialchars(Session::get('user')); ?></p>
            </div>
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="index.php?route=expenses" 
                   class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                    <div class="p-3 bg-blue-500 rounded-full mr-4">
                        <i class="fas fa-chart-bar text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">View Expenses</h2>
                        <p class="text-sm text-gray-600">Check your expense history</p>
                    </div>
                </a>

                <a href="index.php?route=expense-create" 
                   class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                    <div class="p-3 bg-green-500 rounded-full mr-4">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Add Expense</h2>
                        <p class="text-sm text-gray-600">Record new expenses</p>
                    </div>
                </a>
            </div>

            <div class="mt-6 text-center">
                <a href="index.php?route=logout" 
                   class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html></div> -->

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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/AjkerHisab/Public/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Layout Header -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            <div class="text-center">
                <h1 class="m-5 text-center text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text">AjkerHisab</h1>
            </div>
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-600">Welcome, <?php echo htmlspecialchars(Session::get('user')); ?></p>
            </div>

            <!-- Navigation Links (for SPA) -->
            <nav class="mb-6 flex justify-center gap-6">
                <!-- <a href="#" class="nav-link text-blue-600 hover:underline" data-route="home">Home</a> -->
                <a href="index.php?route=expenses" 
                   class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                    <div class="p-3 bg-blue-500 rounded-full mr-4">
                        <i class="fas fa-chart-bar text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">View Expenses</h2>
                        <p class="text-sm text-gray-600">Check your expense history</p>
                    </div>
                </a>
                <!-- <a href="index.php?route=expense-create" 
                   class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                    <div class="p-3 bg-green-500 rounded-full mr-4">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Add Expense</h2>
                        <p class="text-sm text-gray-600">Record new expenses</p>
                    </div>
                </a> -->
                <div class="mt-6 text-center">
                <a href="index.php?route=logout" 
                   class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </div>
            </nav>

            <!-- SPA Content -->
            <div id="app" class="mt-6">
               
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
