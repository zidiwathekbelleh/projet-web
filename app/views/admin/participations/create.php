<?php require_once dirname(__DIR__) . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Créer une nouvelle participation</h2>
    <form action="/projet-web/public/participations/store" method="POST">
        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Sélectionner un utilisateur --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['full_name']) ?> (<?= htmlspecialchars($user['email']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="event_id" class="form-label">Événement</label>
            <select name="event_id" id="event_id" class="form-select" required>
                <option value="">-- Sélectionner un événement --</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['title']) ?> (<?= htmlspecialchars($event['date']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select">
                <option value="pending">En attente</option>
                <option value="confirmed">Confirmé</option>
                <option value="cancelled">Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="/projet-web/public/participations" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once dirname(__DIR__) . '/../partials/footer.php'; ?>
