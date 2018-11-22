<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/17/2018
 * Time: 4:36 PM
 */

namespace mvc\app\controllers;


use mvc\app\lib\FrontController;
use mvc\app\lib\Helper;

abstract class ParentController
{
    use Helper;

    private $controller;
    private $action ;
    private $params = [];
    protected $data   = [];

    public function notfounAction()
    {
        $this->view();
    }

    protected function view()
    {
        if($this->action == FrontController::NOT_FOUND_ACTION)
            static::notFound();
        $view = VIEWS_PATH . $this->controller . DS . $this->action . '.view.php';
        if (file_exists($view))
        {
            extract($this->data);
            require_once  TEMPLATE . 'header.dev.php';
            require_once $view;
            require_once TEMPLATE . 'footer.php';
        }
    }

    protected function adminView()
    {
        if($this->action == FrontController::NOT_FOUND_ACTION)
            static::notFound();
        $view = VIEWS_PATH . $this->controller . DS . $this->action . '.view.php';
        if (file_exists($view))
        {
            extract($this->data);
            require_once TEMPLATE . 'admin.header.php' ;
            if ($this->action != 'default')
            {
                require_once TEMPLATE . 'admin.nav.php' ;
            }
            require_once $view;
            require_once TEMPLATE . 'admin.footer.php';
        }
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

}
