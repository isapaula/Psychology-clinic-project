<?php

use Dotenv\Dotenv;

session_start();

require_once 'autoload.php';
require_once dirname(__DIR__, 1). '/vendor/autoload.php';

$path = dirname(__FILE__,2).'\\'; 


$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

$router = new Router\Router(); 
$router->dispatch();
