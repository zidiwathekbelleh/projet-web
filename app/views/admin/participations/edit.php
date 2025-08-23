<?php require_once dirname(__DIR__) . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Modifier la participation</h2>
    <form action="/projet-web/public/participations/update/<?= $participation['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Sélectionner un utilisateur --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>" <?= $user['id'] == $participation['user_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['full_name']) ?> (<?= htmlspecialchars($user['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="event_id" class="form-label">Événement</label>
            <select name="event_id" id="event_id" class="form-select" required>
                <option value="">-- Sélectionner un événement --</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event['id'] ?>" <?= $event['id'] == $participation['event_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($event['title']) ?> (<?= htmlspecialchars($event['date']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" <?= $participation['status'] == 'pending' ? 'selected' : '' ?>>En attente</option>
                <option value="confirmed" <?= $participation['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmé</option>
                <option value="cancelled" <?= $participation['status'] == 'cancelled' ? 'selected' : '' ?>>Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/projet-web/public/participations" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once dirname(__DIR__) . '/../partials/footer.php'; ?>
