<?php

class Database
{
    const USERNAME = 'root';
    const PASSWORD = '';
    const DSN = 'mysql:dbname=dip_site4;host=localhost';

    private $_connection;
    private static $_instance;

    private function __construct()
    {
        try {
            $this->_connection = new PDO(static::DSN, static::USERNAME, static::PASSWORD);
        } catch (PDOException $e) {
            echo 'Error :' . $e->getMessage();
        }
        $this->_connection->exec('SET NAMES \'utf8\'');
    }

    public static function __callStatic($name, $arguments){
        if (is_null(static::$_instance)){
            static::$_instance=new Database();
        }
        if (method_exists(static::$_instance, $name)){
            return call_user_func([static::$_instance, $name], $arguments[0]);
        }else{
            throw new Exception('Unknown method!');
        }
    }

    private function query($query)
    {
        $result = $this->_connection->query($query);
        if (!$result) {
            throw new Exception('Request error');
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exec($query)
    {
        return $this->_connection->exec($query);
    }

}