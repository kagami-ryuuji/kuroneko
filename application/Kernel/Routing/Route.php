<?php

namespace Kernel\Routing;

class Route
{
  private static $list = array();
  public static function add(\stdClass $routeElement) {
    self::$list[] = new self($routeElement);
  }
  public static function find($uri) {
    foreach (self::$list as $route) {
      if (1 === preg_match($route->uriTemplate, $uri, $matches)) {
        $route->arguments = array_combine($route->names, array_slice($matches, 1));
        return $route;
      }
    }
    return null;
  }
  private $uriTemplate;
  public $initialNodes;
  public $nodes;
  public $arguments;
  private $names;
  private function __construct(\stdClass $routeElement)
  {
    $this->uriTemplate = $routeElement->when;
    $this->initialNodes = $routeElement->then->init;
    $this->nodes = $routeElement->then->output;
    $this->compile();
  }
  private function compile()
  {
    $compiledUri = str_replace(
      array('/', '.', '[', ']'),
      array('\/', '\.', '(?:', ')?'),
      $this->uriTemplate
    );
    preg_match_all('/(?:\{(\w+)\:(\w+)\})/', $compiledUri, $matches);
    $this->names = $matches[1];
    $compiledUri = preg_replace(
      array('/(?:\{\w+\:string\})/', '/(?:\{\w+\:integer\})/'),
      array('(\w+(?:-\w+)*)', '(\d+)'),
      $compiledUri
    );
    $this->uriTemplate = "/^{$compiledUri}$/";
  }
}
