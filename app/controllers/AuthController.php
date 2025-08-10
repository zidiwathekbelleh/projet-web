<?php

class AuthController extends Controller
{
    public function login()
    {
        // Si déjà connecté → redirige vers dashboard
        if (!empty($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/admin/dashboard");
            exit;
        }

        $error = null;

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: " . BASE_URL . "/admin/dashboard");
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        // Afficher la vue login
        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }
}
