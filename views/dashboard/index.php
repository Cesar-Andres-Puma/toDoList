<?php
// Inclui arquivos de inicialização, configuração de autenticação e modelo de tarefa
include_once __DIR__ . '/../../init.php';
include_once __DIR__ . '/../../config/auth.php';
include_once __DIR__ . '/../../models/task.php';

// Redireciona para a página de login se o usuário não estiver autenticado
redirectIfNotAuthenticated();

// Busca as tarefas do usuário logado usando o ID da sessão e a conexão PDO
$tasks = getUserTasks($_SESSION['user_id'], $pdo);

// --- INÍCIO DA MODIFICAÇÃO: Ordenar as tarefas ---
if (!empty($tasks)) { // Só ordena se houver tarefas
    usort($tasks, function ($taskA, $taskB) {
        // Define a prioridade: 'pending' vem antes de 'completed'
        $statusOrder = [
            'pending' => 0,
            'completed' => 1
            // Adicione outros status aqui se necessário, com números maiores
        ];

        // Obtém o valor de ordenação para cada tarefa (ou um valor alto se o status for desconhecido)
        $orderA = $statusOrder[$taskA['status']] ?? 99;
        $orderB = $statusOrder[$taskB['status']] ?? 99;

        if ($orderA == $orderB) {
             // Se os status forem iguais, ordena pela data de criação (mais antiga primeiro) - opcional
             // Use strtotime para comparar datas como timestamps
             $dateA = isset($taskA['created_at']) ? strtotime($taskA['created_at']) : 0;
             $dateB = isset($taskB['created_at']) ? strtotime($taskB['created_at']) : 0;
             return $dateA <=> $dateB; // Ordena ascendentemente pela data
            // return 0; // Ou simplesmente não reordena se os status forem iguais
        }

        // Retorna a diferença para ordenar (0 antes de 1)
        return $orderA <=> $orderB; // Operador <=> faz a comparação: -1, 0 ou 1
    });
}
// --- FIM DA MODIFICAÇÃO ---

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Estilo base para tarefas concluídas */
        .task-completed {
            text-decoration: line-through; /* Risca o texto */
            opacity: 0.7; /* Deixa um pouco transparente */
            background-color: #e9ecef; /* Um fundo cinza claro (opcional) */
        }
        /* Garante que botões e select dentro da tarefa concluída não sejam afetados */
        .task-completed .form-select,
        .task-completed .btn {
             text-decoration: none; /* Remove o risco */
             opacity: 1; /* Garante opacidade normal */
        }
        /* Deixa o texto principal da tarefa concluída mais claro */
        .task-completed h5,
        .task-completed p,
        .task-completed small {
            color: #6c757d !important; /* Cor 'muted' do Bootstrap */
        }
    </style>

</head>

<body style="background-color: #f8f9fa;">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                
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

                <h4 class="mb-3">Suas Tarefas</h4>
                <?php if (empty($tasks)): ?>
                    <div class="alert alert-info">Nenhuma tarefa cadastrada.</div>
                <?php else: ?>
                 
                    <ul class="list-group">
                        <?php foreach ($tasks as $task): ?>
                            <?php
                                // Define as classes base do item da lista
                                $listItemClasses = 'list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row';
                                // Adiciona a classe 'task-completed' se a tarefa estiver concluída
                                if (isset($task['status']) && $task['status'] === 'completed') { 
                                    $listItemClasses .= ' task-completed';
                                }
                            ?>
                            <li class="<?php echo $listItemClasses; ?>">
                                <div class="me-3">
                                    <h5><?php echo htmlspecialchars($task['title']); ?></h5>
                                    <p><?php echo nl2br(htmlspecialchars($task['description'] ?? '')); ?></p>
                                    <small class="text-muted">
                                        Status: <strong><?php echo htmlspecialchars($task['status'] ?? 'indefinido'); ?></strong><br> 
                                        Criado em: <?php echo isset($task['created_at']) ? date('d/m/Y H:i', strtotime($task['created_at'])) : 'Data desconhecida'; ?>
                                    </small>
                                </div>
                                <div class="mt-3 mt-md-0 text-end">
                                    <form action="../../controllers/updateTaskController.php" method="post" class="d-inline">
                                        <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                        <select name="new_status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                            <option value="pending" <?php echo (isset($task['status']) && $task['status'] === 'pending') ? 'selected' : ''; ?>>Pendente</option> 
                                            <option value="completed" <?php echo (isset($task['status']) && $task['status'] === 'completed') ? 'selected' : ''; ?>>Concluída</option>
                                        </select>
                                    </form>
                                    <form action="../../controllers/deleteTaskController.php" method="post" class="d-inline">
                                        <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="../../controllers/logoutController.php" method="post" class="mt-4 text-center">
                    <button type="submit" name="logout" class="btn btn-outline-danger">Sair</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>