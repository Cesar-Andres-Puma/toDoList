<?php
include_once 'session.php';

function redirectIfAuthenticated() {
    if (isset($_SESSION['user_id'])) {
        header('location: /todolist/views/dashboard/index.php');
        exit();
    }
}

function redirectIfNotAuthenticated() {
    if (!isset($_SESSION['user_id'])) {
        header('location: /todolist/views/login/index.php');
        exit();
    }
}
?>