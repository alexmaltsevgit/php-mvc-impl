<?php


namespace Core;


use Config\DB;
use Core\Utils\Debug;
use mysqli;


class Database {
  private static $connection = null;
  private $query = '';
  private $types = [];
  private $values = [];


  public function __construct() {
    if (!self::$connection) {
      self::$connection = new mysqli(
        DB::$server,
        DB::$username,
        DB::$password,
        DB::$databse
      );

      if (self::$connection->connect_error) {
        die("Database connection failed: " . self::$connection->connect_error);
      }
    }
  }


  public function exec() {
    if (empty($this->values)) {
      $res = $this->exec_simple();
    } else {
      $res =  $this->exec_parameterized();
    }

    $this->clear_query();
    return $res;
  }


  public function clear_query() {
    $this->query = '';
    $this->types = [];
    $this->values = [];
  }


  public function select(...$columns) {
    $this->query = 'SELECT ';

    foreach ($columns as $column) {
      $this->query .= $column . ' ';
    }

    return $this;
  }

  public function selectAll() {
    $this->query = 'SELECT * ';
    return $this;
  }


  public function from($table) {
    $this->query .= "FROM $table ";
    return $this;
  }


  public function where($params) {
    $this->query .= 'WHERE ';

    foreach ($params as $param) {
      $this->query .= "${param['column']}=? ";

      if (!isset($param['type'])) {
        $type = 's';
      } else {
        $type = $param['type'];
      }

      $value = $param['value'];
      array_push($this->types, $type);
      array_push($this->values, $value);
    }

    return $this;
  }


  public function insert_into($table, $columns = []) {
    $this->query = "INSERT INTO $table ";

    if (!empty($columns)) {
      $this->query .= '(';
      foreach ($columns as $index => $column) {
        $ending = ($index === count($columns) - 1)
          ? ') '
          : ', ';

        $this->query .= $column . $ending;
      }
    }

    return $this;
  }


  public function values($params) {
    $this->query .= '(';
    foreach ($params as $index => $param) {
      $ending = ($index === count($params) - 1)
        ? ') '
        : ', ';

      $this->query .= $param['column'] . $ending;
    }

    $this->query .= 'VALUES (';
    foreach ($params as $index => $param) {
      $ending = ($index === count($params) - 1)
        ? ') '
        : ', ';

      $this->query .= '?' . $ending;

      if (!isset($param['type'])) {
        $type = 's';
      } else {
        $type = $param['type'];
      }

      $value = $param['value'];
      array_push($this->types, $type);
      array_push($this->values, $value);
    }

    return $this;
  }


  public function get_last_id() {
    return self::$connection->insert_id;
  }


  private function exec_parameterized() {
    $types = '';
    foreach ($this->types as $type) {
      $types .= $type;
    }

    $stmt = self::$connection->prepare($this->query);
    $stmt->bind_param($types, ...$this->values);


    $stmt->execute();

    return $stmt->get_result();
  }


  private function exec_simple() {
    $stmt = self::$connection->prepare($this->query);
    $stmt->execute();

    return $stmt->get_result();
  }
}
