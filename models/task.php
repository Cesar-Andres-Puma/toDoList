<?php
function getUserTasks($userId, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createTask($pdo, $user_id, $title, $description, $status) {
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, status, created_at) VALUES (:user_id, :title, :description, :status, NOW())");
    return $stmt->execute([
        'user_id' => $user_id,
        'title' => $title,
        'description' => $description,
        'status' => $status
    ]);
}
function updateTaskStatus($pdo, $task_id, $new_status) {
    $stmt = $pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
    return $stmt->execute([
        'status' => $new_status,
        'id' => $task_id
    ]);
}
