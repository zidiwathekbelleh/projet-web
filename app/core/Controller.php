<?php

class Controller
{
    // Méthode pour afficher une vue
    protected function view($view, $data = [])
    {
        extract($data);
        require_once APP . '/views/' . $view . '.php';
    }

    // ➕ Messages flash : succès, erreur, etc.
    protected function setFlash($key, $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    protected function getFlash($key)
    {
        if (!empty($_SESSION['flash'][$key])) {
            $msg = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
        return null;
    }
}
