<h2>Recherche d'entreprises</h2>

<p>A la recherche d'une entreprise pour alternance ou pour un stage</p>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- FORMULAIRE RECHERCHE SIMPLE -->
<form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
    <input type="hidden" name="valide" value="<?= $filters['valide'] ? 1 : 0 ?>">
    <div class="search-box">
        <input type="text"
               name="nom"
               data-validate="optional|alpha"
               placeholder="Nom de l'entreprise"
               value="<?= htmlspecialchars($filters['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
            <h3>Aucun résultat</h3>
        </div>
    <?php endif; ?>

    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <div class="pagination">
        <?php foreach ($pagination as $p): ?>
            <?php if ($p === '...'): ?>
                <span class="pagination-dots">...</span>
            <?php else: ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                    <input type="hidden" name="page" value="<?= $p ?>">
                    <input type="hidden" name="nom" value="<?= htmlspecialchars($filters['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="telephone" value="<?= htmlspecialchars($filters['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="email" value="<?= htmlspecialchars($filters['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="valide" value="<?= $filters['valide'] ? 1 : 0 ?>">
                    <button type="submit"
                            class="page-btn <?= $p == $page ? 'active' : '' ?>">
                        <?= $p ?>
                    </button>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
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
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
            <label for="description">Description</label>
            <input  type="text"
                    name="description"
                    id="description"
		            data-validate="optional|txt"
                    value="<?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="telephone">Téléphone</label>
            <input  type="text"
                    name="telephone"
                    id="telephone"
		            data-validate="optional|phone"
                    value="<?= htmlspecialchars($filters['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="email">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   autocomplete="on"
                   data-validate="optional|email"
                   value="<?= htmlspecialchars($filters['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label> Active
                <input type="checkbox" name="valide" value="1"
                    <?= !isset($filters['valide']) ? 'checked' : ($filters['valide'] ? 'checked' : '') ?>>
            </label>
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>

