<?php


use Core\MVC\BaseView;


class Page404Controller extends BaseView {
  public function action_index() {
    $this->render('404');
  }
}