<header class="header">
    <div class="logo"><img src="/app-icons/icon-192.png" alt="LOGO" width="30" height="30"></div>
    <h1 class="title">Web4All</h1>
    <div class="burger">☰</div>
    <?php $menus = Menu::get(); ?>
    <nav class="nav">
        <ul>
            <?php foreach ($menus as $menu => $items): ?>

                <li class="menu-group">

                <span><?= htmlspecialchars($menu) ?></span>

                <ul>

                <?php foreach ($items as $item): ?>

                    <li>
                    <a href="<?= $item['url'] ?>">
                    <?= htmlspecialchars($item['label']) ?>
                    </a>
                    </li>

                <?php endforeach; ?>

                </ul>

                </li>

            <?php endforeach; ?>

        </ul>
    </nav>
</header>
