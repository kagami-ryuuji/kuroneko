<?php

namespace Kernel\Node;

use Kernel\Kernel;

class NodeMachine
{
  public static function run($node)
  {
    if (is_object($node) && property_exists($node, '@template')) {
      $template = Template::name($node->{'@template'});
      foreach ($node as $inputName => $inputValue) {
        if ('@template' !== $inputName) {
          $template->input($inputName, self::run($inputValue));
        }
      }
      return $template;
    }
    if (is_object($node) && property_exists($node, '@service')) {
      $service = Service::name($node->{'@service'});
      if (property_exists($node, '@params')) {
        foreach ($node->{'@params'} as $inputValue) {
          $service->input(self::run($inputValue));
        }
      }
      return $service->execute();
    }
    if (is_string($node) && 1 === preg_match('/^\[(\w+)\]$/', $node, $matches)) {
      return Kernel::arg(lcfirst($matches[1]));
    }
    return $node;
  }
}
