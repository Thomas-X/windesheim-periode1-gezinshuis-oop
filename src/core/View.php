<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:24
 */

namespace Qui\core;
use Jenssegers\Blade\Blade;

class View
{
    public function render($viewNameWithoutExtension, $data = [])
    {
        $blade = new Blade('views', 'cache');
        return $blade->make($viewNameWithoutExtension, $data);
    }
}