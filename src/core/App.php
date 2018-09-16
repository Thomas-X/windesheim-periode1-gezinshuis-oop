<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 16:22
 */

namespace Qui\core;

use Qui\core\BoundMethodWrapper;

/*
 *  A simple DI container named App.
 * */
class App
{
    public const GET = 'GET';
    public const POST = 'POST';

    private static $registry = [];
    // tmp scoping variable for 'monkey' patching a bound method
    private static $val;

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    /*
     * creates an anonymous function out of a method.
     * */
    public static function bindMethod($key, $methodName, $classNamespaced) {
        static::$registry[$key] = [
            'method' => $methodName,
            'class' => $classNamespaced
        ];
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception('{$key} not found in App DI container');
        }
        static::$val = static::$registry[$key];
        // If is a method binding
        if (gettype(static::$val) == 'array' && array_key_exists('method', static::$val) && array_key_exists('class', static::$val)) {
            return (new BoundMethodWrapper(static::$val['method'], static::$val['class']));
        }

        return static::$registry[$key];
    }
}