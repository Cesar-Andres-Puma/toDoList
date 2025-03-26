<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f4f9;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        
                        <form action="/toDoList/controllers/authController.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <?php
                            if (isset($_GET['error'])) {
                                echo '<p class="text-danger">' . htmlspecialchars($_GET['error']) . '</p>';
                            }
                            ?>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                        
                        <p class="text-center mt-3">Não tem uma conta? <a href="/todolist/register">Cadastre-se aqui</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
