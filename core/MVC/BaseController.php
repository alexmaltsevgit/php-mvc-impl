<?php


namespace Core\MVC;


class BaseController {
  private function render($view_name, $data = null, $template = '') {
    $view = new BaseView();
    if ($template) {
      $view->set_template($template);
    }

    $view->render($view_name, $data);
  }
}