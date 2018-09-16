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
     * creates an anonymous function out of a method. (currently unused after facades, could be used in the future so not removing)
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
            throw new \Exception("{$key} not found in App DI container, did you remove a required dependency?");
        }
        static::$val = static::$registry[$key];
        // If is a method binding
        if (gettype(static::$val) == 'array' && array_key_exists('method', static::$val) && array_key_exists('class', static::$val)) {
            return (new BoundMethodWrapper(static::$val['method'], static::$val['class']));
        }

        return static::$registry[$key];
    }

    public static function setupDependencies($deps)
    {
        // Bind dependencies to DI container
        foreach ($deps as $key => $dep) {
            App::bind($key, $dep);
        }
        $requireds = ['view', 'database', 'validator', 'router'];
        foreach ($requireds as $required) {
            // let it throw an error if key is undefined
            static::get($required);
        }
    }

    public static function setupRoutes()
    {
        require  __DIR__ . '/../../routes/web.php';
    }

    public static function run()
    {
        static::$registry['router']->serve();
    }
}