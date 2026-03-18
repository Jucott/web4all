<h1>Plan du site</h1>

<div class="results">
    <?php if (!empty($pages)) : ?>
        <div class="card">
            <ul>
                <?php foreach ($pages as $page): ?>
                <li>
                    <p class="role"><strong><?= htmlspecialchars($page['menu']).' '.htmlspecialchars($page['label']) ?></strong></p>
                    <p class="info"><a 
                            href="<?= 'http://localhost/' . htmlspecialchars($page['url']) ?>">
                            <?= htmlspecialchars($page['url']) ?>
                        </a>
                    </p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>