<h2>Modification d'offre</h2>

<script src="<?= CDN ?>/js/modules/offre.js"></script>


<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form id="formOffre" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <label for="titre">Titre</label>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($offre['titre'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label for="description">Description</label>
    <textarea name="description" id="description" data-validate="required|txt"><?= htmlspecialchars($offre['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

    <label for="base_remuneration">Base de rémunération</label>
    <input type="number" name="base_remuneration" id="base_remuneration" value="<?= (int)($offre['base_remuneration']) ?>" data-validate="required|integer">

    <label for="date_offre">Date de l'offre</label>
    <input type="date" id="date_offre" name="date_offre" value="<?= htmlspecialchars($offre['date_offre'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|date">

    <label> Active
        <input type="checkbox"
            name="valide"
            value="1"
            <?= !isset($offre['valide']) ? 'checked' : ($offre['valide'] ? 'checked' : '') ?>>
    </label>

    <label>Entreprise</label>
    <select name="id_entreprise">
        <?php foreach ($entreprises as $entreprise): ?>
            <option value="<?= $entreprise['id_entreprise'] ?>"
                <?= (isset($offre['id_entreprise']) && (string)($offre['id_entreprise']) === (string)($entreprise['id_entreprise'])) ? 'selected' : '' ?>>
                <?= htmlspecialchars($entreprise['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <hr/>

    <label>Compétences requises</label>

    <select id="competence-select">
        <option value="">-- Choisir une compétence --</option>
        <?php foreach ($competences as $c): ?>
            <option value="<?= $c['id_competence'] ?>">
                <?= htmlspecialchars($c['competence']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="button" id="add-competence">Ajouter</button>

    <div id="competences-container" class="competences-container">
        <?php if (!empty($selectedCompetences)): ?>

            <?php foreach ($selectedCompetences as $c): ?>
                <div class="competence-item">
                    <?= htmlspecialchars($c['competence']) ?>
                    <button type="button" class="remove">X</button>
                    <input type="hidden" name="competences[]" value="<?= $c['id_competence'] ?>">
                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <p class="placeholder">Aucune compétence sélectionnée</p>

        <?php endif; ?>
    </div>

    <hr/>
    
    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/offre/recherche'">Annule</button>

</form>

