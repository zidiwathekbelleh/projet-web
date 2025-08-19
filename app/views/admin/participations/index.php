<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📝 Gestion des participations</h1>
    <a href="<?= BASE_URL ?>/participation/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter
    </a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Événement</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($participations as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['user_name']) ?></td>
            <td><?= htmlspecialchars($p['event_title']) ?></td>
            <td><?= $p['status'] ?></td>
            <td>
                <a href="<?= BASE_URL ?>/participation/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <a href="<?= BASE_URL ?>/participation/delete/<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette participation ?');"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require APP . '/views/admin/layout.php';
