<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des événements</h2>
        <a href="<?= BASE_URL ?>/event/create" class="btn btn-primary">➕ Ajouter un événement</a>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Lieu</th>
                <th>Organisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['id'] ?></td>
                    <td><?= htmlspecialchars($event['title']) ?></td>
                    <td><?= $event['start_date'] ?></td>
                    <td><?= $event['end_date'] ?></td>
                    <td><?= htmlspecialchars($event['location']) ?></td>
                    <td><?= htmlspecialchars($event['organizer']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/event/edit/<?= $event['id'] ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <a href="<?= BASE_URL ?>/event/delete/<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet événement ?')">🗑 Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center text-muted">Aucun événement trouvé.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
