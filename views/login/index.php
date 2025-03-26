<?php
include_once __DIR__ . '/../../config/auth.php';
redirectIfAuthenticated();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>login</h1>
    <form action="../../controllers/authController.php" style="display: flex; flex-direction: column; width: 200px;" method="post">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <?php
        if(isset($_GET['error'])){
            echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
        <button type="submit">Entrar</button>
        <p>cadastre-se <a href="/todolist/register">aqui</a></p>
    </form>
</body>
</html>