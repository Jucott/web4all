<h2>Evaluations de l'entreprise</h2>

<div class="results">
    <?php if (!empty($results)) : ?>
        <h3><?= $results[0]['entreprise'] ?></h3>
        <h4>note moyenne: <?= $note['eval_stars'] ?> / 5</h4>
        <br/>
        <?php foreach ($results as $evaluation) : ?>
            
            <div class="card">
                <div class="card-left">
                    <h3>
                        <?= htmlspecialchars($evaluation['nom'].' '.$evaluation['prenom']) ?>
                    </h3>
                    <p><u>Date</u>: <?= htmlspecialchars($evaluation['date_evaluation']) ?></p>
                </div>
                <div class="card-right">
                    <div class="stars-rating" data-value="<?= $evaluation['note'] ?>" data-readonly="true">
                        <span data-value="1">☆</span>
                        <span data-value="2">☆</span>
                        <span data-value="3">☆</span>
                        <span data-value="4">☆</span>
                        <span data-value="5">☆</span>
                    </div>
                </div>
                <div class="card">
                    <p><?= $evaluation['commentaire'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
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
