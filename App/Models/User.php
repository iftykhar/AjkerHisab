<?php
namespace App\Models;

class User {
    private $file;

    public function __construct() {
        $this->file = __DIR__ . '/../../Storage/users.json';
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function getAllUsers() {
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    public function saveAllUsers($users) {
        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function register($name, $email, $password) {
        $users = $this->getAllUsers();

        if (isset($users[$email])) {
            return ['error' => 'Email already registered'];
        }

        $users[$email] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->saveAllUsers($users);
        return ['success' => true];
    }

    public function login($email, $password) {
        $users = $this->getAllUsers();

        if (!isset($users[$email])) {
            return ['error' => 'User not found'];
        }

        if (!password_verify($password, $users[$email]['password'])) {
            return ['error' => 'Invalid password'];
        }

        return ['success' => true];
    }
}
