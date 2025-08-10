<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin | Event Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="min-height: 100vh; width: 220px;">
        <h4 class="mb-4">🎓 Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="<?= BASE_URL ?>/admin/dashboard" class="nav-link text-white">🏠 Tableau de bord</a></li>
            <li class="nav-item mb-2"><a href="<?= BASE_URL ?>/user/index" class="nav-link text-white">👥 Utilisateurs</a></li>
            <li class="nav-item mb-2"><a href="<?= BASE_URL ?>/event/index" class="nav-link text-white">📅 Événements</a></li>
            <li class="nav-item mb-2"><a href="<?= BASE_URL ?>/participation/index" class="nav-link text-white">🙋 Participations</a></li>
            <li class="nav-item mt-4"><a href="<?= BASE_URL ?>/auth/logout" class="nav-link text-warning">🚪 Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="flex-grow-1 p-4">
