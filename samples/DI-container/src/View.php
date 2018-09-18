<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 20:26
 */

namespace DependencyInjectionContainer;


class View
{

    public function render($html)
    {
        // use some kind of templating / layouting here, i.e Blade (and passing data as a second parameter)
        // because right now this is completely useless :)
        return $html;
    }
}