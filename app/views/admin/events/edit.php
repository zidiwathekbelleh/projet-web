<?php require_once APP . '/views/partials/header.php'; ?>

<?php if (!isset($event) || !is_array($event)): ?>
    <div class="container mt-5 alert alert-danger">
        ❌ Événement introuvable.
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h2>Modifier l'événement</h2>

        <form method="POST" action="<?= BASE_URL ?>/event/edit/<?= $event['id'] ?>" class="mt-4">

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de début</label>
                <input type="datetime-local" name="start_date" class="form-control"
                       value="<?= date('Y-m-d\TH:i', strtotime($event['start_date'])) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de fin</label>
                <input type="datetime-local" name="end_date" class="form-control"
                       value="<?= date('Y-m-d\TH:i', strtotime($event['end_date'])) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lieu</label>
                <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($event['location']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre max. de participants</label>
                <input type="number" name="max_participants" class="form-control" value="<?= $event['max_participants'] ?>" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= BASE_URL ?>/event/index" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
<?php endif; ?>

<?php require_once APP . '/views/partials/footer.php'; ?>
