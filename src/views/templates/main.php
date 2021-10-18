<?php


require_once 'src/models/Navigation.php';


use Config\General;


$navigation_model = new NavigationModel();
$navigation_items = $navigation_model->get_data();

function get_link($item) {
  return './' . $item['controller'] . '/' . $item['action'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/php-mvc-impl/src/assets/<?= $css_file_name . '.css' ?>">

    <title>RTK</title>
</head>
<body>

<header class="header">
    <a href="/php-mvc-impl/" class="logo">Логотип</a>
    <nav class="navigation row">
        <ul>
            <?php foreach ($navigation_items as $item): ?>
                <li>
                    <a href="/php-mvc-impl/<?= get_link($item) ?>">
                      <?= $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<?php include General::$views_path . '/sidebars/' . $sidebar . '.php'; ?>
<?php include General::$views_path . '/' . $view . '.php'; ?>

<footer class="footer">
    Футер
</footer>

</body>
</html>