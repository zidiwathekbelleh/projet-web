<?php require_once APP . '/views/partials/header.php'; ?>

<?php if (!isset($user) || !is_array($user)): ?>
    <div class="container mt-5">
        <div class="alert alert-danger">
            ❌ Utilisateur introuvable.
        </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <h2>Modifier l'utilisateur</h2>

        <form method="POST" action="<?= BASE_URL ?>/user/update/<?= $user['id']; ?>" class="mt-4">

            <div class="mb-3">
                <label for="full_name" class="form-label">Nom complet</label>
                <input type="text" name="full_name" id="full_name" class="form-control"
                       value="<?= htmlspecialchars($user['full_name'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="organizer" <?= $user['role'] === 'organizer' ? 'selected' : '' ?>>Organisateur</option>
                    <option value="participant" <?= $user['role'] === 'participant' ? 'selected' : '' ?>>Participant</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= BASE_URL ?>/user/index" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
<?php endif; ?>

<?php require_once APP . '/views/partials/footer.php'; ?>
