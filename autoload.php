<?php

spl_autoload_register(function($classe){

    $path = __DIR__. str_replace('\\', '/',$classe.'.php');

    $file = $path; 

    if(file_exists($file)){
        require_once $file;
    }

    


});