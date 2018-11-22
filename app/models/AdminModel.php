<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/21/2018
 * Time: 4:32 PM
 */

namespace mvc\app\models;


use mvc\app\lib\InputFilter;

class AdminModel extends ParentModel
{
    use InputFilter;

    private $ID;
    private $a_name;
    private $a_pass;
    private $a_email;
    protected static $tableName  = 'admins';
    protected static $pk         = 'ID';
    protected static $tableFilds = array(
        'a_name'  => self::DT_STR,
        'a_pass'  => self::DT_STR,
        'a_email' => self::DT_STR
    );

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getA_name()
    {
        return $this->a_name;
    }

    /**
     * @param mixed $a_name
     */
    public function setA_name($a_name)
    {
        $this->a_name = $a_name;
    }

    /**
     * @return mixed
     */
    public function getA_pass()
    {
        return $this->a_pass;
    }

    /**
     * @param mixed $a_pass
     */
    public function setA_pass($a_pass)
    {
        $this->a_pass = $a_pass;
    }

    /**
     * @return mixed
     */
    public function getA_email()
    {
        return $this->a_email;
    }

    /**
     * @param mixed $a_email
     */
    public function setA_email($a_email)
    {
        $this->a_email = $a_email;
    }

}
