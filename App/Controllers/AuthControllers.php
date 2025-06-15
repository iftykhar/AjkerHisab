<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    public function showLogin() {
        require __DIR__ . '/../Views/Auth/login.php';
    }

    public function showRegister() {
        require __DIR__ . '/../Views/Auth/register.php';
    }

    public function register() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            $error = "Passwords do not match.";
            require __DIR__ . '/../Views/Auth/register.php';
            return;
        }

        $user = new User();
        $result = $user->register($name, $email, $password);

        if (isset($result['success'])) {
            $_SESSION['user'] = $email;
            header('Location: index.php?route=dashboard');
        } else {
            $error = $result['error'];
            require __DIR__ . '/../Views/Auth/register.php';
        }
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();
        $result = $user->login($email, $password);

        if (isset($result['success'])) {
            $_SESSION['user'] = $email;
            header('Location: index.php?route=dashboard');
        } else {
            $error = $result['error'];
            require __DIR__ . '/../Views/Auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?route=login');
    }
}
