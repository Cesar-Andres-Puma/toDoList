<?php
session_start(); // Certifique-se de iniciar a sessão antes de manipulá-la

if (isset($_POST['logout'])) {
    // Destrói todas as variáveis de sessão
    session_unset();

    // Destrói a sessão
    session_destroy();

    // Redireciona o usuário para a página de login
    header('Location: /todolist/views/login/index.php');
    exit();
}
?>
