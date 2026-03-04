<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../app/Core/functions.php';
    use App\Core\Router;
    
    $url = $_GET['url'] ?? '';

    $router = new Router();
    $router->dispatch($url);
?>