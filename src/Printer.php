<?php

namespace GoBrave\Util;

class Printer
{
  private $echo;
  private $foreground_colors = [
    'black'        => '1;30',
    'dark_gray'    => '1;30',
    'blue'         => '1;34',
    'light_blue'   => '1;34',
    'green'        => '1;32',
    'light_green'  => '1;32',
    'cyan'         => '1;36',
    'light_cyan'   => '1;36',
    'red'          => '1;31',
    'light_red'    => '1;31',
    'purple'       => '1;35',
    'light_purple' => '1;35',
    'brown'        => '1;33',
    'yellow'       => '1;33',
    'light_gray'   => '1;37',
    'white'        => '1;37'
  ];

  public function __construct($echo = true) {
    $this->echo = $echo;
  }

  public function setEchoMode($bool) {
    $this->echo = $bool;
  }

  private function doPrint($msg, $new_line) {
    $msg = $new_line ? $msg . PHP_EOL : $msg;
    if($this->echo) {
      echo $msg;
    } else {
      return $msg;
    }
  }

  public function error($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['red']), $new_line);
  }

  public function success($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['green']), $new_line);
  }

  public function info($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['light_cyan']), $new_line);
  }

  public function warning($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['yellow']), $new_line);
  }

  public function plain($msg, $new_line = true) {
    return $this->doPrint($msg, $new_line);
  }

  private function getColoredString($string, $foreground_color = null) {
    return chr(27) . '[' . $foreground_color . 'm' . "$string" . chr(27) . "[0m";
  }
}
