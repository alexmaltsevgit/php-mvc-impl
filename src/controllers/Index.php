<?php


use Core\MVC\BaseController;


class Index extends BaseController {
  public function index() {
    $this->render('index');
  }
}