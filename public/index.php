<?php 
session_start();

require_once 'autoload.php';

$router = new Router\Router(); 
$router->dispatch();