<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/16/2018
 * Time: 5:10 PM
 */

namespace mvc\app\lib;

class FrontController
{
    private $_frontController = 'index';
    private $_frontAction     = 'default';
    private $_frontParams     = [];

    const NOT_FOUND_ACTION = 'notfounAction';
    const NOT_FOUND_CONTROLLER = 'mvc\app\controllers\NotFoundController';

    public function __construct()
    {
        $this->_parseUrl();
    }

    private function _parseUrl()
    {
        $url = parse_url($_SERVER['REQUEST_URI'] ,PHP_URL_PATH);
        $url = trim( $url, '/');
        $url = explode('/', $url , 3);
        if ($url[0] != '')
        {
            $this->_frontController = $url[0];
        }
        if (isset($url[1]) && $url[1] != '')
            $this->_frontAction =$url[1];
        if (isset($url[2]) && $url[2] != '')
            $this->_frontParams = explode('/',$url[2]);
    }
    public function dispatch()
    {
        $controllerClassName = 'mvc\app\controllers\\' . ucfirst($this->_frontController) . 'Controller';
        $actionName = $this->_frontAction . 'Action';
        if(!class_exists($controllerClassName))
            $this->_frontController = $controllerClassName = self::NOT_FOUND_CONTROLLER;

        $controller = new $controllerClassName();

        if (!method_exists($controller,$actionName))
            $this->_frontAction = $actionName = self::NOT_FOUND_ACTION;

        $controller->setController($this->_frontController);
        $controller->setAction($this->_frontAction);
        $controller->setParams($this->_frontParams);
        $controller->$actionName();
    }

}