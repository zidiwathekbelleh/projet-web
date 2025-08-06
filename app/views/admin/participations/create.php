<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <h2>Ajouter une participation</h2>

    <form method="POST" action="<?= BASE_URL ?>/participation/create" class="mt-4">

        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id']; ?>"><?= htmlspecialchars($user['full_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="event_id" class="form-label">Événement</label>
            <select name="event_id" id="event_id" class="form-select" required>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event['id']; ?>"><?= htmlspecialchars($event['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select">
                <option value="pending">En attente</option>
                <option value="confirmed">Confirmée</option>
                <option value="cancelled">Annulée</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="<?= BASE_URL ?>/participation/index" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
