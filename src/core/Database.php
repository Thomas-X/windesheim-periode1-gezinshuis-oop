<?php

namespace Qui\core;

use Illuminate\Database\Capsule\Manager as Capsule;

/*
 * A wrapper around the PDO class, pulls DB data from .env for a connection.
 * Also exposes an eloquent query builder instance, which is the adapter the DB facade uses
 * */

/**
 * Class Database
 * @package Qui\core
 */
// TODO add CRUD query methods
class Database
{
    public $pdo;
    public $eloquent;

    public function __construct()
    {
       // Util::dd((\PDO::getAvailableDrivers()));
        try {
            // We can't use App::get('env') here since (most likely) it's yet to be defineds
            $DB_CLIENT = $_ENV['DB_CLIENT'];
            $DB_HOST = $_ENV['DB_HOST'];
            $DB_NAME = $_ENV['DB_NAME'];
            $DB_PORT = $_ENV['DB_PORT'];
            $DB_USERNAME = $_ENV['DB_USERNAME'];
            $DB_PASSWORD = $_ENV['DB_PASSWORD'];
            $DB_UNIX_SOCKET = $_ENV['DB_UNIX_SOCKET'];
            $opts = compact('DB_CLIENT', 'DB_HOST', 'DB_NAME', 'DB_PORT', 'DB_USERNAME', 'DB_PASSWORD', 'DB_UNIX_SOCKET');
            $this->setupPDO($opts);
            // no eloquent 4 u
//            $this->setupEloquent($opts);
        } catch (Exception $err) {
            dd($err);
        }
    }

    /**
     * @param $opts
     */
    private function setupPDO($opts) {

        $dsn = "{$opts['DB_CLIENT']}:host={$opts['DB_HOST']};dbname={$opts['DB_NAME']};port={$opts['DB_PORT']}";

        if ($opts['DB_UNIX_SOCKET']) {
            $dsn = "{$opts['DB_CLIENT']}:unix_socket={$opts['DB_UNIX_SOCKET']};dbname={$opts['DB_NAME']}";
        }

        $this->pdo = new \PDO($dsn, $opts['DB_USERNAME'], $opts['DB_PASSWORD'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    /**
     * @param $opts
     */
    private function setupEloquent($opts)
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => $opts['DB_CLIENT'],
            'host'      => $opts['DB_HOST'],
            'database'  => $opts['DB_NAME'],
            'username'  => $opts['DB_USERNAME'],
            'password'  => $opts['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'unix_socket' => $opts['DB_UNIX_SOCKET'] ?? ''
        ]);

        // Make this Capsule instance available globally via static methods
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM
        $capsule->bootEloquent();

        $this->eloquent = $capsule;
    }
    
    /*
     * A little short hand for a query statement.
     * */
    /**
     * @param $sql
     * @param array $values
     * @return array | bool
     */
    public function execute($sql, $values = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $val = $stmt->execute($values);
        // If the query is a INSERT/UPDATE/DELETE type then ->fetch is undefined ofcourse
        // Hence why were just returning the boolean here

        // if it was a select statement, we can fetch the rows
        if (strpos($stmt->queryString, 'SELECT') !== false) {
            $results = [];
            while ($row = $stmt->fetch()) {
                $results[] = $row;
            }
            return $results;
        } else {
            // anything else must be an INSERT/UPDATE/DELETE query. bad_code

            // if the CUD query actually changed something, return true, otherwise the query failed because CUD queries should always update 1 row, at least
            if ($stmt->rowCount() > 0) {
                return true;
            }
            return false;
        }
    }

    /*
     * Update an entry in the database, could be any table you want.
     * Usage:
     * DB::updateEntry(1337, 'user', ['name' => 'HELLO WORLD', 'email' => 'Thomas-22']);
     * */

    // TODO avoid SQL injection (because right now the values are put straight into the query)
    public function updateEntry($id, $table, array $values)
    {
        $query = "UPDATE {$table} SET ";
        $idx = 0;
        $rowValues = [];
        foreach ($values as $rowKey => $value) {
            // first loop, meaning we shouldn't prepend a , before the value
            if ($idx == 0) {
                $query = $query . "{$rowKey} = ?";
            } else {
                $query = $query . ", {$rowKey} = ?";
            }
            $rowValues[] = $value;
            $idx++;
        }
        $query = $query . " WHERE (`id` = {$id})";
        return $this->execute($query, $rowValues);
    }

    public function selectAll(string $table)
    {
        return $this->execute("SELECT * FROM {$table}");
    }

    public function select(string $fields, string $table)
    {
        return $this->execute("SELECT {$fields} FROM ${table}");
    }
}