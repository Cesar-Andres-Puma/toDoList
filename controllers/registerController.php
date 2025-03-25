<?php

include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/register.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verifica se as senhas coincidem
    if ($password !== $confirmPassword) {
        // Se não coincidirem, exibe uma mensagem de erro
        echo 'As senhas não coincidem.';
        exit();
    }

    // Validação adicional: Verifica se o nome de usuário ou o email já estão cadastrados
    // Exemplo de verificação para nome de usuário
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'Usuário ou e-mail já registrados.';
        exit();
    }

    // Criptografa a senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo 'Usuário cadastrado com sucesso!';
        // Redirecionar para a página de login, por exemplo
        header('Location: /todolist/views/login/index.php');
        exit();
    } else {
        echo 'Erro ao cadastrar usuário.';
    }
}
?>