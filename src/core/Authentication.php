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
    const HASHING_OPTIONS = [
        'cost' => Authentication::SALTING_ROUNDS
    ];

    public static function login($email, $password)
    {
        return static::verifyCredentials($email, $password);
        // TODO implement login set cookie stuff.
    }

    private static function generateHash($string)
    {
        // password_default = bcrypt but can change in newer versions, in case it does hashes are re-generated
        return password_hash($string, PASSWORD_DEFAULT, Authentication::HASHING_OPTIONS);
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
                if (password_needs_rehash($user['password'], PASSWORD_BCRYPT, Authentication::HASHING_OPTIONS)) {
                    // since the password is verified to be the correct one we can use the user input here to hash
                    $hash = static::generateHash($password);
                    DB::updateEntry(2, 'user', [
                        'password' => "{$hash}",
                    ]);
                }
                return true;
            }
        }
        return false;
    }
}