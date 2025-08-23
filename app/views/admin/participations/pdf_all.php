<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Toutes les participations</h2>
    <p>Date : <?= date('d/m/Y H:i') ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Participant</th>
                <th>Événement</th>
                <th>Date de l'événement</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($participations)): ?>
                <?php foreach ($participations as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id']) ?></td>
                        <td><?= htmlspecialchars($p['user_name']) ?></td>
                        <td><?= htmlspecialchars($p['event_title']) ?></td>
                        <td><?= htmlspecialchars($p['start_date']) ?></td>
                        <td><?= htmlspecialchars($p['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Aucune participation trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
