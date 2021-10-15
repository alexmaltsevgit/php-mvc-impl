<?php


require_once 'src/models/NavigationModel.php';


use Core\MVC\BaseController;


class IndexController extends BaseController {
  public function action_index() {
    $navigation_model = new NavigationModel();
    $navigation_items = $navigation_model->get_data();

    $this->render('index', [
      'css_file_name' => 'style',
      'navigation_items' => $navigation_items,
      'submenu' => []
    ]);
  }


  public function action_with_submenu() {
    $navigation_model = new NavigationModel();
    $navigation_items = $navigation_model->get_data();

    foreach ($navigation_items as $navigation_item) {
      if ($navigation_item['action'] == $this->current_action) {
        $submenu = $navigation_item['submenu'];
      }
    }

    $this->render('index', [
      'css_file_name' => 'style',
      'navigation_items' => $navigation_items,
      'submenu' => $submenu
    ]);
  }
}