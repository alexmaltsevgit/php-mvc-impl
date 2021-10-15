<?php


namespace Core\MVC;


abstract class BaseController {
  public $current_action;

  public abstract function action_index();

  protected function render($view_name, $data = null, $template = '') {
    $view = new BaseView();
    if ($template) {
      $view->set_template($template);
    }

    $view->render($view_name, $data);
  }
}