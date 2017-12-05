<?php

class Database
{
    const USERNAME = 'root';
    const PASSWORD = '';
    const DSN = 'mysql:dbname=dip_site4;host=localhost';

    private static $_connection;
    private static $_instance;

    /**
     * Initiate the database connexion
     */
    private function __construct()
    {
        try {
            static::$_connection = new PDO(static::DSN, static::USERNAME, static::PASSWORD);
        } catch (PDOException $e) {
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
    public static function __callStatic($name, $arguments){
        if (is_null(static::$_instance)){
            static::$_instance=new Database();
        }
        if (method_exists(static::$_instance, $name)){
            return call_user_func(['Database', $name], $arguments[0]);
        }else{
            throw new Exception('Unknown method!');
        }
    }

    /**
     * Retrieve data.
     * @param $query
     * @return array
     * @throws Exception
     */
    private static function query($query)
    {
        $result = static::$_connection->query($query);
        if (!$result) {
            throw new Exception('Request error');
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute statement.
     * @param $query
     * @return int
     */
    private static function exec($query)
    {
        return static::$_connection->exec($query);
    }

}