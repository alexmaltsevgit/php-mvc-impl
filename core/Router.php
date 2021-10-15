<?php


namespace Core;


use Core\Utils\Debug;
use Config\General;


class Router {
  private $controller_suffix = 'Controller';
  private $action_prefix = 'action_';

  private $default_controller;
  private $default_action;

  private $current_route;


  public function __construct() {
    $this->default_controller = General::$default_controller;
    $this->default_action = General::$default_action;
    $this->set_current_route();
  }


  public function get_page() {
    $this->set_current_route();
    $controller = $this->get_current_controller();
    $action = $this->get_current_action();

    $is_controller_included = $this->try_include_controller($controller);
//    if (!$is_controller_included) {
//      $this->get_404();
//      return;
//    }

    $is_controller_method_invoked = $this->try_invoke_controller_method($controller, $action);
//    if (!$is_controller_method_invoked) {
//      $this->get_404();
//      return;
//    }
  }


  private function set_current_route() {
    $this->current_route = explode('/', $_SERVER['REQUEST_URI']);
  }


  private function get_current_controller() {
    if (!empty($this->current_route[2])) {
      return ucfirst($this->current_route[2]);
    }

    return $this->default_controller;
  }


  private function get_current_action() {
    if (!empty($this->current_route[3])) {
      return $this->current_route[3];
    }

    return $this->default_action;
  }


  private function try_include_controller($controller) {
    $path = General::$controllers_path . '/' . $controller . '.php';

    if (file_exists($path)) {
      include $path;
      return true;
    }

    return false;
  }


  private function try_invoke_controller_method($controller, $method) {
    $controller_name = $controller . $this->controller_suffix;
    $controller_instance = new $controller_name;

    $method_name = $this->action_prefix . $method;

    if (method_exists($controller_instance, $method_name)) {
      $controller_instance->$method_name();
      return true;
    }

    return false;
  }


  private function get_404() {
    $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:' . $host . '404');
  }
}