<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/php-mvc-impl/src/assets/<?= $css_file_name . '.css' ?>">

    <title>RTK</title>
</head>
<body>

<header class="header">
    <a href="./" class="logo">Логотип</a>
    <nav class="navigation row">
        <ul>
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
        </ul>
    </nav>
</header>

<aside class="sidebar column">
    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
    </ul>
</aside>

<main class="main">
    <?php \Core\Utils\Inclusion::include_view($view_name); ?>
</main>

<footer class="footer">
    Футер
</footer>

</body>
</html>