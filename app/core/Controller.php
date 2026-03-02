<?php

    class Controller{
        protected function view($view, $viewData = []){

            extract($viewData);

            $viewFile = __DIR__ . '/../views/' . $view . '.php';

            if(!file_exists($viewFile)){
                throw new Exception("View file not found: ");
            }
            require_once $viewFile;
            return;
        }
    }

 ?>