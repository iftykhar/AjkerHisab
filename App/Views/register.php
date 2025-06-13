<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../App/config.php';

$usersFile = '../Storage/users.json';
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');


    if(empty($name) || empty($email) || empty($password) || empty($confirm)){
        $errors[] = "All fields are required";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }elseif($password !== $confirm){
        $error[] = "passwords don't match";
    }

    $users = [];
    if(file_exists($usersFile)){
        $json = file_get_contents($usersFile);
        $users = json_decode($json, true) ?? [];
    }

    foreach($users as $user){
        if($user['email'] === $email){
            $errors[] = "User already exists with this email";
            break;
        }
    }

    if(empty($errors)){
        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password,PASSWORD_DEFAULT),
        ];

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['success'] = "Registration Successful! You can now log in.";
    header("Location: ".BASE_URL."/login");
    exit;
    }

}
?>

<h2>Registration</h2>

<form method="POST" action="index.php?route=register">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <input type="email" name="email" placeholder="Email Address" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" placeholder="confirm_Password" required><br>
    <button type="submit">Register</button>
</form>

<?php if(!empty($errors)): ?>

    <ul style="color:red;">
        <?php foreach($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?> </li>
        <?php endforeach ?>
    </ul>

<?php endif ?>