<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Page Not Found</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center p-8 bg-white rounded-lg shadow-md">
        <div class="text-red-500 mb-4">
            <i class="fas fa-exclamation-circle text-8xl"></i>
        </div>
        <h1 class="text-8xl font-bold text-red-500 mb-4">404</h1>
        <p class="text-gray-600 text-xl mb-8">Oops! The page you're looking for cannot be found.</p>
        <a href="index.php?route=login" class="inline-block px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
            <i class="fas fa-home mr-2"></i>
            Back 
        </a>
    </div>
</body>
</html>
