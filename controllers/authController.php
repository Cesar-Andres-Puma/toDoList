<?php
include_once '../init.php';
include_once '../models/auth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = authenticateUser($username, $password, $pdo);

    if($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('location; /todolist/view/dashboard/index.php');
        exit();
    }
    else{
        header('location: /todolist/views/error/index.php');
        exit();
    }
}
?>