<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 17:17
 */

namespace Qui\core;


class BoundMethodWrapper
{
    public $method;
    public $class;

    public function __construct($method, $class)
    {
        $this->method = $method;
        $this->class = $class;
    }

    public function run(...$args)
    {
        // pass all args to apps bound method
        $method = $this->method;
        $class = $this->class;
        (new $class)->$method(...$args);
    }
}