<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <h2>Créer un nouvel événement</h2>

    <form method="POST" action="<?= BASE_URL ?>/event/create" class="mt-4">

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de début</label>
            <input type="datetime-local" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de fin</label>
            <input type="datetime-local" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre max. de participants</label>
            <input type="number" name="max_participants" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="<?= BASE_URL ?>/event/index" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
