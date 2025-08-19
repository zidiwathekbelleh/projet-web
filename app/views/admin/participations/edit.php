<?php require_once APP . '/views/partials/header.php'; ?>

<?php if (!isset($participation) || !is_array($participation)): ?>
    <div class="container mt-5">
        <div class="alert alert-danger">
            ❌ Participation introuvable.
        </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h2>Modifier la participation</h2>

        <form method="POST" action="<?= BASE_URL ?>/participation/update/<?= $participation['id']; ?>" class="mt-4">

            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>" <?= $u['id'] == $participation['user_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($u['full_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="event_id" class="form-label">Événement</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    <?php foreach ($events as $e): ?>
                        <option value="<?= $e['id'] ?>" <?= $e['id'] == $participation['event_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($e['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="confirmed" <?= $participation['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmé</option>
                    <option value="pending" <?= $participation['status'] === 'pending' ? 'selected' : '' ?>>En attente</option>
                    <option value="cancelled" <?= $participation['status'] === 'cancelled' ? 'selected' : '' ?>>Annulé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= BASE_URL ?>/participation/index" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
<?php endif; ?>

<?php require_once APP . '/views/partials/footer.php'; ?>
