<?php

class Controller
{
    /**
     * Affiche une vue avec header/footer automatiquement
     */
    public function render($view, $data = [])
    {
        extract($data);

        // Si la vue existe
        $viewFile = APP . '/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require APP . '/views/partials/header.php';
            require $viewFile;
            require APP . '/views/partials/footer.php';
        } else {
            throw new Exception("Vue introuvable : $viewFile");
        }
    }

    /**
     * Alias pour compatibilité avec anciens contrôleurs
     */
    public function view($view, $data = [])
    {
        $this->render($view, $data);
    }

    /**
     * Redirection vers une URL
     */
    public function redirect($url)
    {
        header("Location: " . BASE_URL . '/' . $url);
        exit;
    }

    /**
     * Restriction par rôle
     * @param array|string $roles
     */
    public function requireRole($roles)
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash_error'] = "Vous devez être connecté.";
            $this->redirect('auth/login');
        }

        $userRole = $_SESSION['user']['role'] ?? '';

        // Convertir string en tableau
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        // superadmin peut tout faire
        if ($userRole === 'superadmin') {
            return;
        }

        // Vérifie si le rôle est autorisé
        if (!in_array($userRole, $roles)) {
            $_SESSION['flash_error'] = "Accès refusé.";
            $this->redirect('home/index');
        }
    }
}
