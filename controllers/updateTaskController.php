<?php
include_once __DIR__ . '/../init.php';
include_once __DIR__ . '/../models/task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../views/auth/login.php');
        exit();
    }

    $task_id = $_POST['task_id'] ?? null;
    $new_status = $_POST['new_status'] ?? null;

    $allowedStatuses = ['pending', 'completed'];

    if ($task_id && in_array($new_status, $allowedStatuses)) {
        updateTaskStatus($pdo, $task_id, $new_status);
    }

    header('Location: ../views/dashboard/index.php');
    exit();
}
?>
