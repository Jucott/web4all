<h2>Création d'entreprise</h2>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($filters['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label for="description">Description</label>
    <textarea name="description" id="description" data-validate="required|txt|min:10"><?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

    <label for="telephone">Téléphone</label>
    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($filters['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|phone">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($filters['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|email">

    <label> Active
        <input type="checkbox"
            name="valide"
            value="1"
            <?= !isset($filters['valide']) ? 'checked' : ($filters['valide'] ? 'checked' : '') ?>>
    </label>

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='<?= CDN . PREFIX ?>/entreprise/recherche'">Annule</button>

</form>

