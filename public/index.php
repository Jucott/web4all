<?php

session_start();

require_once __DIR__ . '/../app/core/Autoloader.php';
Autoloader::register();

$router = new Router();
$router->dispatch();
