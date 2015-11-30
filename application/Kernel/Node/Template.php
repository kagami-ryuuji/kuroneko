<?php

namespace Kernel\Node;

class Template {
  private $name = "";
  private $vars = array();
  public static function name($templatename) {
    return new self($templatename);
  }
  private function __construct($name) {
    $this->includePath = 'application/' . str_replace('.', '/', $name) . '.php';
  }
  public function input($varName, $value) {
    $this->vars[lcfirst($varName)] = $value;
    return $this;
  }
  public function render() {
    extract($this->vars, EXTR_SKIP);
    ob_start();
    include $this->includePath;
    return ob_get_clean();
  }
  public function __get($key) {
    if (array_key_exists($key, $this->vars)) {
      return $this->vars[$key];
    }
  }
  public function __set($key, $value) {
    $this->vars[$key] = $value;
  }
  public function __isset($key) {
    return isset($this->vars[$key]);
  }
  public function __unset($key) {
    unset($this->vars[$key]);
  }
  public function __toString() {
    return $this->render();
  }
}
