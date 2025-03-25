<?php
include_once __DIR__ . '/../../config/auth.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['username']; ?>!</h1> <!-- Exibe o nome do usuário logado -->
    

    <p>Aqui está o seu painel de controle.</p>

 
    <form action="../../controllers/logoutController.php" method="post">
        <button type="submit" name="logout">Sair</button>
    </form>
</body>
</html>
