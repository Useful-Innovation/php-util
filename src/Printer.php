<?php

namespace GoBrave\Util;

class Printer
{
  private $show_colors;
  private $echo;

  private $foreground_colors = array();
  private $background_colors = array();

  public function __construct($show_colors = true, $echo = false) {
    $this->show_colors = $show_colors;
    $this->echo        = $echo;

    $this->foreground_colors['black']        = '1;30';
    $this->foreground_colors['dark_gray']    = '1;30';
    $this->foreground_colors['blue']         = '1;34';
    $this->foreground_colors['light_blue']   = '1;34';
    $this->foreground_colors['green']        = '1;32';
    $this->foreground_colors['light_green']  = '1;32';
    $this->foreground_colors['cyan']         = '1;36';
    $this->foreground_colors['light_cyan']   = '1;36';
    $this->foreground_colors['red']          = '1;31';
    $this->foreground_colors['light_red']    = '1;31';
    $this->foreground_colors['purple']       = '1;35';
    $this->foreground_colors['light_purple'] = '1;35';
    $this->foreground_colors['brown']        = '1;33';
    $this->foreground_colors['yellow']       = '1;33';
    $this->foreground_colors['light_gray']   = '1;37';
    $this->foreground_colors['white']        = '1;37';
  }

  public function setEchoMode($bool) {
    $this->echo = $bool;
  }

  private function doPrint($msg) {
    if($this->echo) {
      echo $msg;
    } else {
      return $msg;
    }
  }

  public function error($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['red']) . ($new_line ? PHP_EOL : ''));
  }

  public function success($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['green']) . ($new_line ? PHP_EOL : ''));
  }

  public function info($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['light_cyan']) . ($new_line ? PHP_EOL : ''));
  }

  public function warning($msg, $new_line = true) {
    return $this->doPrint($this->getColoredString($msg, $this->foreground_colors['yellow']) . ($new_line ? PHP_EOL : ''));
  }

  public function plain($msg, $new_line = true) {
    return $this->doPrint($msg . ($new_line ? PHP_EOL : ''));
  }

  private function getColoredString($string, $foreground_color = null) {
    return chr(27) . '[' . $foreground_color . 'm' . "$string" . chr(27) . "[0m";
  }
}
