<?php

namespace Qui;

class Database
{
    public static $pdo;

    public static function init()
    {
        try {
            $DB_CLIENT = $_ENV['DB_CLIENT'];
            $DB_HOST = $_ENV['DB_HOST'];
            $DB_NAME = $_ENV['DB_NAME'];
            $DB_PORT = $_ENV['DB_PORT'];
            $DB_USERNAME = $_ENV['DB_USERNAME'];
            $DB_PASSWORD = $_ENV['DB_PASSWORD'];
            $DB_UNIX_SOCKET = $_ENV['DB_UNIX_SOCKET'];

            $dsn = "{$DB_CLIENT}:host={$DB_HOST};dbname={$DB_NAME};port={$DB_PORT}";

            if ($DB_UNIX_SOCKET) {
                $dsn = "{$DB_CLIENT}:unix_socket={$DB_UNIX_SOCKET};dbname={$DB_NAME}";
            }

            Database::$pdo = new \PDO($dsn, $DB_USERNAME, $DB_PASSWORD, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (Exception $err) {
            dd($err);
        }
    }

    public static function execute($sql, $values = [])
    {
        $results = [];
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute($values);
        while ($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
}