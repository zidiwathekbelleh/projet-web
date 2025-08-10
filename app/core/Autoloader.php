<?php
// app/core/Autoloader.php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        // racine et chemins
        $rootPath = dirname(__DIR__, 1); // app/
        $projectRoot = dirname($rootPath); // projet-web
        $paths = [
            $rootPath . '/core/' . $class . '.php',
            $rootPath . '/controllers/' . $class . '.php',
            $rootPath . '/models/' . $class . '.php',
            $projectRoot . '/app/config/' . $class . '.php',
            $projectRoot . '/app/config/' . strtolower($class) . '.php',
            $projectRoot . '/config/' . $class . '.php',
            $projectRoot . '/config/' . strtolower($class) . '.php',
        ];

        foreach ($paths as $file) {
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }

        // Si tu préfères ne pas lancer d'exception en prod, tu peux logger au lieu de throw
        throw new Exception("Classe introuvable : $class");
    }
}
