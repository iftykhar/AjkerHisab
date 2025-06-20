<?php
/*namespace App\Models;

class Expense {
    private $file;

    public function __construct() {
        // $this->file = __DIR__ . '/../../../Storage/expenses.json';
        $this->file = __DIR__ . '/../../Storage/expenses.json';
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
*/

namespace App\Models;

class Expense {
    private $file;

    public function __construct() {
        $this->file = __DIR__ . '/../../Storage/expenses.json';
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function save(array $data) {
        $all = json_decode(file_get_contents($this->file), true) ?? [];

        if (!isset($data['id'])) {
            $data['id'] = uniqid();
        }

        $all[] = $data;
        file_put_contents($this->file, json_encode($all, JSON_PRETTY_PRINT));
    }


    // public function save(array $data) {
    //     $all = $this->getAllData();
    //     $data['id'] = uniqid(); // Add unique ID
    //     $all[] = $data;
    //     file_put_contents($this->file, json_encode($all, JSON_PRETTY_PRINT));
    // }


    // Get all expenses for a specific user
    public function getAll(string $userEmail): array {
        return array_filter($this->getAllData(), fn($e) => $e['user'] === $userEmail);
    }

    // ✅ NEW: Get all expenses (regardless of user)
    public function getAllData(): array {
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    
    public function saveAll(array $expenses) {
    file_put_contents($this->file, json_encode($expenses, JSON_PRETTY_PRINT));
}

}
