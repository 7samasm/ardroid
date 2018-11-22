<?php

define('DS', DIRECTORY_SEPARATOR );
define('APP_PATH' , dirname(__FILE__));
define('VIEWS_PATH' , APP_PATH . DS . 'views' . DS);
define('TEMPLATE' , APP_PATH . DS . 'template' . DS);

//DATABASE CONSTS
defined('DB_HOST_NAME')   ? null : define('DB_HOST_NAME', 'localhost');
defined('DB_USER_NAME')   ? null : define('DB_USER_NAME', 'root');
defined('DB_PASSWORD')    ? null : define('DB_PASSWORD', '');
defined('DB_DB_NAME')     ? null : define('DB_DB_NAME', 'chromenet');
defined('DB_PORT_NUMBER') ? null : define('DB_PORT_NUMBER', 3306);
defined('DB_CONN_DRIVER') ? null : define('DB_CONN_DRIVER', 1);
