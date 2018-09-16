<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 22:29
 */

namespace Qui\core\facades;


use Qui\core\App;

/*
 * This facade uses a magic method, __callStatic. This is called when a static method is called that doesn't exist
 * So for example:
 * Router::get('/', 'ExampleController@showHome')
 * >> doesn't exist in our Facade class, resulting in __callStatic getting called
 *
 * then when __callStatic gets called, we get the method and the arguments passed to said method and try to use the instance that's in the DI container (App class)
 *
 * tl;dr: when Route::get gets called, the magic method __callStatic is called because it's undefined, then we pass the instance that's in the App and use the method of that
 * this is actually pretty cool.
 * */
class Facade
{
    protected static $resolvedInstance;

    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        if (! $instance) {
            throw new \RuntimeException('A facade root has not been set.');
        }
        return $instance->$method(...$args);
    }

    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }
        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }
        return static::$resolvedInstance[$name] = App::get($name);
    }
}