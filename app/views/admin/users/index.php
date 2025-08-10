<?php
ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>👥 Gestion des utilisateurs</h1>
    <a href="<?= BASE_URL ?>/user/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter un utilisateur
    </a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom complet</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['full_name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <a href="<?= BASE_URL ?>/user/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="<?= BASE_URL ?>/user/delete/<?= $user['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Supprimer cet utilisateur ?');">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require APP . '/views/admin/layout.php';
