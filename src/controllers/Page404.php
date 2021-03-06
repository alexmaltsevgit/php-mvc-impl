<?php


require_once 'src/models/Navigation.php';


use Core\MVC\BaseView;


class Page404Controller extends BaseView {
  public function action_index() {
    $navigation_model = new NavigationModel();
    $navigation_items = $navigation_model->get_data();

    $this->render('404', [
      'css_file_name' => 'style',
      'sidebar' => 'signin'
    ]);
  }
}