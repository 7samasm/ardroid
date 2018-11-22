<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/16/2018
 * Time: 4:13 PM
 */

namespace  mvc\pub;

use mvc\app\lib\FrontController;

require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php';
require_once APP_PATH . DS . 'lib' . DS . 'AutoLoad.php';

$frontController  =  new FrontController();
$frontController->dispatch();