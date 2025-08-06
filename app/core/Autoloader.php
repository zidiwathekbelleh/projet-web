<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $paths = [
            APP . '/models/' . $class . '.php',
            APP . '/controllers/' . $class . '.php',
            APP . '/core/' . $class . '.php',
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                require_once $path;
                return;
            }
        }
    }
}
