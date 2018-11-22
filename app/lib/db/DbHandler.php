<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/21/2018
 * Time: 5:56 PM
 */

namespace mvc\app\lib\db;


abstract class DbHandler
{
    const DB_DRIVER_PDO    = 1;
    const DB_DRIVER_MYSQLI = 2;

    private function __construct(){}
    abstract protected static function init();
    abstract public static function getInstance();

    public static function factory()
    {
        $driver = DB_CONN_DRIVER ;
        if ($driver == self::DB_DRIVER_PDO)
        {
            return PdoDbHandler::getInstance();
        }
    }
}