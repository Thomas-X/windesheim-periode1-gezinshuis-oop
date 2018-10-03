<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 04/10/18
 * Time: 00:09
 */

namespace Qui\lib;


class CNotifierParser
{
    private $parseVal = [];
    private $curId = null;

    public function newNotify()
    {
        $count = count($this->parseVal);
        $this->curId = $count;
        // nothing more than a wrapper, atm.
        return $this;
    }

    public function condition(bool $condition)
    {
        $this->parseVal[$this->curId]['success'] = $condition;
        return $this;
    }

    public function message(string $message)
    {
        $this->parseVal[$this->curId]['message'] = $message;
        return $this;
    }
}