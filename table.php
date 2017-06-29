<?php
echo"branch check";
echotest;

/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 27-Jun-17
 * Time: 10:05 AM
 */
abstract class table
{
    protected $id = null;
    protected $table = null;

    function __construct()
    {
    }


    protected function buildQuery($task){
        $sql = '';
        if($task == 'load'){
            $sql = "SELECT * from {$this->table} where id = '{$this->id}'";
            return $sql;
        }
        elseif ($task == 'store'){
            if($this->id == null){
                $keys = "";
                $values = "";
                $classAttributes = get_class_vars(get_class($this));
                $sql .= "INSERT into {$this->table} ";
                foreach($classAttributes as $key=>$value){
                    if ($key == "id" || $key =="table"){
                        continue;
                    }

                    $keys .= "{$key},";
                    $values .="'{$this->$key}',";
                }
                $sql .= "(".substr($keys,0,-1).") Values(".substr($values,0,-1).")";
                echo $sql;
                return $sql;
            }else{
                $classAttributes = get_class_vars(get_class($this));
                $sql .= "UPDATE {$this->table} set";
                foreach($classAttributes as $key=>$value){
                    if ($key == "id" || $key =="table"){
                        continue;
                    }
                    $sql .= "{$key} = '{$this->$key}',";
                }
                $sql = substr($sql,0,-1)." where id = {$this->id}";
                return $sql;
            }
        }
    }

    function load($id){
        $this->id = $id;
        $dbObj = database::getInstance();
        $sql = $this->buildQuery('load');
        $dbObj->doQuery($sql);
        $rows = $dbObj->loadObjList();
        foreach ($rows as $key=> $value){
            if($key == 'id'){
                continue;
            }
            $this->$key = $value;
        }
    }

    function store(){
        $dbObj = database::getInstance();
        $sql = $this->buildQuery('store');
        $dbObj->doQuery($sql);
    }

    function bind($data){
        foreach($data as $key=>$value){
            $this->$key = $value;
        }
    }

}
?>