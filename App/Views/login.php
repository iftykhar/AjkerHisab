<!DOCTYPE html>
<html class="h-full bg-gray-100">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="min-h-full flex items-center justify-center py-8 px-2 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm sm:max-w-md space-y-8">
            <div>
                <h1 class="m-5 text-center text-3xl sm:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text">
                    AjkerHisab <span class="text-5xl sm:text-6xl">৳</span>
                </h1>
            </div>
            <div>
                <h2 class="mt-6 text-center text-2xl sm:text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            </div>
            <?php if (isset($error)) echo "<p class='text-red-500 text-center'>$error</p>"; ?>
            <form class="mt-8 space-y-6" method="POST" action="index.php?route=do-login">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input type="email" name="email" required 
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm sm:text-base" 
                            placeholder="Email address">
                    </div>
                    <div>
                        <input type="password" name="password" required 
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm sm:text-base" 
                            placeholder="Password">
                    </div>
                </div>
                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm sm:text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="text-center">
                <a href="index.php?route=register" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Create new account
                </a>
            </div>
        </div>
    </div>
</body>
</html>