<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des participations</h2>
        <a href="<?= BASE_URL ?>/participation/create" class="btn btn-primary">➕ Ajouter une participation</a>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Événement</th>
                <th>Date d'inscription</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($participations)): ?>
            <?php foreach ($participations as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= htmlspecialchars($p['user_name']); ?></td>
                    <td><?= htmlspecialchars($p['event_title']); ?></td>
                    <td><?= $p['registration_date']; ?></td>
                    <td>
                        <span class="badge 
                            <?= $p['status'] === 'confirmed' ? 'bg-success' : 
                                ($p['status'] === 'cancelled' ? 'bg-danger' : 'bg-warning'); ?>">
                            <?= ucfirst($p['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/participation/edit/<?= $p['id']; ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <a href="<?= BASE_URL ?>/participation/delete/<?= $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette participation ?')">🗑 Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center text-muted">Aucune participation trouvée.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
