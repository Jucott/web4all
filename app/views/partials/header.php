<header class="header">
    <div class="logo"><img src="<?= CDN ?>/app-icons/icon-192.png" alt="LOGO" width="30" height="30"></div>
    <h1 class="title"><?= APP_NAME ?></h1>
    <div class="burger">☰</div>
    <?php $menus = Menu::get(); ?>
    <nav class="nav">
        <ul>
            <?php foreach ($menus as $menu => $items): ?>
                <?php if (empty($menu)){ continue; } ?>
                <li class="menu-group">
                    <span><?= htmlspecialchars($menu, ENT_QUOTES, 'UTF-8') ?></span>
                    <ul>
                    <?php foreach ($items as $item): ?>
                        <?php if ((string)($item['label']) === (string)('Login') && Auth::check()) { ?>
                        <?php } elseif ((string)($item['label']) === (string)('Logout') && !Auth::check()) { ?>
                        <?php } else { ?>
                            <li>
                                <a href="<?= $item['url'] ?>">
                                <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>

        </ul>
    </nav>
</header>
<?php if (Auth::check()): ?>
    <div class="thincard">
        <p class="role">User: <?= htmlspecialchars(Auth::user()['prenom'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars(Auth::user()['role'], ENT_QUOTES, 'UTF-8') ?>)</p>
    </div>
<?php endif ?>
