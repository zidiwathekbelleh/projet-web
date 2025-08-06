<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des utilisateurs</h2>
        <a href="<?= BASE_URL ?>/user/create" class="btn btn-primary">➕ Ajouter un utilisateur</a>
    </div>

    <table class="table table-striped table-hover table-bordered">
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
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= htmlspecialchars($user['full_name']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td>
                        <span class="badge bg-secondary"><?= ucfirst($user['role']); ?></span>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/user/edit/<?= $user['id']; ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <a href="<?= BASE_URL ?>/user/delete/<?= $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce compte ?')">🗑 Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center text-muted">Aucun utilisateur trouvé.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
