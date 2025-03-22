<?php
 include_once 'init.php';

 $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

 if(strpos($uri, '/todolist') === false){
   header('location: /todolist');
   exit();
 }

 $routes = [
      '/todolist/' => 'views/login/index.php',
      '/todolist/register' => 'views/register/index.php',
      '/todolist/dashboard' => 'views/dashboard/index.php',
      '/todolist/logout' => 'controllers/logout.php',
      '/todolist/404' => 'views/error/index.php'
 ];

 if(array_key_exists($uri, $routes)){
    include $routes[$uri];
 }
 else{
    http_response_code(404);
    include $routes['/todolist/404'];

 }

?>