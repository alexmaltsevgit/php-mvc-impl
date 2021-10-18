<?php


class ThreeController extends \Core\MVC\BaseController {
  public function action_index() {
    $this->render('index', [
      'css_file_name' => 'style',
      'sidebar' => 'signin'
    ]);
  }
}