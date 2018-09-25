<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/09/18
 * Time: 19:47
 */

namespace Qui\core;


use Qui\core\facades\DB;

class Authentication
{
    // increase this when hardware can handle more salting rounds
    const SALTING_ROUNDS = 10;

    public static function login($email, $password)
    {
        return static::verifyCredentials($email, $password);
        // TODO implement login set cookie stuff.
    }

    private static function generateHash($string)
    {
        return password_hash($string, PASSWORD_BCRYPT, ['cost' => static::SALTING_ROUNDS]);
    }

    private static function verifyHash(string $hash, string $password)
    {
        return password_verify($password, $hash);
    }

    private static function verifyCredentials($email, $password)
    {
        $users = DB::select('password, email', 'user');
        foreach ($users as $user) {
            // if matches, user has filled in correct password
            if (static::verifyHash($user['password'], $password) && $email == $user['email']) {
                //TODO re-hash with newer algo's maybe? using password_needs_rehash
                return true;
            }
        }
        return false;
    }
}