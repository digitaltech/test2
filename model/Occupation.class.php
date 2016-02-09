<?php

class Occupation
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."occupation ( occupation_name ) VALUES (:occupation_name) ");
        $arrVals = array('occupation_name'=>$params['occupname']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function delete($id)
    {
        $qrystmt = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."occupation WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function update($params)
    {
        $qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."occupation SET occupation_name = :occupation_name WHERE serial_no = :serial_no  ");
        $arrVals = array('occupation_name'=>$params['constname'],'serial_no'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."occupation ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $result = array();
        $row    = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']       = $row['serial_no'];
            $result[$i]['occupation_name'] = $row['occupation_name'];
            $i++;
        }
        
        return $result;
    }
    
    function getById($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."occupation WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result = array();
        $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>