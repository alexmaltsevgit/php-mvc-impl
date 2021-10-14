<?php


namespace Core;


use Core\Utils;
use Config\General;


class Router {
  public static function get_page() {
    $route = explode('/', $_SERVER['REQUEST_URI']);
  }
}