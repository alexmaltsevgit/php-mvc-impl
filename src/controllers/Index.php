<?php


require_once 'src/models/Navigation.php';


use Core\MVC\BaseController;


class IndexController extends BaseController {
  public function action_index() {
    $this->render('index', [
      'css_file_name' => 'style',
      'sidebar' => 'signin'
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

    $this->render('with_submenu', [
      'css_file_name' => 'style',
      'sidebar' => 'submenu',
      'submenu' => $submenu
    ]);
  }
}