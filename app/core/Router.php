<?php
namespace App\Core;


class Router {

    public function dispatch($url){

        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        $controllerName = ucfirst($parts[0] ?? 'Home') . 'Controller';
        $controllerClass = 'App\\Controllers\\' . $controllerName;
                                                                                                                               
        if (class_exists($controllerClass)) {

            $controller = new $controllerClass();

            $actionName = $parts[1] ?? 'index';

            if (method_exists($controller, $actionName)) {

                $params = array_slice($parts, 2);
                call_user_func_array([$controller, $actionName], $params);

            } else {

                $error = new \App\Controllers\Errors\ErrorController();
                $error->NotFound();

            }

        } else {

            $error = new \App\Controllers\Errors\ErrorController();
            $error->NotFound();

        }
    }
}