<?php


use Config\General;
use Core\Database;
use Core\HttpArgumentsProvider;
use Core\MVC\BaseController;
use Core\Session;


class SigninController extends BaseController {
  use FormFilter;

  public function action_index() {
    $this->redirect();
  }

  public function action_try() {
    $fields = HttpArgumentsProvider::POST();
    $db = new Database();
    $session = new Session();

    $res = $db->select('id, password')
      ->from('user')
      ->where([['column' => 'username', 'value' => $fields['username']]])
      ->exec()
      ->fetch_assoc();

    if (isset($res['id'])) {
      $id = $res['id'];
      $hashed_password = $res['password'];
    } else {
      echo json_encode(false);
      return;
    }

    $verified = password_verify($fields['password'], $hashed_password);

    if ($verified) {
      $session->authenticate($id);
      echo json_encode(true);
    } else {
      echo json_encode(false);
    }
  }
}