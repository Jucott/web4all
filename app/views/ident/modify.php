<h2>Modification d'identifiant</h2>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

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
        <select name="id_role">
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id_role'] ?>"
                    <?= (isset($ident['id_role']) && (string)($ident['id_role']) == (string)($role['id_role'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($role['role']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <p>Dernière mise a jour le <?= htmlspecialchars($ident['valide_lastupdate'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/ident/recherche'">Annule</button>

</form>
<br/>
<form id="formIdentPasswd" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="form_type" value="update_password">
    <label>Password</label>
    <input type="password" name="passwd" id="passwd" data-validate="required|alpha">
    <button type="submit">Modifier le mot de passe</button>
</form>

