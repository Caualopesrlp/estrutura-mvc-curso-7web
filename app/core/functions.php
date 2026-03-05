<?php 
     function dd(... $vars){
        echo '<strong> Debug: <strong/> <br/> ';
        foreach ($vars as $var){
            echo '<pre>';
            var_dump($var);
            echo '<pre>';
        }

        $backtrace = debug_backtrace()[0];    
        die();
     }

     function config($key, $default = null){
        $config = require_once __DIR__ . '/../config/config.php';
        return $config[$key] ?? $default;
     }
?>