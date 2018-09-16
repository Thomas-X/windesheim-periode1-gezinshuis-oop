<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 14/09/18
 * Time: 18:33
 */

namespace Qui\core;

/*
 * usage:
 * $validator = new \Qui\Validator();

    dd($validator
        ->isLen('addd', 4)
        ->isEmail('t@t.nl')
        ->validate()
    );

 * */

/*
 * the specific methods don't need much explaining, the naming should speak for how the method works, e.g isEmail()
 * */

/**
 * Class Validator
 * @package Qui\core
 */
class Validator
{
    private $validators = [];
    private const EMAIL_REGEX = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/';

    /**
     * @param $value
     * @param $message
     */
    private function addValidator($value, $message)
    {
        $this->validators[] = [
            'result' => $value,
            'message' => $message
        ];
    }

    /**
     * @param $val
     * @param $type
     * @param array $messages
     * @param bool $isNot
     * @return $this
     */
    private function typeValidator($val, $type, array $messages, $isNot=false)
    {
        if (gettype($val) == $type) {
            $this->addValidator(true, $messages['messageTrue']);
        } else {
            if ($isNot) {
                $this->addValidator(true, $messages['messageTrue']);
            } else {
                $this->addValidator(false, $messages['messageFalse']);
            }
        }
        return $this;
    }

    /**
     * @param $val
     * @param array $messages
     */
    private function nonTypeValidator($val, array $messages)
    {

        // verbose, but readable
        if ($val == true) {
            $this->addValidator($val, $messages['messageTrue']);
        } else if ($val == false) {
            $this->addValidator($val, $messages['messageFalse']);
        }
    }

    /**
     * @param $field
     * @return array
     */
    private function message($field)
    {
        return [
            'messageTrue' => null,
            'messageFalse' => "Invalid field: {$field}"
        ];
    }

    // Chainable type/regex checkers

    /**
     * @param $string
     * @param string $field
     * @return Validator
     */
    public function isString($string, $field='isString')
    {
        return $this->typeValidator($string, 'string', $this->message($field));
    }

    /**
     * @param $int
     * @param string $field
     * @return Validator
     */
    public function isInt($int, $field='isInt')
    {
        return $this->typeValidator($int, 'integer', $this->message($field));
    }

    /**
     * @param $float
     * @param string $field
     * @return Validator
     */
    public function isFloat($float, $field='isFloat')
    {
        return $this->typeValidator($float, 'double', $this->message($field));
    }

    /**
     * @param $value
     * @param string $field
     * @return Validator
     */
    public function isNotNull($value, $field='isNotNull')
    {
        return $this->typeValidator($value, 'NULL', $this->message($field));
    }

    /**
     * @param $value
     * @param $len
     * @param string $field
     * @return $this
     */
    public function isLen($value, $len, $field='isLen')
    {
        if (gettype($value) == 'string') {
            if (strlen($value) == $len) {
                $this->nonTypeValidator(true, $this->message($field));
            } else {
                $this->nonTypeValidator(false, $this->message($field));
            }
        } else if (gettype($value) == 'array') {
            if (count($value) == $len) {
                $this->nonTypeValidator(true, $this->message($field));
            } else {
                $this->nonTypeValidator(false, $this->message($field));
            }
        } else {
            $this->nonTypeValidator(false, $this->message($field));
        }
        return $this;
    }

    /**
     * @param string $value
     * @param string $field
     * @return $this
     */
    public function isAlphaNumeric(string $value, $field='isAlphaNumeric')
    {
        if (ctype_alnum($value)) {
            $this->nonTypeValidator(true, $this->message($field));
        } else {
            $this->nonTypeValidator(false, $this->message($field));
        }
        return $this;
    }

    /**
     * @param $value
     * @param string $field
     * @return $this
     */
    public function isEmail($value, $field='isEmail')
    {
        $result = preg_match_all(Validator::EMAIL_REGEX, $value);
        if ($result == 1) {
            $this->nonTypeValidator(true, $this->message($field));
        } else {
            $this->nonTypeValidator(false, $this->message($field));
        }
        return $this;
    }

    // End of chain

    /**
     * @return array
     */
    public function validate(): array
    {
        $messages = [];
        foreach ($this->validators as $validator) {
            if ($validator['result'] == false) {
                // Reset validators since the same instance is going to be used in the App binding,
                // thus creating conflicts if the validators aren't 'flushed'
                $messages[] = $validator['message'];
            }
        }
        $this->validators = [];
        // if there are no error messages, that means we've passed the validation
        $passed = count($messages) == 0;

        return compact('passed', 'messages');
    }
}