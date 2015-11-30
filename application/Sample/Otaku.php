<?php

namespace Sample;

class Otaku
{
  private static $name = "";
  public static function init($name)
  {
    self::$name = ucfirst($name);
  }
  public static function greeting()
  {
    if (ZettaiRyoiki::otaku()) {
      $greeting = 'Hello, ' . self::$name . '! Nya!';
    }
    else {
      $greeting = 'Hello, ' . self::$name . '!';
    }
    return $greeting;
  }
}
