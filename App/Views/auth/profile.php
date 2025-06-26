<?php 

use App\Core\Session;
require_once '../App/Core/Session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AjkerHisab-Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <div class=" items-center mb-6">
            <div>
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-receipt mr-2"></i> <?php echo htmlspecialchars(Session::get('user')); ?> Expenses
            </h2>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-green-400 text-transparent bg-clip-text text-center">
                    AjkerHisab <span class="text-6xl">৳</span>
                </h1>
            </div>
        </div>
    <h2 class="text-xl font-bold mb-4 text-center">My Profile</h2>
    <!--  -->

    <?php if (!empty($_GET['msg'])): ?>
        <p class="text-green-600 text-center mb-3">Profile updated!</p>
    <?php endif; ?>

    <form method="POST" action="index.php?route=profile-update" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block text-gray-600">Email (readonly)</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly
                class="w-full border rounded px-3 py-2 bg-gray-100">
        </div>

        <div>
            <label class="block text-gray-600">Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-600">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <?php if (!empty($_GET['error']) && $_GET['error'] === 'invalid_image'): ?>
                <p class="text-red-600 text-center mb-3">Invalid image: Only JPG/PNG under 1MB allowed.</p>
            <?php elseif (!empty($_GET['msg'])): ?>
                <p class="text-green-600 text-center mb-3">Profile updated successfully!</p>
            <?php endif; ?>

            <label class="block text-gray-600">Profile Image</label>
            <input type="file" name="profile_image" class="w-full">
             
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
            Update Profile
        </button>
    </form>
    <div class="mt-6 text-center"></div>
        <a href="index.php?route=dashboard" class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>
</div>

</body>
</html>