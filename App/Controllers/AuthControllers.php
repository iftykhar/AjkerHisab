<?php
namespace App\Controllers;

use App\Models\User;
use App\config;

class AuthController{


    public function showLoginForm(){
        require_once '../Views/login.php';
    }

    public function login(){
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if(empty($email) || empty($password)){
            $error = "please fill in Email and Password.";
            require '../Views/login.php';
            return;
        }

        $user = new User();
        $result = $user->login($email,$password);

        if($result['success']){
            $_SESSION['user'] == $email;
            header("Location:".BASE_URL."/public/dashboard");
        } else {
            $error = $result['error'];
            require '../Views/login.php';
        }
    }


    public function showRegisterForm(){
        require_once '../Views/register.php';
    }

    public function register(){

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if($password !== $confirm){
            $error = "passwords do not match";
            require '../Views/register.php';
            return ;
        }

        $user = new User();
        $result = $user->register($name,$email,$password);

        if($result['success']){
            $_SESSION['user'] = $email;
            header("Location:".BASE_URL."/public/dashboard");
        }else {
            $error = $result['error'];
            require '../Views/register.php';
        }
    }

    public function logout(){
        session_destroy();
        header("Locaiton:".BASE_URL."/public/login");
    }
}