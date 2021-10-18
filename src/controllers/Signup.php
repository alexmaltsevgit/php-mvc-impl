<?php


require_once 'src/models/User.php';


use Core\Database;
use Core\HttpArgumentsProvider;
use Core\MVC\BaseController;
use Core\Session;


class SignupController extends BaseController {
  use FormFilter;

  public function action_index() {
    $session = new Session();
    if ($session->get_is_authenticated()) {
      $this->redirect();
      return;
    }

    $this->render('signup', [
      'css_file_name' => 'style',
      'sidebar' => 'signup'
    ]);
  }


  public function action_try() {
    $fields = HttpArgumentsProvider::POST();

    $this->sanitize_fields($fields);
    $is_email = $this->filter_email($fields['email']);
    $is_username = $this->validate_username($fields['username']);
    $is_password = $this->validate_password($fields['password'], 8);
    $is_age = $this->validate_age($fields['birthdate'], 18);

    $validated = ($is_age && $is_email && $is_password && $is_username);
    if ($validated) {
      $db = new Database();
      $db->insert_into('user')
        ->values([
          ['column' => 'username' , 'value' => $fields['username']],
          ['column' => 'password' , 'value' => password_hash($fields['password'], PASSWORD_DEFAULT)], // hash password
          ['column' => 'email' , 'value' => $fields['email']],
          ['column' => 'realname' , 'value' => $fields['realname']],
          ['column' => 'birthdate' , 'value' => $fields['birthdate']],
          ['column' => 'is_admin' , 'value' => 0, 'type' => 'i'], // not admin
        ])
        ->exec();

      $session = new Session();
      $session->authenticate($db->get_last_id());
    }

    echo json_encode($validated);
  }
}