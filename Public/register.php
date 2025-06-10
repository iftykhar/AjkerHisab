<?php
session_start();

$usersFile = '../Storage/users.json';
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
}