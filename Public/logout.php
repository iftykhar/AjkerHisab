<?php
use App\Core\Session;
require_once '../App/Core/Session.php';
Session::start();

Session::destroy();
header('location: /login');