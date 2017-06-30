<?php
/*
 * Created by PhpStorm.
 * User: DiniX
 * Date: 27-Jun-17
 * Time: 10:05 AM
 */
echo "test tes test";

abstract class table
{
    protected $id = null;
    protected $tableName = null;

    function __construct()
    {
    }


    protected function buildQuery($task)
    {
        $sql = '';
        if ($task == 'load') {
            $sql = "SELECT * from {$this->tableName} where id = '{$this->id}'";
            return $sql;
        } elseif ($task == 'insert') {
            $keys = "";
            $values = "";
            $classAttributes = get_class_vars(get_class($this));
            $sql .= "INSERT into {$this->tableName} ";
            foreach ($classAttributes as $key => $value) {
                if ($key == "tableName") {
                    continue;
                }
                $keys .= "{$key},";
                $values .= "'{$this->$key}',";
            }
            $sql .= "(" . substr($keys, 0, -1) . ") Values(" . substr($values, 0, -1) . ")";
            echo $sql;
            return $sql;
        } elseif ($task == 'update') {
            $classAttributes = get_class_vars(get_class($this));
            $sql .= "UPDATE {$this->tableName} set ";
            foreach ($classAttributes as $key => $value) {
                if ($key == "id" || $key == "table") {
                    continue;
                }
                $sql .= "{$key} = '{$this->$key}',";
            }
            $sql = substr($sql, 0, -1) . " where id = {$this->id}";
            echo $sql;
            return $sql;
        }
    }

    function load($dbObj, $id)
    {
        $this->id = $id;
        //$dbObj = database::getInstance();
        $sql = $this->buildQuery('load');
        $dbObj->doQuery($sql);
        $rows = $dbObj->loadObjList();
        foreach ($rows as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $this->$key = $value;
        }
    }

    function insert($dbObj)
    {
        //$dbObj = database::getInstance();
        $sql = $this->buildQuery('insert');
        $dbObj->doQuery($sql);
    }

    function update($dbObj)
    {
        //$dbObj = database::getInstance();
        $sql = $this->buildQuery('update');
        $dbObj->doQuery($sql);
    }

    function featuredLoad($dbObj,$sql){
        $dbObj->doQuery($sql);
        $rows = $dbObj->loadObjList();
        return $rows;
    }

    function bind($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
?>