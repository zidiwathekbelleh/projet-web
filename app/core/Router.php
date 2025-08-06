<?php

class Router
{
    public function dispatch()
    {
        $url = $_GET['url'] ?? 'user/index';

        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $segments = explode('/', $url);

        $controllerName = ucfirst($segments[0]) . 'Controller';
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                http_response_code(404);
                echo "Méthode <b>$method()</b> introuvable dans <b>$controllerName</b>.";
            }
        } else {
            http_response_code(404);
            echo "Contrôleur <b>$controllerName</b> introuvable.";
        }
    }
}
