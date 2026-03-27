<h2>Recherche d'offres</h2>

<p>A la recherche d'une offre</p>

<script src="<?= CDN . PREFIX ?>/js/modules/wishlist.js"></script>

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
<form id="formOffre" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
    <input type="hidden" name="valide" value="<?= $filters['valide'] ? 1 : 0 ?>">
    <div class="search-box">
        <input type="text"
               name="titre"
               data-validate="optional|alpha"
               placeholder="Nom de l'offre"
               value="<?= htmlspecialchars($filters['titre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
        <script>
            window.csrf_token = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        </script>
        <?php foreach ($results as $offre) : ?>
            <div class="card">
                <div class="card-left">
                    <h3>
                        <?= htmlspecialchars($offre['titre']) ?>
                    </h3>
                    <p><?= htmlspecialchars($offre['description']) ?></p>
                </div>
                <div class="card-left">
                    <p><u>Nbre de candidats</u>: <?= $offre['nb_candidatures'] ?></p>
                </div>
                <div class="card-right">
                    <!-- ✉️ Postuler -->
                    <?php if ($offre['in_postule'] === 0) :?>
                        <!-- Postuler -->
                        <?php View::button([
                                    'permission' => 'postule_create',
                                    'url'        => '#',
                                    'class'      => 'apply',
                                    'icon'       => '✉',
                                    'title'      => 'Postuler',
                                    'attributes' => [
                                        'data-id' => $offre['id_offre'],
                                    ]
                                ]);
                        ?>

                        <!-- ⭐ Wishlist -->
                        <?php View::button([
                                    'permission' => 'wishlist_create',
                                    'url'        => '#',
                                    'class'      => 'wishlist',
                                    'icon'       => $offre['in_wishlist'] ? '★' : '☆',
                                    'title'      => $offre['in_wishlist']
                                        ? 'Retirer de la wishlist'
                                        : 'Ajouter à la wishlist',
                                    'attributes' => [
                                        'data-id' => $offre['id_offre'],
                                        'data-inwishlist' => $offre['in_wishlist']
                                    ]
                                ]);
                        ?>

                    <?php endif; ?>
                    
                    <!-- ✏️ Edit -->
                    <?php View::button([
                                'permission' => 'offre_modify',
                                'url'        => '/offre/modify/'.$offre['id_offre'],
                                'class'      => 'edit',
                                'icon'       => '✏',
                                'title'      => 'Modifier',
                            ]);
                    ?>

                    <!-- 🗑 Delete -->
                    <?php View::button([
                                'permission' => 'offre_delete',
                                'url'        => '/offre/delete/'.$offre['id_offre'],
                                'class'      => 'delete',
                                'icon'       => '🗑',
                                'title'      => 'Supprimer',
                                'attributes' => [
                                    'onclick' => "return confirm('Confirmer la suppression ?');"
                                ]
                            ]);
                    ?>
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
                    <input type="hidden" name="titre" value="<?= htmlspecialchars($filters['titre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="date_offre" value="<?= htmlspecialchars($filters['date_offre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="id_entreprise" value="<?= htmlspecialchars($filters['id_entreprise'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="base_remuneration" value="<?= htmlspecialchars($filters['base_remuneration'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
        onclick="window.location.href='<?= CDN . PREFIX ?>/offre/create'">
    Ajouter
</button>


<!-- MODAL RECHERCHE AVANCEE -->
<div class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Recherche avancée</h3>
        <form id="formOffre" data-validate="true" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
            <label for="description">Description</label>
            <input  type="text"
                    name="description"
                    id="description"
		            data-validate="optional|txt"
                    value="<?= htmlspecialchars($filters['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="base_remuneration">Base Rémunération</label>
            <input type="number"
                   name="base_remuneration"
                   id="base_remuneration"
                   data-validate="optional|integer"
                   value="<?= htmlspecialchars($filters['base_remuneration'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="date_offre">Date Offre</label>
            <input type="date"
                   name="date_offre"
                   id="date_offre"
                   data-validate="optional|date"
                   value="<?= htmlspecialchars($filters['date_offre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label>Entreprise
                <select name="id_entreprise" data-validate="optional|integer">
                        <option value="-1">-----</option>
                    <?php foreach ($entreprises as $entreprise): ?>
                        <option value="<?= $entreprise['id_entreprise'] ?>"
                            <?= (isset($filters['id_entreprise']) && (string)($filters['id_entreprise']) == (string)($entreprise['id_entreprise'])) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($entreprise['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label> Active
                <input type="checkbox" name="valide" value="1"
                    <?= !isset($filters['valide']) ? 'checked' : ($filters['valide'] ? 'checked' : '') ?>>
            </label>
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>

