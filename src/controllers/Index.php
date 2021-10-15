<?php


use Core\MVC\BaseController;


class IndexController extends BaseController {
  public function action_index() {
    $this->render('index', [
      'css_file_name' => 'style'
    ]);
  }
}