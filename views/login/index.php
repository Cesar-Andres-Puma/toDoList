<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
         function togglePassword(id, iconId) {
            const input = document.getElementById(id);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash"); // Olho fechado
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye"); // Olho aberto
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evita recarregar a página

        const formData = new FormData(this);

        fetch("/toDoList/controllers/authController.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messageDiv = document.getElementById("message");
            messageDiv.innerHTML = ""; // Limpa mensagens anteriores

            if (data.status === "error") {
                messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            } else if (data.status === "success") {
                window.location.href = "/todolist/views/dashboard/index.php"; // Redireciona se sucesso
            }
        })
        .catch(error => console.error("Erro:", error));
    });
});
    </script>
    <style>
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            /* Cor neutra */
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f4f9;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        
                        <form id="loginForm">
    <div class="mb-3">
        <label for="username" class="form-label">Usuário</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <div class="password-wrapper">
            <input type="password" class="form-control" name="password" id="password" required>
            <i id="iconPassword" class="bi bi-eye toggle-password" onclick="togglePassword('password', 'iconPassword')"></i>
        </div>
    </div>
    <div id="message" class="text-danger"></div> <!-- Aqui aparece o erro -->
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
