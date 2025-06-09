<?php
namespace App\Core;

class Router{

    public function route($url){

        switch($url){
            case'':
            case 'login':
                require_once '../Public/login.php';
                break;
            case 'dashboard':
                require_once '../Public/dashboard.php';
                break;
            case 'logout':
                require_once '../Public/logout.php';
                break;
            case 'register':
                require_once '../Public/register.php';
                break;
            default:
                echo '404 - page not found';
        }
    }
}