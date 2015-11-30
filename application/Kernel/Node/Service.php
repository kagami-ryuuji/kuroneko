<?php

namespace Kernel\Node;

class Service
{
  private static $list = array();
  public static function name($spec)
  {
    if (1 === preg_match('/^\[(\w+(?:\.\w+)*)\s+(\w+)\]$/', $spec, $matches)) {
      return new self($spec, $matches[1], $matches[2]);
    } else {
      throw new \Exception('Service ID not recognized: ' . $spec);
    }
  }
  private $arguments = array();
  private function __construct($spec, $class, $method)
  {
    $this->spec = $spec;
    $this->fun = array(str_replace('.', '\\', $class), lcfirst($method));
  }
  public function input($value)
  {
    $this->arguments[] = $value;
  }
  public function execute()
  {
    if (!isset(self::$list[$this->spec])) {
      self::$list[$this->spec] = call_user_func_array($this->fun, $this->arguments);
    }
    return self::$list[$this->spec];
  }
}
