<?php

namespace GoBrave\Util;

class SingPlur
{
  public static $plural_to_singular = array(
  );

  public static $singular_to_plural = array(
  );

  public static function singularize($word) {
    $word = strtolower($word);
    if(isset(self::$plural_to_singular[$word])) {
      return self::$plural_to_singular[$word];
    }

    if(substr($word, strlen($word) - 3) === 'ies') {
      return substr($word, 0, strlen($word) - 3) . 'y';
    }

    return substr($word, 0, strlen($word) - 1);
  }

  public static function pluralize($word) {
    $word = strtolower($word);
    if(isset(self::$singular_to_plural[$word])) {
      return self::$singular_to_plural[$word];
    }

    if(substr($word, strlen($word) - 1) === 'y') {
      return substr($word, 0, strlen($word) - 1) . 'ies';
    }

    return $word . 's';
  }
}
