<?php

namespace Site4;

class Database
{
    const USERNAME = 'root';
    const PASSWORD = 'root';
    const DSN = 'mysql:dbname=dip_site4;host=localhost';

    private static $_connection;
    private static $_instance;

    /**
     * Initiate the database connexion
     */
    private function __construct()
    {
        try {
            static::$_connection = new \PDO(static::DSN, static::USERNAME, static::PASSWORD);
        } catch (\PDOException $e) {
            echo 'Error :' . $e->getMessage();
        }
        static::$_connection->exec('SET NAMES \'utf8\'');
    }

    /**
     * Called before every request to verify if the database is ready before performing a request.
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public static function __callStatic($name, $arguments)
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new Database();
        }
        if (method_exists(static::$_instance, $name)) {
            return call_user_func_array([static::$_instance, $name], $arguments);
        } else {
            throw new Exception('Unknown method!');
        }
    }

    /**
     * Retrieve data.
     * @param $query
     * @param array $arguments
     * @return array
     */
    private static function query(String $query, ...$arguments): array
    {
        $result = static::$_connection->prepare($query);
        $result->execute($arguments);
        if (!$result) {
            throw new Exception('Request error');
        }
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Execute statement.
     * @param String $query
     * @param array $arguments
     * @return bool
     */
    private static function exec(String $query, ...$arguments): bool
    {
        $preparedRequest = static::$_connection->prepare($query);
        return $preparedRequest->execute($arguments);
    }

}