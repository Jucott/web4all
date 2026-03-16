<?php
require_once __DIR__ . '/../app/core/Autoloader.php';
Autoloader::register();
if (!defined('PHPUNIT_RUNNING')) {
    define('PHPUNIT_RUNNING', true);
}