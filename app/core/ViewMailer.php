<?php

class ViewMailer
{
    public static function render($view, $data = [])
    {
        $viewFile = APP . "/views/emails/{$view}.php";
        if (!file_exists($viewFile)) {
            throw new Exception("Template email introuvable : $viewFile");
        }

        extract($data);
        ob_start();
        require $viewFile;
        return ob_get_clean();
    }
}
