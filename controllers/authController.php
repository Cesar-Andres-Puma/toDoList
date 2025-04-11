<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/auth.php';

header("Content-Type: application/json"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Preencha todos os campos.'
        ]);
        exit();
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = authenticateUser($username, $password, $pdo);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo json_encode([
            'status' => 'success',
            'message' => 'Login realizado com sucesso!'
        ]);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Usuário ou senha inválidos.'
        ]);
        exit();
    }
}
?>
