<?php
// app/core/Router.php

class Router
{
    public function dispatch()
    {
        // récupérer url
        $url = '';
        if (!empty($_GET['url'])) {
            $url = trim($_GET['url'], '/');
        } else {
            // optionnel : route par défaut
            $url = 'auth/login';
        }

        $segments = explode('/', $url);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $action = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        if (!class_exists($controllerName)) {
            // essayer de charger la classe (autoload fait cela habituellement)
            throw new Exception("Contrôleur introuvable : $controllerName");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            throw new Exception("Action introuvable : $action dans $controllerName");
        }

        // appeler l'action avec paramètres
        call_user_func_array([$controller, $action], $params);
    }
}
