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
    <a href="./" class="logo">Логотип</a>
    <nav class="navigation row">
        <ul>
            <?php foreach ($navigation_items as $item): ?>
                <li>
                    <?php
                        $link = ($item['action']
                            ? $item['controller'] . '/' . $item['action']
                            : $item['controller']
                        )
                    ?>
                    <a href="./<?= $link ?>">
                      <?= $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<aside class="sidebar column">
    <nav class="navigation column">
        <ul>
          <?php foreach ($submenu as $item): ?>
              <li>
                <?php
                $link = ($item['action']
                  ? $item['controller'] . '/' . $item['action']
                  : $item['controller']
                )
                ?>
                  <a href="./<?= $link ?>">
                    <?= $item['title'] ?>
                  </a>
              </li>
          <?php endforeach; ?>
        </ul>
    </nav>
</aside>

<main class="main">
    <?php \Core\Utils\Inclusion::include_view($view_name); ?>
</main>

<footer class="footer">
    Футер
</footer>

</body>
</html>