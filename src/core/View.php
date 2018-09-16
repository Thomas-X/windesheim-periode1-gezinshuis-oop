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
     * Renders a view using Blade as the templating engine
     * */
    /**
     * @param $viewNameWithoutExtension
     * @param array $data
     * @return mixed
     */
    public function render($viewNameWithoutExtension, $data = [])
    {
        $blade = new Blade(__DIR__ . '/../../views', __DIR__ . '/../../cache');
        return $blade->make($viewNameWithoutExtension, $data);
    }
}