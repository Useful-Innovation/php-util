<?php

namespace GoBrave\Util;

interface LoggerInterface
{
  public function success($str);
  public function warning($str);
  public function error($str);
  public function info($str);
}
