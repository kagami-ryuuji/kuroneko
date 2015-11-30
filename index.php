<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require 'application/Kernel/Autoloader.php';

$uri_a = explode('?', $_SERVER["REQUEST_URI"]);
$uri = trim($uri_a[0], '/');

$autoloader = new Kernel\Autoloader();
$autoloader->register();

Kernel\Kernel::main($uri);
