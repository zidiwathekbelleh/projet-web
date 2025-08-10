<div class="container mt-5">
    <div class="p-5 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-5 fw-bold">🎉 Bienvenue sur EventPlatform</h1>
            <p class="col-md-8 mx-auto fs-4">
                Gérez facilement vos <strong>utilisateurs</strong>, <strong>événements</strong> et <strong>participations</strong>
                depuis un tableau de bord moderne et simple d’utilisation.
            </p>

            <?php if (!empty($user)): ?>
                <a href="<?= BASE_URL ?>/admin/dashboard" class="btn btn-primary btn-lg px-4 gap-3">
                    Accéder au tableau de bord
                </a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/auth/login" class="btn btn-success btn-lg px-4 gap-3">
                    Se connecter
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
