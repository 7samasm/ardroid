<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/21/2018
 * Time: 6:28 PM
 */

namespace mvc\app\lib\db;


use mvc\app\lib\Helper;

class PdoDbHandler extends DbHandler
{
    use Helper;

    private static $_instance;
    private static $_handler;

    private function __construct()
    {
        self::init();
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array(self::$_handler ,$name) ,$arguments);
    }

    protected static function init()
    {
        $dsn  = 'mysql:host=' . DB_HOST_NAME .';dbname=' . DB_DB_NAME ;
        $user = DB_USER_NAME ;
        $pass = DB_PASSWORD;
        $opt = array(
            \PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        try {
            self::$_handler = new \PDO($dsn,$user,$pass,$opt);
            self::$_handler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return self::$_handler;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
