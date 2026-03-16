<h1>Connexion</h1>

<?php if (!empty($error)): ?>
<p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="post">

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Mot de passe</label>
    <input type="password" name="password" required>

    <button type="submit">Connexion</button>

</form>