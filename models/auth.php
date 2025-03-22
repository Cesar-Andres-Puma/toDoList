<?php
function authenticateUser($username, $password, $pdo){
    $stmt = $pdo->prepare("SELECT * FROM USER WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
if($user && password_verify($password, $user['password'])){
    return $user;
}
return false;
?>