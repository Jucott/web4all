<h2>Recherche d'identifiants</h2>

<p>A la recherche d'un identifiant</p>

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
<form id="formIdent" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
    <input type="hidden" name="valide" value="<?= $filters['valide'] ? 1 : 0 ?>">
    <div class="search-box">
        <input type="text"
               name="nom"
               data-validate="optional|alpha"
               placeholder="Nom de l'identifiant"
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
        <?php foreach ($results as $ident) : ?>
            <div class="card">
                <div class="card-left">
                    <h3><?= htmlspecialchars($ident['nom'].' '.$ident['prenom']) ?></h3>
                </div>
                <div class="card-right">
                    <p><u>Email</u>: <?= htmlspecialchars($ident['email']) ?></p>
                </div>
                <div class="card-right">
                    <?php if ($ident['not_me'] === 0) : ?>
                        <!-- ✏️ Edit -->
                        <?php View::button([
                                    'permission' => 'ident_modify',
                                    'url'        => '/ident/modify/'.$ident['id_ident'],
                                    'class'      => 'edit',
                                    'icon'       => '✏',
                                    'title'      => 'Modifier',
                                ]);
                        ?>

                        <!-- 🗑 Delete -->
                        <?php View::button([
                                    'permission' => 'ident_delete',
                                    'url'        => '/ident/delete/'.$ident['id_ident'],
                                    'class'      => 'delete',
                                    'icon'       => '🗑',
                                    'title'      => 'Supprimer',
                                    'attributes' => [
                                        'onclick' => "return confirm('Confirmer la suppression ?');"
                                    ]
                                ]);
                        ?>
                    <?php endif; ?>
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
                    <input type="hidden" name="prenom" value="<?= htmlspecialchars($filters['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
        onclick="window.location.href='<?= CDN . PREFIX ?>/ident/create'">
    Ajouter
</button>


<!-- MODAL RECHERCHE AVANCEE -->
<div class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Recherche avancée</h3>
        <form id="formIdent" data-validate="true" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="page" value="<?= $page ?? 1 ?>">
            <label for="prenom">Prénom</label>
            <input  type="text"
                    name="prenom"
                    id="prenom"
		            data-validate="optional|txt"
                    value="<?= htmlspecialchars($filters['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="email">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   autocomplete="on"
                   data-validate="optional|email"
                   value="<?= htmlspecialchars($filters['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label>Profil
                <select name="id_role" data-validate="optional|integer">
                        <option value="-1">-----</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id_role'] ?>"
                            <?= (isset($filters['id_role']) && (string)($filters['id_role']) == (string)($role['id_role'])) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['role']) ?>
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

