<?php

namespace mini;

//*****
//TO-DO: validate input data for every query by using bindValue()
//TO-DO: complete different queries with general conditions

use PDO;

class Database extends PDO {
    public function __construct() {
        parent::__construct(Mini::$db['type'] . ':' . Mini::$db['dbname'], 
                Mini::$db['username'], 
                Mini::$db['password'], 
                Mini::$db['options']);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function select($table, $params = [], $fetchMethod = PDO::FETCH_OBJ)
    {
        $q = "select * from $table";
        if (!empty($params)) {
            $q .= " where";
            $sq = "";
            foreach ($params as $key => $param) {
                if ($sq === '') {
                    $sq = " " . $key . " = '" . $param . "'";
                } else {
                    $sq .= " and " . $key . " = '" . $param . "'";
                }
            }
            $q .= $sq;
        }
        return $this->query($q)->fetchAll($fetchMethod);
    }
    
    public function insert($table, $data)
    {
        $columns = '';
        $values = '';
        foreach ($data as $key => $value) {
            if ($columns === '') {
                $columns = '"' . $key . '"';
                $values = '"' . $value . '"';
            } else {
                $columns .= ', "' . $key . '"';
                $values .= ', "' . $value . '"';
            }
        }
        $q = "insert into $table($columns) values ($values)";
        $this->exec($q);
        return $this->lastInsertId();
    }
    
    public function delete($table, $params)
    {
        $q = "delete from $table";
        if (!empty($params)) {
            $q .= " where";
            $sq = "";
            foreach ($params as $key => $param) {
                if ($sq === '') {
                    $sq = " " . $key . "='" . $param . "'";
                } else {
                    $sq .= " and " . $key . "='" . $param . "'";
                }
            }
            $q .= $sq;
        }        
        return $this->exec($q);
    }
    
    public function update($table, $data, $where)
    {
        $s = '';
        foreach ($data as $key => $value) {
            if ($s === '') {
                $s = '' . $key . ' = "' . $value . '"';
            } else {
                $s .= ', ' . $key . ' = "' . $value . '"';
            }
        }
        $w1 = '';
        foreach ($where as $key => $value) {
            if ($w1 === '') {
                $w1 = '' . $key . ' = "' . $value . '"';                
            } else {
                $w1 .= ' and ' . $key . ' = "' . $value . '"';
            }
        }
        $q = "update $table set $s where $w1";
        return $this->exec($q);
    }
}
