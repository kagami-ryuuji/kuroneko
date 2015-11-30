<?php

namespace Kernel;

class Autoloader
{
  final public function register()
  {
    spl_autoload_register(array($this, 'load'));
  }
  final public function load($class)
  {
    $class = str_replace('\\', '/', $class);
    $baseDir = 'application/';
    $file = $baseDir . $class . '.php';
    if (!file_exists($file)) {
      return;
    }
    include $file;
  }
}
