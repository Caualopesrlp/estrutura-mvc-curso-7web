<?php 
     function dd(... $vars){
        echo '<pre/>';
        echo '<strong> Debug: <strong/> <br/> ';
        foreach ($vars as $var){
            echo '<pre/>';
            var_dump($var);
            echo '</pre>';
        }

        $backtrace = debug_backtrace()[0];    
        die();
     }
?>