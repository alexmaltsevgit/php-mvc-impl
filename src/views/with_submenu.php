<aside class="sidebar column">
    <nav class="navigation column">
        <ul>
          <?php foreach ($submenu as $item): ?>
              <li>
                  <a href="./<?= get_link($item) ?>">
                    <?= $item['title'] ?>
                  </a>
              </li>
          <?php endforeach; ?>
        </ul>
    </nav>
</aside>

<main class="main">
    <div>
        Основной контент
    </div>
</main>