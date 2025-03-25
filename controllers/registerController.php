<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/register.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if(empty($username) || empty($email) || empty($password) || empty($confirmPassword)){
        echo 'preencha todos os campos';
        exit();
    }
    if($password !== $confirmPassword){
        echo 'As senhas não coincidem';
        exit();
    }

}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$userCreate = createUser($username, $email, $hashedPassword, $pdo);

if($userCreate){
    header('Location: /todolist/views/login/index.php');
    exit();
}
else{
    echo 'Erro ao criar usuário';
    exit();
}

?>