<?php
namespace App\Controllers;

use App\Models\Category;

class CategoryController {

    // public function index() {
    //     $category = new Category();
    //     $categories = $category->all();
    //     require_once __DIR__ . '/../Views/categories/index.php';
    // }
    public function index() {
    $categoryModel = new Category();
    $categories = $categoryModel->all();  // ✅ this loads categories from JSON

    require_once __DIR__ . '/../Views/dashboard.php';
}

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name) {
                $category = new Category();
                $category->add($name);
            }
        }
        header('Location: index.php?route=categories');
    }
}
