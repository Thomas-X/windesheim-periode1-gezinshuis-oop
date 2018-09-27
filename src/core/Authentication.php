<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/09/18
 * Time: 19:47
 */

namespace Qui\core;


use phpDocumentor\Configuration\Merger\Annotation\Replace;
use Qui\core\facades\DB;
use Qui\core\facades\Util;

class Authentication
{
    // increase this when hardware can handle more salting rounds
    const SALTING_ROUNDS = 10;
    const HASHING_OPTIONS = [
        'cost' => Authentication::SALTING_ROUNDS
    ];

    public static function login(Request $req, Response $res, string $email, string $password)
    {
        $user = static::verifyCredentials($email, $password);
        if ($user['isValid'] == true) {
            // 1 week cookie time()+60*60*24*365 sec = 1 week
            // TODO enable secure option to avoi man-in-the-middle attacks
            setcookie('token', $user['rememberMeToken'], time() + 60 * 60 * 24 * 7, '/');
            $res->redirect('/', 200);
        } else {
            $res->redirect('/', 401);
        }
    }

    public static function logout(Request $req, Response $res)
    {
        $token = $req->cookies['token'] ?? false;
        if (!token) {
            // for some reason $res->redirect is undefined here, I can't be bothered
            header("Location: /");
        } else {
            setcookie('token', null, time() + 1, '/');
            header("Location: /");
        }
    }

    /*
     * not uniquely random but since the chances of that are so abysmal its fine by me
     * */
    public static function generateRandomHash()
    {
        $str = substr(str_shuffle(MD5(microtime())), 0, 99);
//        Util::dd($str);
//        var_dump($str);
        return static::generateHash((string) $str);
    }

    /*
     * TODO implement register (generate random string and hash it for the rememberMeToken)
     * */
    public static function register(Request $req, Response $res)
    {
        // check / validate parameters with Validator
        $rememberMeToken = static::generateRandomHash();
        $params = $req->params;
        DB::insertEntry('users', [
            'fname' => $params['fname'],
            'lname' => $params['lname'],
            'email' => $params['email'],
            'mobile' => $params['mobile'],
            'roles_id' => $params['roles_id'],
            'password' => static::generateHash($params['password']),
            'rememberMeToken' => $rememberMeToken
        ]);
        // DB::insertEntry();
    }

    /**
     * @return bool
     */
    public static function verify($returnUser = false)
    {
        $token = $_COOKIE['token'] ?? false;
        if (!$token) {
            return false;
        } else {
            $foundUsers = DB::selectWhere($returnUser ? '*' : 'rememberMeToken', 'users', 'rememberMeToken', $token);
            if (count($foundUsers) == 1) {
                $user = $foundUsers[0];
                if ($user && !$returnUser) {
                    return true;
                } else {
                    return $user;
                }
            } else {
                return false;
            }
        }
    }

    private static function generateHash(string $string)
    {
        // password_default = bcrypt but can change in newer versions, in case it does hashes are re-generated
        return password_hash($string, PASSWORD_DEFAULT, Authentication::HASHING_OPTIONS);
    }

    private static function verifyHash(string $hash, string $password)
    {
        return password_verify($password, $hash);
    }

    private static function verifyCredentials(string $email, string $password)
    {
        $users = DB::select('password, email, rememberMeToken', 'users');
        foreach ($users as $user) {
            // if matches, user has filled in correct password
            if (static::verifyHash($user['password'], $password) && $email == $user['email']) {
                if (password_needs_rehash($user['password'], PASSWORD_BCRYPT, Authentication::HASHING_OPTIONS)) {
                    // since the password is verified to be the correct one we can use the user input here to hash
                    $hash = static::generateHash($password);
                    DB::updateEntry(2, 'users', [
                        'password' => "{$hash}",
                    ]);
                }
                return [
                    'rememberMeToken' => $user['rememberMeToken'],
                    'isValid' => true,
                ];
            }
        }
        return [
            'rememberMeToken' => null,
            'isValid' => false,
        ];
    }
}