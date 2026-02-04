<?php

namespace Router;

use Controller\HomeController as Home;

Class Router {


    public function dispath(){

        $url = $_SERVER['REQUEST_URI']; 
        
        $array = explode('/', $url); 

        // var_dump($array);

        $n = count($array); 

        //echo "Esse é o count do array: ".$n; 

        if(count($array) <= 5 ){
            $controller = new Home();
            $controller->index();
        
        }

    }

}