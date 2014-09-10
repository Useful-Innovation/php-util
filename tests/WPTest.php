<?php

use GoBrave\Util\Wp;

class WpTest extends PHPUnit_Framework_TestCase
{

  public function testFunction() {
    $wp = new Wp();
    $this->assertTrue($wp->strlen('333') == 3);
  }

  /**
   * @expectedException Exception
   */
  public function testWpMissingFunction() {
    $wp = new Wp();
    $wp->oaisjd();
  }
}
