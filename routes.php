<?php
 include_once 'init.php';

 $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

 $routes = [
      '/' => 'views/login/index.php',
      '/register' => 'views/register/index.php',
      '/dashboard' => 'views/dashboard/index.php',
      '/logout' => 'controllers/logout.php',
      '/404' => 'views/error/index.php'
 ];

 if(array_key_exists($uri, $routes)){
    include $routes[$uri];
 }
 else{
    http_response_code(404);
    include $routes['/404'];

 }

?>