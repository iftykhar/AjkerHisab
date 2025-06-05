<?php 
use App\Core\Session;
require_once '../App/Core/Session.php';
Session::start();

if(!Session::checkAuth()){
    header('location')
}