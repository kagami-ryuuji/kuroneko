<?php

namespace Sample;

/**
 * Zettai ryoiki one love
 */
class ZettaiRyoiki
{
  private static $isOtaku = false;
  public static function init()
  {
    self::$isOtaku = true;
  }
  public static function otaku()
  {
    return self::$isOtaku;
  }
}
