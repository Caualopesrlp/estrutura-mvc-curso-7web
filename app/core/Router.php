<?php
namespace app\core;

use Controller;
use ErrorController;

class Router {

    public function dispatch($url){

        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        $controllerName = $parts[0] ?? 'Home';
        $controllerName = ucfirst($controllerName) . 'Controller';
        $controllerFile = __DIR__ . "/../controllers/$controllerName.php";
                                                                                                                               
        if (file_exists($controllerFile)) {

            require_once($controllerFile);
            $controller = new $controllerName();

            $actionName = $parts[1] ?? 'index';

            if (method_exists($controller, $actionName)) {

                $params = array_slice($parts, 2);
                call_user_func_array([$controller, $actionName], $params);

            } else {

                require_once(__DIR__ . "/../controllers/errors/ErrorController.php");
                $error = new ErrorController();
                $error->NotFound();

            }

        } else {

            require_once(__DIR__ . "/../controllers/errors/ErrorController.php");
            $error = new ErrorController();
            $error->NotFound();

        }
    }
}