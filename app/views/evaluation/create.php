<h2>Evaluation d'entreprise</h2>

<?php if (!empty($errors)) : ?>
    <div class="error-box">
        <?php foreach ($errors as $fieldErrors) : ?>
            <?php foreach ($fieldErrors as $error) : ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form id="formEntreprise" data-validate="true" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <div class="card">
        <div class="card-left">
            <h3>
                <?= htmlspecialchars($entreprise['nom']) ?>
            </h3>
            <p><?= htmlspecialchars($entreprise['description']) ?></p>
            <p><u>Email</u>: <?= htmlspecialchars($entreprise['email']) ?></p>
            <p><u>Téléphone</u>: <?= htmlspecialchars($entreprise['telephone']) ?></p>
        </div>
    </div>
    
    <?php if (! empty($entreprise['evaluation'])) : ?>
        <label for="evaluation">Vous avez noté l'entreprise le <?= htmlspecialchars($entreprise['date_evaluation'] ?? '', ENT_QUOTES, 'UTF-8') ?></label>
        <div class="stars-rating" data-value="<?= $entreprise['evaluation'] ?>" data-readonly="true">
            <span data-value="1">☆</span>
            <span data-value="2">☆</span>
            <span data-value="3">☆</span>
            <span data-value="4">☆</span>
            <span data-value="5">☆</span>
        </div>
        <p><u>Commentaire</u>: <?= htmlspecialchars($entreprise['commentaire'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
    <?php else : ?>
        <label for="evaluation">Votre Evaluation de l'entreprise</label>
        <input type="hidden" name="evaluation" id="evaluation" value="<?= $entreprise['evaluation'] ?>">
        <div class="stars-rating">
            <span data-value="1">☆</span>
            <span data-value="2">☆</span>
            <span data-value="3">☆</span>
            <span data-value="4">☆</span>
            <span data-value="5">☆</span>
        </div>
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" id="commentaire" data-validate="required|txt"><?= htmlspecialchars($entreprise['commentaire'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    <?php endif; ?>
    
    

    <button type="submit">Sauve</button>
    <button type="button" onclick="window.location.href='<?= CDN . PREFIX ?>/entreprise/recherche'">Annule</button>

</form>

