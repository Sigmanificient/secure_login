<?php


abstract class Controller
{
    protected function render(string $file)
    {
        ob_start();
        require_once ROOT . '/views/' . $file . '.php';
        $content = ob_get_clean();

        require_once ROOT . '/views/template.phtml';
    }
}