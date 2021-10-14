<?php

function autoload($path) {
  $items = glob($path . DIRECTORY_SEPARATOR . "*");

  foreach ($items as $item) {
    if (is_dir($item)) {
      autoload($item);
      continue;
    }

    $is_php = pathinfo($item)["extension"] === "php";

    if ($is_php) {
      require_once $item;
    }
  }
}

autoload(dirname(__FILE__));
