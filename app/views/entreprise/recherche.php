<h2>Recherche d'entreprises</h2>

<p>A la recherche d'une entreprise pour alternance ou pour un stage</p>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- FORMULAIRE RECHERCHE SIMPLE -->
<form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">

    <div class="search-box">
        <input type="text"
               name="nom"
               data-validate=""
               placeholder="Nom de l'entreprise"
               value="<?= $filters['nom'] ?? '' ?>">

        <button type="submit">Rechercher</button>
    </div>

</form>

<!-- Bouton Affiner (ouvre le modal) -->
<div class="search-advanced">
    <button type="button" id="btnAffiner">Affiner</button>
</div>


<!-- ZONE RESULTATS -->
<div class="results">

<?php if (!empty($results)) : ?>

    <?php foreach ($results as $entreprise) : ?>
	
        <div class="card">

            <div class="card-left">
                <h3>
                    <?= htmlspecialchars($entreprise['nom']) ?>
                </h3>
                <p><?= htmlspecialchars($entreprise['description']) ?></p>
                <div class="stars">★★★★★</div>
            </div>

            <div class="card-right">
                <a class="btn-icon edit"
                    href="/entreprise/modify/<?= $entreprise['id_entreprise'] ?>">
                    ✏
                </a>
                <a class="btn-icon delete"
                    href="/entreprise/delete/<?= $entreprise['id_entreprise'] ?>"
                    onclick="return confirm('Confirmer la suppression ?');">
                    🗑
                </a>
            </div>

        </div>

    <?php endforeach; ?>

<?php else : ?>
    <div class="card">
        <h3>Entreprise Exemple</h3>
        <p>Description exemple</p>
        <div class="stars">★★★★★</div>
    </div>
<?php endif; ?>

</div>

<button class="btn-add"
        onclick="window.location.href='/entreprise/create'">
    Ajouter
</button>


<!-- MODAL RECHERCHE AVANCEE -->
<div class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <h3>Recherche avancée</h3>

        <form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">

            <label>Description</label>
            <input type="text"
                   name="description"
		   data-validate="required|min:10"
                   value="<?= $filters['description'] ?? '' ?>">

            <label>Téléphone</label>
            <input type="text"
                   name="telephone"
		   data-validate="required|phone"
                   value="<?= $filters['telephone'] ?? '' ?>">

            <label>Email</label>
            <input type="email"
                   name="email"
                   data-validate="required|email"
                   value="<?= $filters['email'] ?? '' ?>">

            <button type="submit">Rechercher</button>

        </form>
    </div>
</div>

