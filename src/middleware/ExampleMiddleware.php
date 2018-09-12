<?php

namespace Qui\middleware;

use Qui\interfaces\IMiddleware;

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/09/18
 * Time: 19:06
 */

class ExampleMiddleware implements IMiddleware
{
    public function next(): bool {
        return true;
    }
}