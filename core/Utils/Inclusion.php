<?php


namespace Core\Utils;


use Config\General;


class Inclusion {
  public static function include_view($view_name) {
    include General::$views_path . '/' . $view_name . '.php';
  }

  public static function include_template($template_name) {
    include General::$templates_path . '/' . $template_name . '.php';
  }
}