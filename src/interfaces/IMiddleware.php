<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/09/18
 * Time: 19:23
 */

namespace Qui\interfaces;


interface IMiddleware
{
    public function next() : bool;
}