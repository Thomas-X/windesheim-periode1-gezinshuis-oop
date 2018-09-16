<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 17:17
 */

namespace Qui\core;

/*
 * this is just a simple wrapper for the method of a class to be called in, syntactic sugar basically
 * without this wrapper you'd do something like:
 * App::get('dd')('a string');
 * with:
 * App::Get('dd')->run('a string');
 * */

/**
 * Class BoundMethodWrapper
 * @package Qui\core
 */
class BoundMethodWrapper
{
    public $method;
    public $class;

    /**
     * BoundMethodWrapper constructor.
     * @param $method
     * @param $class
     */
    public function __construct($method, $class)
    {
        $this->method = $method;
        $this->class = $class;
    }

    /**
     * @param mixed ...$args
     */
    public function run(...$args)
    {
        // pass all args to apps bound method
        $method = $this->method;
        $class = $this->class;
        (new $class)->$method(...$args);
    }
}