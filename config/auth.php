<?php
include_once 'session.php';

if(!isset($_SESSION['user_id'])){
    header('location: ../views/login/index.php');
    exit();
}

?>