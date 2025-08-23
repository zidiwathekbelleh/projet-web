<?php
// app/core/Router.php

class Router
{
    public function dispatch()
    {
        // Récupérer l'URL depuis la query string
        $url = !empty($_GET['url']) ? trim($_GET['url'], '/') : 'auth/login';
        $segments = explode('/', $url);

        // Mapping URL → contrôleur
        $controllerMap = [
            'participations' => 'ParticipationController',
            // tu peux ajouter d'autres mappings si besoin
        ];

        $controllerKey = $segments[0] ?? 'home';
        $controllerName = $controllerMap[$controllerKey] ?? ucfirst($controllerKey) . 'Controller';

        // Méthode / action
        $action = $segments[1] ?? 'index';

        // Paramètres à passer à la méthode
        $params = array_slice($segments, 2);

        // Vérifier que le contrôleur existe
        if (!class_exists($controllerName)) {
            http_response_code(404);
            die("Contrôleur introuvable : $controllerName");
        }

        $controller = new $controllerName();

        // Vérifier que la méthode existe
        if (!method_exists($controller, $action)) {
            http_response_code(404);
            die("Action introuvable : $action dans $controllerName");
        }

        // Appeler la méthode avec les paramètres
        try {
            call_user_func_array([$controller, $action], $params);
        } catch (ArgumentCountError $e) {
            http_response_code(400);
            die("Erreur : paramètres manquants pour $controllerName::$action");
        } catch (Exception $e) {
            http_response_code(500);
            die("Erreur serveur : " . $e->getMessage());
        }
    }
}
