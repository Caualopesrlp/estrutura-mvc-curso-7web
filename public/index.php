<?php
    require_once '../app/core/Router.php';
    use app\core\Router;
    
    $url = $_GET['url'] ?? '';

    $router = new Router();
    $router->dispatch($url);


 ?>