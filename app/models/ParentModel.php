<?php
/**
 * Created by PhpStorm.
 * User: HA
 * Date: 2/21/2018
 * Time: 4:18 PM
 */

namespace mvc\app\models;


use mvc\app\lib\db\DbHandler;
use mvc\app\lib\Helper;

abstract class ParentModel
{
    use Helper;

    const DT_BOOL    = \PDO::PARAM_BOOL;
    const DT_STR     = \PDO::PARAM_STR;
    const DT_INT     = \PDO::PARAM_INT;
    const DT_DECIMAL = 4;

    private function buildBindParams()
    {
        $nameParams = '';
        foreach (static::$tableFilds as $coulmnName => $type)
        $nameParams .= $coulmnName . ' =:' . $coulmnName . ', ';
        return trim($nameParams,', ');
    }

    private function buildSpBindParams()
    {
        $bindArr =  explode(', ',$this->buildBindParams());
        $spArr = [];
        foreach ($bindArr as $key => $value)
        $spArr[explode(' ',$value)[0]] = $value;
        return $spArr;
    }

    private function prepareVals(\PDOStatement $stmt)
    {
        foreach (static::$tableFilds as $coulmnName => $type)
        {
            if ($this->{'get'.ucfirst($coulmnName)}() !== null)
            $stmt->bindValue(":{$coulmnName}", $this->{'get' . ucfirst($coulmnName)}(), $type);
        }
    }

    public function login($bindOne , $bindTwo)
    {
        $row = [];
        try
        {
            $sql = 'SELECT * FROM' . ' ' . static::$tableName . ' WHERE ' . $this->buildSpBindParams()[$bindOne] . ' AND ' . $this->buildSpBindParams()[$bindTwo];
            $stmt = DbHandler::factory()->prepare($sql);
            $this->prepareVals($stmt);
            $stmt->execute();
            if ($stmt->rowCount() === 1) $row =  $stmt->fetch();
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $row;
    }

    public function insert()
    {
        $isInsert = false;
        try
        {
            $sql = 'INSERT INTO' . ' ' . static::$tableName . ' SET ' . $this->buildBindParams();
            $stmt = DbHandler::factory()->prepare($sql);
            $this->prepareVals($stmt);
            if ($stmt->execute())
            {
                $this->{'set'.ucfirst(static::$pk)}(DbHandler::factory()->lastInsertId());
                $isInsert = true;
            }
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $isInsert;
    }

    public function update()
    {
        $isUpdate = false;
        try
        {
            $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildBindParams() . ' WHERE ' . static::$pk . ' = ' . $this->{'get' . ucfirst(static::$pk)}();
            $stmt = DbHandler::factory()->prepare($sql);
            $this->prepareVals($stmt);
            if ($stmt->execute()) $isUpdate = true;
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $isUpdate;
    }

    public function delete()
    {
        $isDelete = false;
        try
        {
            $sql = 'DELETE FROM' . ' ' . static::$tableName . ' WHERE ' . static::$pk . ' = ' . $this->{'get' . ucfirst(static::$pk)}();
            $stmt = DbHandler::factory()->prepare($sql);
            $this->prepareVals($stmt);
            if ($stmt->execute()) $isDelete = true;
        }
        catch (\PDOException $e)
        {
          static::printExpDiv($e);
        }
        return $isDelete;
    }

    public static function getAll($option = '')
    {
        $cond = false;
        try
        {
            $sql  = 'SELECT * FROM' . ' ' . static::$tableName . ' ' . $option ;
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

    public static function getByPk($pramPk)
    {
        $cond = false;
        try
        {
            $sql = 'SELECT * FROM' . ' ' . static::$tableName . ' WHERE ' . static::$pk . ' ="' . $pramPk . '"';
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

    public static function totalCount ($coulmn,$sign,$value)
    {
        $count = 0;
        try
        {
            $sql  = "SELECT COUNT($coulmn)" . ' From ' . static::$tableName . ' WHERE ' . $coulmn .' '. $sign . ' ?';
            $stmt = DbHandler::factory()->prepare($sql);
            $stmt->execute(array($value));
            $count =  intval($stmt->fetchColumn());
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $count;
    }

    public static function getOptions ($coulmn)
    {
        $options = [];
        try
        {
            $sql = "SELECT DISTINCT($coulmn)" . ' From ' . static::$tableName;
            $stmt = DbHandler::factory()->prepare($sql);
            $stmt->execute();
            $options = $stmt->fetchAll();
        }
        catch (\PDOException $e)
        {
            static::printExpDiv($e);
        }
        return $options;
    }
}
