<?php


namespace Core;


use Core\Utils\Debug;
use Exception;


class Session {
  public function start() {
    session_start();
  }


  public function is_authenticated() {
    return $_SESSION['is_authenticated'];
  }


  public function is_admin() {
    return $_SESSION['is_admin'];
  }


  public function set_is_authenticated($value) {
    $_SESSION['is_authenticated'] = $value;
  }


  public function set_is_admin($value) {
    $_SESSION['is_admin'] = $value;
  }
}