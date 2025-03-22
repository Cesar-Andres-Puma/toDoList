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

?>