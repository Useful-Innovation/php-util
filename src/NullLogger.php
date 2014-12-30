<?php

namespace GoBrave\Util;

class NullLogger implements LoggerInterface
{
  public function success($str) {}
  public function warning($str) {}
  public function error($str)   {}
  public function info($str)    {}
}
