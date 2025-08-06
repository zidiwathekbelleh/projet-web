<?php require_once APP . '/views/partials/header.php'; ?>

<div class="container mt-5">
    <h2>Ajouter un utilisateur</h2>

    <form method="POST" action="<?= BASE_URL ?>/user/create" class="mt-4">
        <div class="mb-3">
            <label for="full_name" class="form-label">Nom complet</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="organizer">Organisateur</option>
                <option value="participant">Participant</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="<?= BASE_URL ?>/user/index" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once APP . '/views/partials/footer.php'; ?>
