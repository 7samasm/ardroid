<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/17/2018
 * Time: 3:46 PM
 */

namespace mvc\app\controllers;

use mvc\app\lib\Helper;
use mvc\app\lib\InputFilter;
use mvc\app\models\CardModel;

class IndexController extends ParentController
{
    use Helper;

    public function defaultAction()
    {
        $this->data['cards']  = CardModel::getCards('Order BY `ID` DESC');
        $this->data['panels'] = CardModel::getAll('Order BY `ID` ASC LIMIT 3');
        $this->view();
    }

    public function searchAction()
    {
        if (isset($_GET['q']) && $_GET['q'] !='') {
            $srch  =   InputFilter::filterStr($_GET['q']);
            $where =  'WHERE `HEADER` LIKE ' . "\"%{$srch}%\"" ;
            $this->data['cards']  = CardModel::getCards($where .' Order BY `ID` DESC');
            $this->data['panels'] = CardModel::getAll('Order BY `ID` ASC LIMIT 3');
            $this->data['vars']   =
            [
                'count'     => CardModel::totalCount('`HEADER`','LIKE',"%{$srch}%"),
                'getSearch' => $srch
            ];
            $this->view();
        }
        else
        {
            require_once VIEWS_PATH . 'notFound' . DS . 'notfound.view.php';
        }
    }

    public function sectionAction()
    {
        if ( !isset(static::arrayMvc()[2]) || static::arrayMvc()[2] == '' ) static::notFound();
        $urlMvc = static::arrayMvc()[2];
        $this->data['cards']  = CardModel::getCards('WHERE PARTS = "' . $urlMvc .'" Order BY `ID` DESC');
        $this->data['panels'] = CardModel::getAll('Order BY `ID` ASC LIMIT 3');
        $this->data['vars']   = [$urlMvc];
        $this->view();
    }

    public function tagAction()
    {
        if ( !isset(static::arrayMvc()[2]) || static::arrayMvc()[2] == '' ) static::notFound();
        $urlMvc = static::arrayMvc()[2];
        $tagUrl = str_replace('-','_', $urlMvc);
        $option = ' WHERE TAGS REGEXP ' . "'[[:<:]]$tagUrl".'[[:>:]]\'' . ' Order BY `ID` DESC';
        $this->data['cards']  = CardModel::getCards($option);
        $this->data['panels'] = CardModel::getAll('Order BY `ID` ASC LIMIT 3');
        $this->data['vars']   = ['tagUrl' => $tagUrl];
        $this->view();
    }

    public function articleAction()
    {
        if (empty($this->getParams())) static::notFound();
        $param = $this->getParams()[0];
        $id =  is_numeric($param) ? intval($param) : 0;
        $count = CardModel::totalCount('`ID`','=', "$id");
        if ($count === 1)
        {
            $this->data['article']   = CardModel::getCardsByPk("$id");
            $this->data['panels']    = CardModel::getAll('Order BY `ID` ASC LIMIT 3');
            $this->view();
            exit();
        }
        static::notFound();
    }
}
