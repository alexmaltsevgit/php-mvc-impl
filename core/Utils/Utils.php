<?php


namespace Core;


class Utils {
  public static function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }
}