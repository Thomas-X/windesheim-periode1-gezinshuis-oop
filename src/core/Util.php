<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 16:43
 */

namespace Qui\core;


class Util
{

    /*
     * Simple dump and die function, idea stolen from laravel :)
     * */
    public function dd($value, $extraValues=null)
    {
        $args = func_get_args();
        if ($args > 1) {
            foreach ($args as $index => $argv) {
                var_dump($argv);
            }
        } else {
            var_dump($value);
        }
        die;
    }
}