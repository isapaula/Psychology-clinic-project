<?php


spl_autoload_register(function($classe){

    $path = dirname(__DIR__).'/App/'.str_replace('\\', '/',$classe).'.php';

    $file = $path; 

        if(file_exists($file)){
            require_once $file;
        }else{

            throw new Exception("Arquivo: -- {$file} -- não encontrado! E Classe: -- {$classe} -- não encontrada !");
        }
        
   
});