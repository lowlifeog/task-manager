<?php

define('ROOT', __DIR__);

require_once ROOT . '/Core/Autoload.php';

$router = new Core\Router();
$router->dispatch($_SERVER['QUERY_STRING']);