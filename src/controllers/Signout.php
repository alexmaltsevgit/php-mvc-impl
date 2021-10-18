<?php


use Core\Session;


class SignoutController extends \Core\MVC\BaseController {
  public function action_index() {
    $this->redirect();
  }

  public function action_try() {
    $session = new Session();
    $session->unauthenticate();
    echo json_encode(true);
  }
}