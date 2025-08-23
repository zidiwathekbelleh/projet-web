<?php
function renderEmailView(string $templateRelativePath, array $data = []): string
{
    $path = APP . '/views/' . $templateRelativePath . '.php';
    extract($data, EXTR_SKIP);
    ob_start();
    require $path;
    return ob_get_clean();
}
