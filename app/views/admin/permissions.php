<h2>Gestion des permissions</h2>

<form method="POST">

<table border="1" cellpadding="8">

<thead>

<tr>

<th>Permission</th>

<?php foreach ($roles as $role): ?>

<th><?= htmlspecialchars($role['role']) ?></th>

<?php endforeach; ?>

</tr>

</thead>

<tbody>

<?php foreach ($permissions as $perm): ?>

<tr>

<td><?= htmlspecialchars($perm['permission']) ?></td>

<?php foreach ($roles as $role): ?>

<td style="text-align:center">

<input type="hidden"
       name="perm[<?= $role['id_role'] ?>][<?= $perm['permission'] ?>]"
       value="0">

<input type="checkbox"
       name="perm[<?= $role['id_role'] ?>][<?= $perm['permission'] ?>]"
       value="1"
       <?= !empty($matrix[$role['id_role']][$perm['permission']]) ? 'checked' : '' ?>>

</td>

<?php endforeach; ?>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<br>

<button type="submit">Enregistrer</button>

</form>