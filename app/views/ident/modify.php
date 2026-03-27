<h2>Modification d'identifiant</h2>

<script src="<?= CDN . PREFIX ?>/js/modules/etudiant.js"></script>
<script id="pilote-roles-data" type="application/json">
    <?= json_encode(PILOTE) ?>
</script>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<p>Dernière maj: <?= htmlspecialchars($ident['valide_lastupdate'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

<form id="formIdent" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="form_type" value="update_profile">
    <label>Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($ident['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($ident['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($ident['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|email">

    <label>Active</label>
    <input type="checkbox"
       name="valide"
       value="1"
       <?= $ident['valide'] ? 'checked' : '' ?>>

    <label>Profil
        <select name="id_role" id="role-select">
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id_role'] ?>"
                    <?= (isset($ident['id_role']) && (string)($ident['id_role']) == (string)($role['id_role'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($role['role']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <div id="pilote-block" style="display: none;">
        <label>Etudiants Pilotés</label>

        <select id="etudiant-select">
            <option value="">-- Choisir un étudiant --</option>
            <?php foreach ($etudiants as $c): ?>
                <option value="<?= $c['id_ident'] ?>">
                    <?= htmlspecialchars($c['nom'].' '.$c['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="button" id="add-etudiant">Ajouter</button>

        <div id="etudiants-container" class="etudiants-container">
            <?php if (!empty($etu_selected)) : ?>
            <?php foreach ($etu_selected as $e): ?>
                <div class="etudiant-item">
                    <?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?>
                    <button type="button" class="remove">X</button>
                    <input type="hidden" name="etudiants[]" value="<?= $e['id_ident'] ?>">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="placeholder">Aucun étudiant sélectionné</p>
        <?php endif; ?>
        </div>
    </div>




    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='<?= CDN . PREFIX ?>/ident/recherche'">Annule</button>

</form>
<br/>
<form id="formIdentPasswd" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="form_type" value="update_password">
    <label>Password</label>
    <input type="password" name="passwd" id="passwd" data-validate="required|alpha">
    <button type="submit">Modifier le mot de passe</button>
</form>

<?php if (in_array((int)($ident['id_role']), POSTULE)) : ?>
    <?php if (!empty($wishlist)) : ?>
        <br/>
        <hr/>
        <!-- ZONE RESULTATS WISHLIST -->
        <div class="results">
            <h2>Wishlist</h2>
            <?php foreach ($wishlist as $item) : ?>
                <div class="card">
                    <div class="card-left">
                        <h3>
                            <?= htmlspecialchars($item['nom']) ?>
                        </h3>
                        <p><?= htmlspecialchars($item['titre']) ?></p>
                        <br/>
                        <p><u>Date de l'offre</u>: <?= htmlspecialchars($item['date_offre']) ?></p>
                        <p><u>Description</u>: <?= htmlspecialchars($item['description']) ?></p>
                    </div>
                    <div class="card-right">
                        <p><?= htmlspecialchars($item['base_remuneration']) ?> €/mois</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($postule)) : ?>
        <br/>
        <hr/>
        <!-- ZONE RESULTATS POSTULE -->
        <div class="results">
            <h2>Candidature</h2>
            <?php foreach ($postule as $item) : ?>
                <div class="card">
                    <div class="card-left">
                        <h3>
                            <?= htmlspecialchars($item['nom']) ?>
                        </h3>
                        <p><?= htmlspecialchars($item['titre']) ?></p>
                        <br/>
                        <p><u>Date de l'offre</u>: <?= htmlspecialchars($item['date_offre']) ?></p>
                        <p><u>Description</u>: <?= htmlspecialchars($item['description']) ?></p>
                        <p><u>Base de rémunération</u>: <?= htmlspecialchars($item['base_remuneration']) ?> €/mois</p>
                    </div>
                    <div class="card-right">
                        <!-- ✏️ Edit -->
                        <?php View::button([
                                    'permission' => 'postule_modify',
                                    'url'        => '/postule/modify/'.$item['id_offre'],
                                    'class'      => 'edit',
                                    'icon'       => '✏',
                                    'title'      => 'Modifier',
                                ]);
                        ?>
                        
                        <!-- 🗑 Delete -->
                        <?php View::button([
                                    'permission' => 'postule_delete',
                                    'url'        => '/postule/delete/'.$item['id_offre'],
                                    'class'      => 'delete',
                                    'icon'       => '🗑',
                                    'title'      => 'Supprimer',
                                    'attributes' => [
                                        'onclick' => "return confirm('Confirmer la suppression ?');"
                                    ]
                                ]);
                        ?>

                    </div>
                    <div class="card-right">
                        <p><u>Postulé le</u>: <?= htmlspecialchars($item['date_postule']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

