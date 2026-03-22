<h2>Création d'identifiant</h2>

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
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($filters['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha">

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($filters['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|alpha|min:10">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($filters['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-validate="required|email">

    <label> Active
        <input type="checkbox"
            name="valide"
            value="1"
            <?= !isset($filters['valide']) ? 'checked' : ($filters['valide'] ? 'checked' : '') ?>>
    </label>

    <label>Profil
        <select name="id_role">
            <option value="-1">---Choisir---</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id_role'] ?>"
                    <?= (isset($filters['id_role']) && (string)($filters['id_role']) === (string)($role['id_role'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($role['role']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="passwd">Password</label>
    <input type="password" name="passwd" id="passwd" data-validate="required|alpha">
    
    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='/ident/recherche'">Annule</button>

</form>

