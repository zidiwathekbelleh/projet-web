<?php require APP . '/views/partials/header.php'; ?>

<style>
.login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 420px;
}

.login-header {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    color: white;
    padding: 30px 20px;
    text-align: center;
}

.login-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 1.8rem;
}

.login-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.login-body {
    padding: 30px;
}

.form-floating {
    margin-bottom: 1.5rem;
}

.form-control {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 16px 20px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
}

.form-label {
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 8px;
}

.btn-login {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    border: none;
    border-radius: 12px;
    padding: 15px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
}

.btn-login:active {
    transform: translateY(0);
}

.login-footer {
    text-align: center;
    padding: 20px;
    border-top: 1px solid #e2e8f0;
    background: #f8f9fc;
}

.login-footer a {
    color: #4e73df;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.login-footer a:hover {
    color: #224abe;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    z-index: 10;
}

.input-group {
    position: relative;
}

.alert {
    border-radius: 12px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 20px;
}

.alert-danger {
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    color: white;
}

.alert-success {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    color: white;
}

.login-logo {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.login-logo i {
    font-size: 2.5rem;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.loading-spinner {
    display: none;
    width: 20px;
    height: 20px;
    border: 2px solid #ffffff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.btn-login.loading {
    pointer-events: none;
    opacity: 0.8;
}

/* Animation d'entrée */
.login-card {
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 576px) {
    .login-card {
        margin: 20px;
        max-width: 100%;
    }
    
    .login-body {
        padding: 25px;
    }
    
    .login-header {
        padding: 25px 20px;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3>EventPlatform</h3>
            <p>Connectez-vous à votre espace administrateur</p>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/auth/login" id="loginForm">
                <div class="mb-4">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Adresse email
                    </label>
                    <div class="input-group">
                        <input type="email" name="email" id="email" class="form-control" 
                               placeholder="votre@email.com" required
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        <span class="input-group-text bg-transparent border-0">
                            <i class="fas fa-user text-muted"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Mot de passe
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="Votre mot de passe" required>
                        <button type="button" class="input-group-text bg-transparent border-0 password-toggle"
                                onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    <a href="<?= BASE_URL ?>/auth/forgot-password" class="float-end text-decoration-none">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-login" id="loginButton">
                    <span class="loading-spinner" id="loadingSpinner"></span>
                    <span id="buttonText">Se connecter</span>
                </button>
            </form>
        </div>

        <div class="login-footer">
            <p class="mb-0">Nouveau sur EventPlatform ? 
                <a href="<?= BASE_URL ?>/auth/register">Créer un compte</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

document.getElementById('loginForm').addEventListener('submit', function(e) {
    const button = document.getElementById('loginButton');
    const spinner = document.getElementById('loadingSpinner');
    const buttonText = document.getElementById('buttonText');
    
    // Afficher l'animation de chargement
    spinner.style.display = 'inline-block';
    buttonText.textContent = 'Connexion...';
    button.classList.add('loading');
    
    // Désactiver le bouton pendant 2 secondes max pour éviter les doubles clics
    setTimeout(() => {
        spinner.style.display = 'none';
        buttonText.textContent = 'Se connecter';
        button.classList.remove('loading');
    }, 2000);
});

// Animation d'entrée pour les champs
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach((input, index) => {
        input.style.animationDelay = `${index * 0.1}s`;
        input.classList.add('animate__animated', 'animate__fadeInUp');
    });
});
</script>

<?php require APP . '/views/partials/footer.php'; ?>