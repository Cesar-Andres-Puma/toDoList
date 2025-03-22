<?php
function loadEnv($file){
    if(!file_exists($file)){
        return;
    }
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        if(strpos($line, "=") !== false){
            list($key, $value) = explode("=", $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}
loadEnv(__DIR__ . "../.env");

$host = $_ENV["DB_HOST"];
$dbname = $_ENV["DB_NAME"];
$username = $_ENV["DB_USER"];
$password = $_ENV["DB_PASS"];

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Error ao conectar ao banco de dados:" . $e->getMessage());
}
?>