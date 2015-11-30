<?php

namespace Kernel;

use Kernel\Routing\Route;

class Kernel
{
  private static $arguments = array();
  // used by node machine for get route parameters
  public static function arg($name)
  {
    return self::$arguments[$name];
  }
  // Main function. As in C
  public static function main($uri)
  {
    if (file_exists('application/bootstrap.php')) {
      include 'application/bootstrap.php';
    }
    $routes = json_decode(file_get_contents('application/routes.json'));
    foreach ($routes as $route) {
      Route::add($route);
    }
    $route = Route::find($uri);
    self::$arguments = $route->arguments;
    foreach ($route->initialNodes as $init) {
      Node\NodeMachine::run($init);
    }
    $output = Node\NodeMachine::run($route->nodes);
    echo $output;
  }
}
