<?php
use App\Core\Session;
require_once '../App/Core/Session.php';
require_once '../App/config.php';
Session::start();

Session::destroy();
header("location:".BASE_URL."/login");