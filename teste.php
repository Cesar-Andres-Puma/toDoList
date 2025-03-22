<?php
function mysenha($senha){
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    return $hash;
}
mysenha('1234');
?>