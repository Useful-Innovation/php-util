<?php

class SingletonChild extends \GoBrave\Util\Singleton { }
class CollectionData
{
  private $id;
  private $value;

  public function __construct($id, $value) {
    $this->id = $id;
    $this->value = $value;
  }

  public function id() {
    return $this->id;
  }

  public function title() {
    return $this->value;
  }
}
