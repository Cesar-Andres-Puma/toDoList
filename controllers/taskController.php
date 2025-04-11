<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Usuário não autenticado.']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = 'pending'; 

    if (empty($title)) {
        echo json_encode(['status' => 'error', 'message' => 'O título é obrigatório.']);
        exit();
    }

    $success = createTask($pdo, $user_id, $title, $description, $status);

    if ($success) {
        header('Location: ../views/dashboard/index.php');
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar tarefa.']);
    }
}
