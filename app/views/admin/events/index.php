<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📅 Gestion des événements</h1>
    <a href="<?= BASE_URL ?>/event/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter
    </a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Lieu</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($events as $e): ?>
        <tr>
            <td><?= $e['id'] ?></td>
            <td><?= htmlspecialchars($e['title']) ?></td>
            <td><?= $e['start_date'] ?></td>
            <td><?= $e['end_date'] ?></td>
            <td><?= htmlspecialchars($e['location']) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/event/edit/<?= $e['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <a href="<?= BASE_URL ?>/event/delete/<?= $e['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet événement ?');"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require APP . '/views/admin/layout.php';
