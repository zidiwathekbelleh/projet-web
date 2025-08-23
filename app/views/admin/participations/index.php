<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📝 Gestion des participations</h1>
    <div class="d-flex gap-2">
        <a href="<?= BASE_URL ?>/participation/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une participation
        </a>
        <a href="<?= BASE_URL ?>/participation/exportAllPdf" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf"></i> Exporter toutes les participations
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Participant</th>
                <th>Événement</th>
                <th>Date de l'événement</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
                <th class="text-center">PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($participations) && is_array($participations)): ?>
                <?php foreach ($participations as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['user_name'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['event_title'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['start_date'] ?? '-') ?></td>
                        <td>
                            <?php if (($p['status'] ?? '') === 'confirmé'): ?>
                                <span class="badge bg-success">✔ Confirmé</span>
                            <?php elseif (($p['status'] ?? '') === 'en attente'): ?>
                                <span class="badge bg-warning text-dark">⏳ En attente</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($p['status'] ?? '-') ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>/participation/edit/<?= $p['id'] ?? '' ?>" 
                               class="btn btn-warning btn-sm" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/participation/delete/<?= $p['id'] ?? '' ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cette participation ?');"
                               title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <!-- Bouton PDF par événement -->
                            <a href="<?= BASE_URL ?>/participation/exportPdf/<?= $p['event_id'] ?? '' ?>" 
                               class="btn btn-sm btn-success" title="PDF Événement">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Aucune participation trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
require APP . '/views/admin/layout.php';
?>
