<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Web4All') ?></title>
    <meta name="description" content="<?= htmlspecialchars($description ?? 'Site Web pour trouver des entreprises et stages') ?>">
    <meta name="robots" content="<?= htmlspecialchars($robots ?? 'index,follow') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2c3e50">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/modules/menu.js"></script>
    <script src="/js/modules/modal.js"></script>
    <script src="/js/modules/form-validation.js"></script>
    <script src="/js/modules/stars.js"></script>
    <script src="/js/app.js"></script>
</head>

<body>

<?php require __DIR__ . '/partials/header.php'; ?>

<main class="container">
    <?= $content ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
