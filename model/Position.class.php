<?php

class Position
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."position ( position_name ) VALUES (:position_name) ");
        $arrVals = array('position_name'=>$params['posname']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function delete($id)
    {
        $qrystmt = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."position WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function update($params)
    {
        $qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."position SET position_name = :position_name WHERE serial_no = :serial_no  ");
        $arrVals = array('position_name'=>$params['posname'],'serial_no'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."position ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $result = array();
        $row    = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']      = $row['serial_no'];
            $result[$i]['position_name']  = $row['position_name'];
            $i++;
        }
        
        return $result;
    }
    
    function getById($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."position WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result = array();
        $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>