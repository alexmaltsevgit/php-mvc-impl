<?php


namespace Core;


use Core\Utils\Debug;
use DateTime;
use Exception;


class Session {
  private static $session;


  public function start() {
    session_start();

    self::$session = &$_SESSION;

    $this->ensure_field_exists('is_authenticated', false);
    $this->ensure_field_exists('authentication_expiration', 0);
    $this->ensure_field_exists('userid', -1);
    $this->ensure_field_exists('is_admin', false);
  }


  public function authenticate($userid, $is_admin = 0) {
    $this->set_userid($userid);
    $this->set_is_authenticated(true);
    $this->set_is_admin($is_admin);

    $expires_at = strtotime('+' . \Config\Session::$auto_auth_period, time());
    $this->set_authentication_expiration($expires_at);
  }


  public function unauthenticate() {
    $this->set_userid(-1);
    $this->set_is_authenticated(false);
    $this->set_is_admin(0);
    $this->set_authentication_expiration(0);
  }


  public function unauthenticate_if_time_expired() {
    $expiration_timestamp = $this->get_authentication_expiration();
    $now = time();

    if ($now > $expiration_timestamp) {
      $this->unauthenticate();
    }
  }


  public function get_is_authenticated() {
    return self::$session['is_authenticated'];
  }


  public function get_authentication_expiration() {
    return self::$session['authentication_expiration'];
  }


  public function get_is_admin() {
    return self::$session['is_admin'];
  }


  public function get_userid() {
    return self::$session['userid'];
  }


  public function set_authentication_expiration($timestamp) {
    self::$session['authentication_expiration'] = $timestamp;
  }


  public function set_is_authenticated($value) {
    self::$session['is_authenticated'] = $value;
  }


  public function set_is_admin($value) {
    self::$session['is_admin'] = $value;
  }


  public function set_userid($userid) {
    self::$session['userid'] = $userid;
  }


  private function ensure_field_exists($field, $default) {
    if (!isset(self::$session[$field])) {
      self::$session[$field] = $default;
    }
  }
}