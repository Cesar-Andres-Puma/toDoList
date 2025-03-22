<?php
include_once 'session.php';

if(!isset($_SESSION['user_id'])){
    header('location: /todolist/views/login/index.php');
    exit();
}

?>