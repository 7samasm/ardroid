<?php
/**
 * Created by PhpStorm.
 * User: ha
 * Date: 4/27/18
 * Time: 11:44 AM
 */

namespace mvc\app\controllers;

use mvc\app\lib\Helper;
use mvc\app\lib\SessionHandler;
use mvc\app\models\AdminModel;
use mvc\app\models\CardModel;

class AdminController extends ParentController
{
    use Helper;
    use SessionHandler;


    public function defaultAction()
    {
        ob_start();
        session_start();
        if (isset($_POST['login']))
        {
            $name = $_POST['username'];
            $pass = sha1($_POST['password']);

            $am = new AdminModel();
            $am->setA_Name($name);
            $am->setA_Pass($pass);
            $row = $am->login('a_name','a_pass');
            $bool =  !empty($row) && $row['a_name'] === $name;
            if ($bool)
            {
                $session = ['CnAdmin' => $name , 'cnAdminID' => intval($row['adminID'])];
                static::setSessionArray($session);
                $this->redirect('/admin/control');
            }
        }
        if (static::isSessionFound())
        {
            $this->redirect('/admin/control');
        }
        $this->adminView();
        ob_end_flush();
    }



    public function ControlAction()
    {
        ob_start();
        session_start();
        if (static::isSessionFound())
        {
            $sn = static::getSession('cnAdminID');
            $option = $sn === 1
                ? 'ORDER BY `ID` DESC'
                : 'WHERE ADMIN_ID = ' . $sn . ' ORDER BY `ID` DESC';
            $this->data['rows'] = CardModel::getCards($option);
            $this->adminView();
        }
        else
        {
            $this->redirect('/admin');
        }
        ob_end_flush();
    }



    public function addAction()
    {
        ob_start();
        session_start();
        if (static::isSessionFound())
        {
            $formErrors = array();

            if (isset($_POST['add'])) {
                /*// files
                $type      = $_FILES['file'] ['type'];
                $size      = $_FILES['file'] ['size'];
                $file_name = $_FILES['file'] ['name'];
                $file_from = $_FILES['file'] ['tmp_name'];
                $f         = $_FILES['file'] ['dir'];
                $dir = "/images/" . $file_name;
                if (in_array($type,array('image/png','image/jpeg')))
                {
                    if ($size < 200000)
                    {
                        move_uploaded_file($file_from, $dir);
                        $path = $type == '' ? '' : $file_name;
                    }
                    else
                    {
                        $formErrors[] = 'يجب ان تقل حجم الصورة عن 200kb' ;
                    }
                }
                else
                {
                    $formErrors[] = 'هذا الملف ليس بصورة' ;
                }*/

                if (empty($formErrors)) {
                    $card = new CardModel();
                    $card->setIMG('flat.png');
                    $card->setHEADER($_POST['header']);
                    $card->setTITLE($_POST['title']);
                    $card->setPARTS($_POST['parts']);
                    $card->setBLOG($_POST['blog']);
                    $card->setTAGS($_POST['tags']);
                    $card->setADMIN_ID($_SESSION['cnAdminID']);
                    if ($card->insert()) {
                        $this->redirect('/admin/control');
                    }
                }
            }
            $this->data['optionsParts'] = CardModel::getOptions('PARTS');
            $this->adminView();
        }
        else
        {
            $this->redirect('/admin');
        }
        ob_end_flush();
    }



    public function editAction()
    {
        ob_start();
        session_start();
        if (static::isSessionFound())
        {
            if (empty($this->getParams()))
            {
                static::notFound();
            }
            else
            {
                if (isset($_POST['update'])) {
                    $card = new CardModel();
                    $card->setID      ($_POST['id'    ]);
                    $card->setIMG     ('flat.png');
                    $card->setHEADER  ($_POST['header']);
                    $card->setTITLE   ($_POST['title' ]);
                    $card->setPARTS   ($_POST['parts' ]);
                    $card->setBLOG    ($_POST['blog'  ]);
                    $card->setTAGS    ($_POST['tags'  ]);
                    $card->setADMIN_ID($_POST['adminid'  ]);
                    if ($card->update()) {
                        $this->redirect('/admin/control');
                    }
                }
                $param = $this->getParams()[0];
                $id =  is_numeric($param) ? intval($param) : 0;
                $count = CardModel::totalCount('`ID`','=', "$id");
                if ($count === 1)
                {
                    $this->data['cards'] = CardModel::getByPk($id);
                    $this->data['optionsParts'] = CardModel::getOptions('PARTS');
                    $this->adminView();
                }
                else
                {
                    static::notFound();
                }
            }
        }
        else
        {
            $this->redirect('/admin');
        }
        ob_end_flush();
    }



    public function deleteAction()
    {
        ob_start();
        session_start();
        if (static::isSessionFound())
        {
            $id = $this->getParams()[0];
            $id = intval($id);
            $emp = CardModel::getByPk($id);
            if ($emp->delete())
            {
                $this->redirect('/admin/control');
            }
        }
        ob_end_flush();
    }

    public function logoutAction()
    {
        session_start();
        if(session_destroy())                 // Destroying All Sessions
        {
            $this->redirect('/admin');  // Redirecting To Home Page
        }
    }



}