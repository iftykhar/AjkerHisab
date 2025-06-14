<?php
namespace App\Controllers;

use App\Models\User;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {

    public function showLoginForm() {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Please fill in Email and Password.";
            require_once __DIR__ . '/../Views/login.php';
            return;
        }

        $user = new User();
        $result = $user->login($email, $password);

        if (isset($result['success']) && $result['success']) {
            $_SESSION['user'] = $email;
            header("Location: index.php?route=dashboard");
            exit;
        } else {
            $error = $result['error'] ?? 'Login failed';
            require_once __DIR__ . '/../Views/login.php';
        }
    }

    public function showRegisterForm() {
        require_once __DIR__ . '/../Views/register.php';
    }

    public function register() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            $error = "Passwords do not match";
            require_once __DIR__ . '/../Views/register.php';
            return;
        }

        $user = new User();
        $result = $user->register($name, $email, $password);

        if (isset($result['success']) && $result['success']) {
            $_SESSION['user'] = $email;
            header("Location: index.php?route=dashboard");
            exit;
        } else {
            $error = $result['error'] ?? 'Registration failed';
            require_once __DIR__ . '/../Views/register.php';
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?route=login");
        exit;
    }
}
