<!DOCTYPE html>
<html class="h-full bg-gray-50">
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="">
                <h1 class="m-5 text-center text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400  text-transparent bg-clip-text">AjkerHisab <span class="text-6xl">৳</span> </h1>
            </div>
            <script>
                document.getElementById('register-form').addEventListener('submit', function(e) {
                    const pwd = document.getElementById('password').value;
                    const confirm = document.getElementById('confirm_password').value;
                    if (pwd !== confirm) {
                        e.preventDefault();
                        alert('Passwords do not match!');
                    }
                });
            </script>
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Create your account
                </h2>
            </div>
            <?php if (isset($error)): ?>
                <div class="rounded-md bg-red-50 p-4">
                    <div class="text-sm text-red-700" id="error-message"><?php echo $error ?? ''; ?></div>
                </div>
            <?php endif; ?>
            
            <form class="mt-8 space-y-6" method="POST" id="register-form" action="index.php?route=register">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input type="text" name="name" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Name">
                    </div>
                    <div>
                        <input type="email" name="email" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Email address">
                    </div>
                    <div>
                        <input type="password" name="password" id="password"  required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password">
                    </div>
                    <div>
                        <input type="password" name="confirm_password" id="confirm_password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Confirm Password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
            </form>
            <?php if (isset($success)): ?>
                <div id="message" class="success bg-green-100 text-green-700 p-4 rounded-md">
                    <?php echo $success; ?>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('message').style.display = 'none';
                    }, 3000);
                </script>
            <?php endif; ?>

            
            <div class="text-sm text-center">
                <a href="index.php?route=login" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Already have an account? Sign in
                </a>
            </div>
        </div>
    </div>
</body>
</html>
