<?php


namespace Core\Utils;


class Debug {
  public static function log($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }
}