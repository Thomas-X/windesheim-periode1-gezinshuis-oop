<?php

namespace TestApp;

class Twig {
    static public $loader;
    static public $twig;

    public static function render (string $viewName, array $data) {
        Twig::$twig->render($viewName, $data);
    }
}