<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 14/09/18
 * Time: 18:33
 */

namespace Qui;

/*
 * usage:
 * $validator = new \Qui\Validator();

    dd($validator
        ->isLen('addd', 4)
        ->isEmail('t@t.nl')
        ->validate()
    );

 * */
class Validator
{
    private $validators = [];
    private const EMAIL_REGEX = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/';


    private function addValidator($value)
    {
        $this->validators[] = $value;
    }

    private function typeValidator($val, $type, $reversed = false)
    {
        if (gettype($val) == $type) {
            if (!$reversed) {
                $this->addValidator(true);
            } else {
                $this->addValidator(true);
            }
        } else {
            if (!$reversed) {
                $this->addValidator(false);
            } else {
                $this->addValidator(true);
            }
        }
        return $this;
    }

    // Chainable type/regex checkers
    public function isString($string)
    {
        return $this->typeValidator($string, 'string');
    }

    public function isInt($int)
    {
        return $this->typeValidator($int, 'integer');
    }

    public function isFloat($float)
    {
        return $this->typeValidator($float, 'double');
    }

    public function isNotNull($value)
    {
        return $this->typeValidator($value, 'NULL');
    }

    public function isLen($value, $len)
    {
        if (gettype($value) == 'string') {
            if (strlen($value) == $len) {
                $this->addValidator(true);
            } else {
                $this->addValidator(false);
            }
        } else if (gettype($value) == 'array') {
            if (count($value) == $len) {
                $this->addValidator(true);
            } else {
                $this->addValidator(false);
            }
        } else {
            $this->addValidator(false);
        }
        return $this;
    }

    public function isAlphaNumeric(string $value)
    {
        if (ctype_alnum($value)) {
            $this->addValidator(true);
        } else {
            $this->addValidator(false);
        }
        return $this;
    }

    public function isEmail($value)
    {
        $result = preg_match_all(Validator::EMAIL_REGEX, $value);
        if ($result == 1) {
            $this->addValidator(true);
        } else {
            $this->addValidator(false);
        }
        return $this;
    }

    // End of chain
    public function validate()
    {
        foreach ($this->validators as $validator) {
            if ($validator == false) {
                return false;
            }
        }
        return true;
    }
}