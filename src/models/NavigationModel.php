<?php


class NavigationModel extends \Core\MVC\BaseModel {
  public function get_data() {
    return [
      [
        'title' => 'Раз',
        'controller' => 'one',
        'action' => ''
      ],
      [
        'title' => 'Меню с подменю',
        'controller' => 'index',
        'action' => 'with_submenu',
        'submenu' => [
          [
            'title' => 'Раз',
            'controller' => 'one',
            'action' => ''
          ],
          [
            'title' => 'Два',
            'controller' => 'two',
            'action' => ''
          ],
          [
            'title' => 'Три',
            'controller' => 'three',
            'action' => ''
          ],
          [
            'title' => 'Четыре',
            'controller' => 'four',
            'action' => ''
          ],
        ]
      ],
      [
        'title' => 'Три',
        'controller' => 'three',
        'action' => ''
      ]
    ];
  }
}