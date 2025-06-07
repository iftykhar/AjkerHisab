<?php 
use App\Core\Session;
require_once '../App/Core/Session.php';
Session::start();

if(!Session::checkAuth()){
   header('Location:/login');
   exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <p>Welcome, <?php echo htmlspecialchars(Session::get('user')); ?></p>
    <a href='/logout'>Logout</a>
</body>
</html>