<?php
/**
 * Created by PhpStorm.
 * User: ha
 * Date: 5/8/18
 * Time: 2:14 PM
 */

namespace mvc\app\lib;


trait SessionHandler
{
    public static function isSessionFound ($session = 'CnAdmin')
    {
        $bool = false;
        if (isset($_SESSION[$session]))
        $bool = true;
        return $bool;
    }

    public static function setSession($key , $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function setSessionArray(array $session)
    {
        foreach ($session as $key => $value)
        $_SESSION[$key] = $value;
    }

    public static function  getSession($key)
    {
        return $_SESSION[$key];
    }
}