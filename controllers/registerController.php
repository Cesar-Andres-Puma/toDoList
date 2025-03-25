<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/register.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];


    if ($password !== $confirmPassword) {

        echo 'As senhas não coincidem.';
        exit();
    }

   
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'Usuário ou e-mail já registrados.';
        exit();
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo 'Usuário cadastrado com sucesso!';

        header('Location: /todolist/views/login/index.php');
        exit();
    } else {
        echo 'Erro ao cadastrar usuário.';
    }
}
?>