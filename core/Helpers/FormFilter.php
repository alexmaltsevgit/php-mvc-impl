<?php


use Core\Database;


trait FormFilter {
  protected function sanitize_fields(&$fields) {
    $fields = filter_var_array($fields, FILTER_SANITIZE_STRING);
  }


  protected function filter_email(&$email) {
    $this->sanitize_email($email);
    return $this->validate_email($email);
  }


  protected function sanitize_email(&$email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  }


  protected function validate_email($email) {
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
  }


  protected function validate_username($username) {
    $db = new Database();
    $same_usernames = $db
      ->select('id')
      ->from('user')
      ->where([[
        'column' => 'username',
        'value' => $username
      ]])
      ->exec()
      ->fetch_all();

    return !(bool)count($same_usernames);
  }


  protected function validate_password($password, $min_length) {
    return mb_strlen($password) >= $min_length;
  }


  protected function validate_age($birtdate, $min_age) {
    $current_date = new DateTime(date('d-m-Y'));
    $birtdate = new DateTime($birtdate);

    $age = $birtdate->diff($current_date)->y;
    return $age >= 18;
  }
}