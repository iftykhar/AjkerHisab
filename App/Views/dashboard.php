<?php 
use App\Core\Session;
require_once '../App/Core/Session.php';
require_once '../App/config.php';
Session::start();

// Check if user is logged in and has valid session
// if (!Session::checkAuth() || /*!Session::get('user') || !Session::get('user_id')*/ ) {

if(!Session::checkAuth()){
// Not logged in, redirect to login page
    header("Location: index.php?route=login");
    exit();
}

// Check session timeout (optional, 30 minutes)
$timeout = 60; // 1 minute in seconds
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    Session::destroy();
    header("Location: index.php?route=login?msg=session_expired");
    exit();
}
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <p>Welcome, <?php echo htmlspecialchars(Session::get('user')); ?></p>
    <a href='index.php?route=logout'>Logout</a>
</body>
</html>