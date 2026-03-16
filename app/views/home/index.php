<h1>Bienvenue sur Web4All</h1>

<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Suspendisse potenti. Donec vel sem ut libero ultrices gravida.
</p>

<?php if (!Auth::check()): ?>

<a href="/auth/login" class="btn-login">
    Se connecter
</a>

<?php else: ?>

<p>Bienvenue <?= htmlspecialchars(Auth::user()['prenom']) ?> vous etes <?= htmlspecialchars(Auth::user()['role']) ?></p>
<br/>
<a href="/auth/logout" class="btn-logout">
Se déconnecter
</a>

<?php endif ?>