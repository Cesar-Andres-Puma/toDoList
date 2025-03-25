<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script>
      
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert("As senhas não coincidem!");
                return false;
            }
            return true; 
        }
    </script>
</head>
<body>
    <h1>Cadastro</h1>
    
    <form action="../../../toDoList/controllers/registerController.php" method="post" style="display: flex; flex-direction: column; width: 200px;" onsubmit="return validatePassword()">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm_password">Confirme a senha:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem uma conta? <a href="/todolist">Faça login</a></p>
</body>
</html>
