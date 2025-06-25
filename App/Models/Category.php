<?php
namespace App\Models;

class Category {
    private $file;

    public function __construct() {
        $this->file = __DIR__ . '/../../Storage/categories.json';
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function all(): array {
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    public function add(string $name): void {
        $categories = $this->all();
        if (!in_array($name, $categories)) {
            $categories[] = $name;
            file_put_contents($this->file, json_encode($categories, JSON_PRETTY_PRINT));
        }
    }
}
