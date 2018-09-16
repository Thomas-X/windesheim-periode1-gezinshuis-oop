<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 16/09/18
 * Time: 00:52
 */

namespace Qui\core;


class Response
{

    public function __construct()
    {

    }


    public function json($object)
    {
        return json_encode($object);
    }

    public function redirect($path, $code = 302, $permanent=false)
    {
        http_response_code($permanent ? 301 : $code);
        header("Location: {$path}");
        // to avoid further logic after redirect
        exit();
    }
}