<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/auth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        echo 'Invalid request';
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = authenticateUser($username, $password, $pdo);

    if($user){
      
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo 'Login successful';
        exit();
    }
    else{
        echo 'Invalid username or password';
        exit();
    }
}
?>