<?php require_once APP . '/views/partials/header.php'; ?>

<?php if (!isset($participation) || !is_array($participation)): ?>
    <div class="container mt-5 alert alert-danger">
        ❌ Participation introuvable.
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h2>Modifier le statut de participation</h2>

        <form method="POST" action="<?= BASE_URL ?>/participation/edit/<?= $participation['id'] ?>" class="mt-4">

            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select" required>
                    <option value="pending" <?= $participation['status'] === 'pending' ? 'selected' : '' ?>>En attente</option>
                    <option value="confirmed" <?= $participation['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmée</option>
                    <option value="cancelled" <?= $participation['status'] === 'cancelled' ? 'selected' : '' ?>>Annulée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= BASE_URL ?>/participation/index" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
<?php endif; ?>

<?php require_once APP . '/views/partials/footer.php'; ?>
