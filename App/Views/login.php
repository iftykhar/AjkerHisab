<?php 
require_once '../App/config.php';

use App\Core\Session;
Session::start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    //testing purpose
    if($email === 'admin@mail.com' && $pass === '123456'){
        Session::set('user',$email);
        header("location:".BASE_URL."/dashboard");
        exit;
    }else{
        echo "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AjkerHisab Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="Password">Password </label>
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>