<h2>Création d'entreprise</h2>

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
    <input type="text" name="nom" value="<?= $filters['nom'] ?? '' ?>" data-validate="required|alpha">

    <label>Description</label>
    <textarea name="description" value="<?= $filters['description'] ?? '' ?>" data-validate="required|alpha|min:10"></textarea>

    <label>Téléphone</label>
    <input type="text" name="telephone" value="<?= $filters['telephone'] ?? '' ?>" data-validate="required|phone">

    <label>Email</label>
    <input type="email" name="email" value="<?= $filters['email'] ?? '' ?>" data-validate="required|email">

    <label>
        <input type="checkbox" name="active"> Active
    </label>

    <label>Logo</label>
    <input type="file" name="logo">

    <label>Date de création</label>
    <input type="date" name="date_creation">

    <label>Evaluation</label>
    <div class="stars-rating">
        <span data-value="1">☆</span>
        <span data-value="2">☆</span>
        <span data-value="3">☆</span>
        <span data-value="4">☆</span>
        <span data-value="5">☆</span>
    </div>
    <input type="hidden" name="evaluation" id="evaluation">

    <label>Domaines</label>
    <label><input type="checkbox" name="domaine[]" value="d1"> Domaine 1</label>
    <label><input type="checkbox" name="domaine[]" value="d2"> Domaine 2</label>
    <label><input type="checkbox" name="domaine[]" value="d3"> Domaine 3</label>
    <label><input type="checkbox" name="domaine[]" value="d4"> Domaine 4</label>

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/entreprise/recherche'">Annule</button>

</form>

