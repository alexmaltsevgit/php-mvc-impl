<?php


namespace Core;


class HttpArgumentsProvider {
  public static function GET() {
    return (!empty($_GET)) ? $_GET : null;
  }


  public static function POST() {
    return (!empty($_POST)) ? $_POST : null;
  }
}