<?php

namespace GoBrave\Util;

class WP implements IWP
{
  public function __call($function, $args) {
    if($this->exists($function)) {
      return call_user_func_array($function, $args);
    }
    throw new \Exception('Function \'' . $function . '\' does not exist');
  }

  public function exists($function) {
    return function_exists($function);
  }
}
