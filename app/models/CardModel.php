<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/21/2018
 * Time: 4:32 PM
 */

namespace mvc\app\models;

use mvc\app\lib\db\DbHandler;
use mvc\app\lib\InputFilter;

class CardModel extends ParentModel
{
    use InputFilter;

    private $ID;
    private $IMG;
    private $HEADER;
    private $ADMIN_ID;
    private $DATE;
    private $TITLE;
    private $BLOG;
    private $PARTS;
    private $TAGS;

    protected static $tableName  = 'cards';
    protected static $pk         = 'ID';
    /*
     * table's scheme with no ID or Date
     * used for bindparms
     */
    protected static $tableFilds = array(
        'IMG'      => self::DT_STR,
        'HEADER'   => self::DT_STR,
        'ADMIN_ID' => self::DT_INT,
        'TITLE'    => self::DT_STR,
        'BLOG'     => self::DT_STR,
        'PARTS'    => self::DT_STR,
        'TAGS'     => self::DT_STR
    );

    public static function getCards ($option)
    {
        $cond = false;
        try
        {
            $sql  = 'SELECT ' .
                        static::$tableName . '.*, admins.first_name , admins.sec_name ' .
                    'FROM ' . static::$tableName . ' ' .
                    'LEFT JOIN admins ON ' .
                        static::$tableName . '.ADMIN_ID = admins.adminID' . ' ' . $option;
            $stmt = DbHandler::factory()->prepare($sql);
            $stmt->execute();
            if (method_exists(get_called_class(), '__construct'))
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableFilds));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            if (is_array($res) && !empty($res))
            {
                $generator =
                    function () use ($res) {
                        foreach ($res as $oneResult) {
                            yield $oneResult;
                        }
                    };
                $cond = $generator();
            }
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $cond;
    }

    public static function getCardsByPk ($pk)
    {
        $cond = false;
        try
        {
            $sql  = 'SELECT ' .
                        static::$tableName . '.*, admins.first_name , admins.sec_name ' .
                    'FROM ' . static::$tableName . ' ' .
                    'LEFT JOIN admins ON ' .
                        static::$tableName . '.ADMIN_ID = admins.adminID ' .
                    'WHERE ' .
                        static::$tableName . '.ID = ' . $pk;
            $stmt = DbHandler::factory()->prepare($sql);
            if ($stmt->execute()) {
                if (method_exists(get_called_class(), '__construct'))
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableFilds));
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
                if (!empty($obj)) $cond =  array_shift($obj) ;
            }
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $cond;
    }
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
        $this->ID = InputFilter::filterInt($ID);
    }

    /**
     * @return mixed
     */
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * @param mixed $IMG
     */
    public function setIMG($IMG)
    {
        $this->IMG = InputFilter::filterStr($IMG);
    }

    /**
     * @return mixed
     */
    public function getHEADER()
    {
        return $this->HEADER;
    }

    /**
     * @param mixed $HEADER
     */
    public function setHEADER($HEADER)
    {
        $this->HEADER = InputFilter::filterStr($HEADER);
    }

    /**
     * @return mixed
     */
    public function getADMIN_ID()
    {
        return $this->ADMIN_ID;
    }

    /**
     * @param mixed $ADMIN_ID
     */
    public function setADMIN_ID($ADMIN_ID)
    {
        $this->ADMIN_ID = InputFilter::filterInt($ADMIN_ID);
    }

    /**
     * @return mixed
     */
    public function getDATE()
    {
        return $this->DATE;
    }

    /**
     * @param mixed $DATE
     */
    public function setDATE($DATE)
    {
        $this->DATE = InputFilter::filterStr($DATE);
    }

    /**
     * @return mixed
     */
    public function getTITLE()
    {
        return $this->TITLE;
    }

    /**
     * @param mixed $TITLE
     */
    public function setTITLE($TITLE)
    {
        $this->TITLE = InputFilter::filterStr($TITLE);
    }

    /**
     * @return mixed
     */
    public function getBLOG()
    {
        return $this->BLOG;
    }

    /**
     * @param mixed $BLOG
     */
    public function setBLOG($BLOG)
    {
        $this->BLOG = $BLOG;
    }

    /**
     * @return mixed
     */
    public function getPARTS()
    {
        return $this->PARTS;
    }

    /**
     * @param mixed $PARTS
     */
    public function setPARTS($PARTS)
    {
        $this->PARTS = InputFilter::filterStr($PARTS);
    }

    /**
     * @return mixed
     */
    public function getTAGS()
    {
        return $this->TAGS;
    }

    /**
     * @param mixed $TAGS
     */
    public function setTAGS($TAGS)
    {
        $this->TAGS = InputFilter::filterStr($TAGS);
    }



}
