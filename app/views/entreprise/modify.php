<h2>Modification d'entreprise</h2>

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
    <label>Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($entreprise['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label>Description</label>
    <textarea name="description" data-validate="required|txt"><?= htmlspecialchars($entreprise['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

    <label>Téléphone</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($entreprise['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|phone">

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($entreprise['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|email">

    <label for="valide">Active</label>
    <input type="checkbox"
       name="valide"
       id="valide"
       value="1"
       <?= $entreprise['valide'] ? 'checked' : '' ?>>

    <p>Dernière mise a jour le <?= htmlspecialchars($entreprise['valide_lastupdate'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='<?= CDN . PREFIX ?>/entreprise/recherche'">Annule</button>

</form>

