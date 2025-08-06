<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plateforme de gestion d'événements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>/user/index">🎉 EventPlatform</a>
  </div>
</nav>

<!-- Alertes flash Bootstrap -->
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="container mt-3">
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type === 'error' ? 'danger' : $type ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endforeach; unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>
