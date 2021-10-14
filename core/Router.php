<?php


namespace Core;


class Router {
  public static function get_page() {
    $route = explode('/', $_SERVER['REQUEST_URI']);
  }
}