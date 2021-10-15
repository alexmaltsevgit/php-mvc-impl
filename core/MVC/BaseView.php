<?php


namespace Core\MVC;


use Config\General;
use Core\Utils\Inclusion;


class BaseView {
  private $template_name = 'main_template';


  public function render($view_name, $data = null) {
    if (is_array($data)) {
      extract($data);
    }

    Inclusion::include_template($this->template_name);
  }


  public function set_template($template_name) {
    $path = General::$templates_path . '/' . $template_name . '.php';
    if (file_exists($path)) {
      $this->template_name = $path;
      return;
    }

    throw new \Exception("Not found template $template_name");
  }
}