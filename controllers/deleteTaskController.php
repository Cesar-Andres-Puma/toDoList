<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../config/auth.php';
redirectIfNotAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $taskId = $_POST['task_id'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $taskId, ':user_id' => $userId]);

    header('Location: ../views/dashboard/index.php');
    exit;
}
