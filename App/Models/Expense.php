<?php
namespace App\Models;

class Expense {
    private $file;

    public function __construct() {
        $this->file = __DIR__ . '/../../../Storage/expenses.json';
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function save(array $data) {
        $all = json_decode(file_get_contents($this->file), true) ?? [];
        $all[] = $data;
        file_put_contents($this->file, json_encode($all, JSON_PRETTY_PRINT));
    }

    public function getAll(string $userEmail): array {
        $all = json_decode(file_get_contents($this->file), true) ?? [];
        return array_filter($all, fn($e) => $e['user'] === $userEmail);
    }
}
