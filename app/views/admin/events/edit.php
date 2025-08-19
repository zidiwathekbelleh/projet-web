<?php require_once APP . '/views/partials/header.php'; ?>

<?php if (!isset($event) || !is_array($event)): ?>
    <div class="container mt-5">
        <div class="alert alert-danger">
            ❌ Événement introuvable.
        </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h2>Modifier l'événement</h2>

        <form method="POST" action="<?= BASE_URL ?>/event/update/<?= $event['id']; ?>" class="mt-4">

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($event['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Date début</label>
                <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($event['start_date'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Date fin</label>
                <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($event['end_date'])) ?>" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lieu</label>
                <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($event['location']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= BASE_URL ?>/event/index" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
<?php endif; ?>

<?php require_once APP . '/views/partials/footer.php'; ?>
