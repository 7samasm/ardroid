<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/16/2018
 * Time: 5:57 PM
 */

namespace mvc\app\lib;


class AutoLoad
{
    public static function autoLoad($className)
    {
        $className = str_ireplace('mvc\\app' ,'', $className );
        $className = str_ireplace('\\' ,'/', $className );
        $className = $className . '.php';
        if (file_exists(APP_PATH . $className)){
            require APP_PATH . $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoLoad');