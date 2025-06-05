<?php 
use App\Core\Session;
require_once '../App/Core/Session.php';
Session::start();

if(!Session::checkAuth()){
   header('Location:/login');
   exit;
}

echo "Welcome, ". Session::get('user');
echo "<br><a href='/logout'>Logout</a>"