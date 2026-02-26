<h2>Modification d'entreprise</h2>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">

    <label>Nom</label>
    <input type="text" name="nom" value="<?= $entreprise['nom'] ?? '' ?>" data-validate="required|alpha">

    <label>Description</label>
    <textarea name="description" data-validate="required|alpha|min:10"><?= $entreprise['description'] ?? '' ?></textarea>

    <label>Téléphone</label>
    <input type="text" name="telephone" value="<?= $entreprise['telephone'] ?? '' ?>" data-validate="required|phone">

    <label>Email</label>
    <input type="email" name="email" value="<?= $entreprise['email'] ?? '' ?>" data-validate="required|email">

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/entreprise/recherche'">Annule</button>

</form>

