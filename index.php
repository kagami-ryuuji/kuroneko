<?php

require 'application/Kernel/Autoloader.php';

$uri_a = explode('?', $_SERVER["REQUEST_URI"]);
$uri = trim($uri_a[0], '/');

$autoloader = new Kernel\Autoloader();
$autoloader->register();

Kernel\Kernel::main($uri);
