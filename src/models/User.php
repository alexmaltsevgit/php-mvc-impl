<?php


use Core\Database;
use Core\MVC\BaseModel;


class User extends BaseModel {
  private $table = 'user';


  public function get_data() {
    $db = new Database();
    $users = $db->selectAll()->from($this->table)->exec();

    return $users;
  }
}