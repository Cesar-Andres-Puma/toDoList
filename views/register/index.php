<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        // Função para validar se as senhas coincidem
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                return false;
            }
            return true;
        }

        function togglePassword(id, iconId) {
            const input = document.getElementById(id);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }


        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("registerForm").addEventListener("submit", function(event) {
                event.preventDefault();

                const formData = new FormData(this);

                fetch("../../../toDoList/controllers/registerController.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        const messageDiv = document.getElementById("message");
                        messageDiv.innerHTML = "";

                        if (data.status === "error") {
                            messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                        } else {
                            messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                            setTimeout(() => window.location.href = "/todolist/views/login/index.php", 2000); // Redireciona após 2 segundos
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
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Cadastro</h3>
                        <div id="message"></div>
                        <form id="registerForm" method="post" onsubmit="return validatePassword()">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <i id="iconPassword" class="bi bi-eye toggle-password" onclick="togglePassword('password', 'iconPassword')"></i>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Senha</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                    <i id="iconConfirmPassword" class="bi bi-eye toggle-password" onclick="togglePassword('confirm_password', 'iconConfirmPassword')"></i>
                                </div>
                            </div>

                            <div style="display: flex; justify-content:center; align-items:center;">
                                <button type="submit" class="btn btn-primary w-50">Cadastrar</button>
                            </div>
                        </form>

                        <p class="text-center mt-3">Já tem uma conta? <a href="/todolist" class="link-primary">Faça login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>