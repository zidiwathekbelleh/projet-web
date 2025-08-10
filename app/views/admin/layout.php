<?php
// app/views/admin/layout.php
if (!isset($_SESSION['user'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin - <?= $title ?? 'Tableau de bord' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { min-height:100vh; }
    .sidebar { width:240px; background:#0d6efd; color:#fff; min-height:100vh; position:fixed; }
    .sidebar a { color:#fff; padding:12px 18px; display:block; text-decoration:none; }
    .sidebar a:hover, .sidebar .active { background: rgba(255,255,255,0.12); }
    .main { margin-left:240px; padding:24px; background:#f8f9fa; min-height:100vh; }
    .card { border-radius:10px; }
  </style>
</head>
<body>
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-center mb-3">Admin Panel</h4>
    <a href="<?= BASE_URL ?>/admin/dashboard" class="<?= (strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false) ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="<?= BASE_URL ?>/user/index"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <a href="<?= BASE_URL ?>/event/index"><i class="bi bi-calendar-event me-2"></i>Événements</a>
    <a href="<?= BASE_URL ?>/participation/index"><i class="bi bi-check2-circle me-2"></i>Participations</a>
    <div class="mt-auto">
      <a href="<?= BASE_URL ?>/auth/logout" class="text-warning"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
    </div>
  </div>

  <main class="main">
    <!-- top bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="mb-0"><?= $title ?? 'Tableau de bord' ?></h2>
        <small class="text-muted">Bienvenue, <?= htmlspecialchars($_SESSION['user']['full_name'] ?? 'Utilisateur') ?></small>
      </div>
      <div>
        <?php if (!empty($_SESSION['flash'])): ?>
          <?php foreach ($_SESSION['flash'] as $type => $msg): ?>
            <div class="alert alert-<?= $type === 'error' ? 'danger' : $type ?> mb-0"><?= htmlspecialchars($msg) ?></div>
          <?php endforeach; unset($_SESSION['flash']); ?>
        <?php endif; ?>
      </div>
    </div>

    <!-- contenu inséré -->
    <?php if (isset($content)) echo $content; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
