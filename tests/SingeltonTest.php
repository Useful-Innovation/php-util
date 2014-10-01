<?php

use GoBrave\Util\Singleton;

class SingletonTest extends PHPUnit_Framework_TestCase
{
  public function testSingletonObjects() {
    $s1 = SingletonChild::get();
    $s2 = SingletonChild::get();

    $this->assertTrue($s1 === $s2);
  }
}
