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
        <?php foreach ($results as $id => $entreprise) : ?>
            <div class="card">
                <div class="card-left">
                    <h3>
                        <?= htmlspecialchars($entreprise['nom']) ?>
                    </h3>
                    <p><?= htmlspecialchars($entreprise['description']) ?></p>
                    <p><u>Email</u>: <?= htmlspecialchars($entreprise['email']) ?></p>
                    <p><u>Téléphone</u>: <?= htmlspecialchars($entreprise['telephone']) ?></p>
                </div>
                <div class="card-right">
                    <div class="stars-rating" data-value="<?= $entreprise['eval_stars'] ?>" data-readonly="true">
                        <span data-value="1">☆</span>
                        <span data-value="2">☆</span>
                        <span data-value="3">☆</span>
                        <span data-value="4">☆</span>
                        <span data-value="5">☆</span>

                        <?php if ($entreprise['eval_stars']) : ?>
                            <?= 'moy: '.$entreprise['eval_moyenne'] ?> (<a class="btn-icon" href="<?= CDN . PREFIX ?>/evaluation/show/<?= $entreprise['id_entreprise'] ?>" ><?= $entreprise['eval_nbre'] ?></a>)
                        <?php endif; ?>
                    </div>
                    
                </div>
                <div class="card-right">
                    <?php if (! $entreprise['in_evaluate']) : ?>
                        <!-- ⭐ Evaluate -->
                        <?php View::button([
                                    'permission' => 'evaluation_create',
                                    'url'        => '/evaluation/create/'.$entreprise['id_entreprise'],
                                    'class'      => 'wishlist',
                                    'icon'       => '☆',
                                    'title'      => 'Evaluer',
                                ]);
                        ?>
                    <?php endif; ?>

                    <!-- ✏️ Edit -->
                    <?php View::button([
                                'permission' => 'entreprise_modify',
                                'url'        => '/entreprise/modify/'.$entreprise['id_entreprise'],
                                'class'      => 'edit',
                                'icon'       => '✏',
                                'title'      => 'Modifier',
                            ]);
                    ?>

                    <!-- 🗑 Delete -->
                    <?php View::button([
                                'permission' => 'entreprise_delete',
                                'url'        => '/entreprise/delete/'.$entreprise['id_entreprise'],
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
        onclick="window.location.href='<?= CDN . PREFIX ?>/entreprise/create'">
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

