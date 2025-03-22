<?php
include_once 'ssesion.php';

if(!isset($_SESSION['user_id'])){
    header('location: ../view/login/index.php');
    exit();
}

?>