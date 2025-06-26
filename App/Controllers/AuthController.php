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

        // var_dump($result);

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

    public function profile() {
        $userEmail = \App\Core\Session::get('user');
        $users = json_decode(file_get_contents(__DIR__ . '/../../Storage/users.json'), true);

        foreach ($users as $u) {
            if ($u['email'] === $userEmail) {
                $user = $u;
                break;
            }
        }

        require_once __DIR__ . '/../Views/auth/profile.php';
    }

    public function updateProfile() {
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $userEmail = \App\Core\Session::get('user');

        $users = json_decode(file_get_contents(__DIR__ . '/../../Storage/users.json'), true);

        foreach ($users as &$user) {
            if ($user['email'] === $userEmail) {
                $user['name'] = $name ?: $user['name'];

                if (!empty($password)) {
                    $user['password'] = password_hash($password, PASSWORD_DEFAULT);
                }

                
                if (!empty($_FILES['profile_image']['name'])) {
                    $allowedTypes = ['image/jpeg', 'image/png'];
                    $maxSize = 1 * 1024 * 1024; // 1MB

                    $fileType = $_FILES['profile_image']['type'];
                    $fileSize = $_FILES['profile_image']['size'];
                    $tmpName = $_FILES['profile_image']['tmp_name'];

                    if (in_array($fileType, $allowedTypes) && $fileSize <= $maxSize) {
                        $targetDir = __DIR__ . '/../Storage/uploads/';
                        if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

                        $filename = uniqid() . '_' . basename($_FILES['profile_image']['name']);
                        $targetFile = $targetDir . $filename;

                        if (move_uploaded_file($tmpName, $targetFile)) {
                            $user['profile_image'] = 'Storage/uploads/' . $filename;
                        }
                    } else {
                        
                        header('Location: index.php?route=profile&error=invalid_image');
                        exit;
                    }
                }

                break;
            }
        }

        file_put_contents(__DIR__ . '/../../Storage/users.json', json_encode($users, JSON_PRETTY_PRINT));
        header('Location: index.php?route=profile&msg=updated');
    }



}
