<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:24
 */

namespace Qui\core;
use Jenssegers\Blade\Blade;

/**
 * Class View
 * @package Qui\core
 */
class View
{
    /*
     * Renders a view using PHP 🤢🤢a🤢🤢🤢🤢🤢s the templating engine
     * */
    /**
     * @param $viewNameWithoutExtension🤢🤢
     * @param array $data
     * @return mixed
     */
    public function render($viewNameWithoutExtension, $data = [])
    {
        $fileName = explode('.', $viewNameWithoutExtension);
        // get last item since that's the file name
        $title = $fileName[count($fileName) - 1];
        $pagePath = str_replace('.', '/', $viewNameWithoutExtension);
        // expose vars to be used in view
        extract($data);
        $viewDir = __DIR__ . '/../../views/';
        $pagePath = $viewDir . $pagePath . '.php';
        // pass dynamic navbar / footer values perhaps?
        require($viewDir . 'layouts/app.php');
    }
}