<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {

    public function showLoginForm() {
        require_once __DIR__ . '/../Views/login.php';
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
            $error = "Passwords do not match.";
            require __DIR__ . '/../Views/register.php';
            return;
        }

        $userModel = new User();
        $result = $userModel->register($name, $email, $password);

        if (isset($result['success'])) {
            $_SESSION['user'] = $email;
            header('Location: index.php?route=dashboard');
        } else {
            $error = $result['error'];
            require __DIR__ . '/../Views/register.php';
        }
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $result = $userModel->login($email, $password);

        if (isset($result['success'])) {
            $_SESSION['user'] = $email;
            header('Location: index.php?route=dashboard');
        } else {
            $error = $result['error'];
            require __DIR__ . '/../Views/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?route=login');
    }
}
