<?php
include_once __DIR__ . '/../../init.php'; // Conexão com banco (define $pdo)
include_once __DIR__ . '/../../config/auth.php'; // Verifica se o usuário está logado
include_once __DIR__ . '/../../models/task.php'; // Função getUserTasks
redirectIfNotAuthenticated();

// Busca as tarefas do usuário logado
$tasks = getUserTasks($_SESSION['user_id'], $pdo);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Bem-vindo, <?php echo $_SESSION['username']; ?>!</h1>

                <!-- Formulário de criação de tarefa -->
                <h4 class="mb-3">Criar Nova Tarefa</h4>
                <form action="../../controllers/taskController.php" method="post" class="mb-4">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Título da tarefa" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="description" class="form-control" placeholder="Descrição da tarefa" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Tarefa</button>
                </form>

                <!-- Lista de tarefas -->
                <h4 class="mb-3">Suas Tarefas</h4>
                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info">Nenhuma tarefa cadastrada.</div>
                <?php else: ?>
                    <ul class="list-group">
    <?php foreach ($tasks as $task): ?>
        <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row">
            <div class="me-3">
                <h5><?php echo htmlspecialchars($task['title']); ?></h5>
                <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
                <small class="text-muted">
                    Status: <strong><?php echo $task['status']; ?></strong><br>
                    Criado em: <?php echo date('d/m/Y H:i', strtotime($task['created_at'])); ?>
                </small>
            </div>
            <div class="mt-3 mt-md-0 text-end">
                <!-- Form de status -->
                <form action="../../controllers/updateTaskController.php" method="post" class="d-inline">
    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
    <select name="new_status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
        <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pendente</option>
        <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Concluída</option>
    </select>
</form>



                </form>

                <!-- Form de exclusão -->
                <form action="../../controllers/deleteTaskController.php" method="post" class="d-inline">
                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>



                <?php endif; ?>

                <!-- Botão de logout -->
                <form action="../../controllers/logoutController.php" method="post" class="mt-4 text-center">
                    <button type="submit" name="logout" class="btn btn-outline-danger">Sair</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
