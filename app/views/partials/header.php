<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) . ' - EventPlatform' : 'EventPlatform' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (icônes) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Style personnalisé -->
    <style>
        body {
            background-color: #f5f6fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php if (!empty($_SESSION['user'])): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">EventPlatform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php if ($_SESSION['user']['role'] === 'superadmin' || $_SESSION['user']['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/admin/dashboard"><i class="fa fa-chart-line"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/user/index"><i class="fa fa-users"></i> Utilisateurs</a></li>
                    <?php endif; ?>

                    <?php if ($_SESSION['user']['role'] === 'superadmin' || $_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'organizer'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/event/index"><i class="fa fa-calendar"></i> Événements</a></li>
                    <?php endif; ?>

                    <?php if ($_SESSION['user']['role'] === 'participant' || $_SESSION['user']['role'] === 'superadmin' || $_SESSION['user']['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/participation/index"><i class="fa fa-handshake"></i> Participations</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text me-2"><?= htmlspecialchars($_SESSION['user']['full_name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="<?= BASE_URL ?>/auth/logout"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>

<div class="container mt-4">
