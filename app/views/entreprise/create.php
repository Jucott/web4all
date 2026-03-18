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
    <textarea name="description" id="description" data-validate="required|alpha|min:10"><?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

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

    <label for="logo">Logo</label>
    <input type="file" id="logo" name="logo">

    <label for="date_creation">Date de création</label>
    <input type="date" id="date_creation" name="date_creation">

    <label>Evaluation</label>
    <input type="hidden" name="evaluation" id="evaluation">
    <div class="stars-rating">
        <span data-value="1">☆</span>
        <span data-value="2">☆</span>
        <span data-value="3">☆</span>
        <span data-value="4">☆</span>
        <span data-value="5">☆</span>
    </div>
    

    <label>Domaines</label>
    <label><input type="checkbox" name="domaine[]" value="d1"> Domaine 1</label>
    <label><input type="checkbox" name="domaine[]" value="d2"> Domaine 2</label>
    <label><input type="checkbox" name="domaine[]" value="d3"> Domaine 3</label>
    <label><input type="checkbox" name="domaine[]" value="d4"> Domaine 4</label>

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/entreprise/recherche'">Annule</button>

</form>

