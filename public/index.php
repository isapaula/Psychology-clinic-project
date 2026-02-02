<?php 


require_once 'autoload.php';

$base_path = dirname(__DIR__);

$router = new Router\Router(); 
$router->dispath();