<?php

class Constituency
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."constituency ( constituency_name ) VALUES (:constituency_name) ");
        $arrVals = array('constituency_name'=>$params['constname']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function delete($id)
    {
        $qrystmt = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."constituency WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function update($params)
    {
        $qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."constituency SET constituency_name = :constituency_name WHERE serial_no = :serial_no  ");
        $arrVals = array('constituency_name'=>$params['constname'],'serial_no'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."constituency ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $result = array();
        $row    = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']         = $row['serial_no'];
            $result[$i]['constituency_name'] = $row['constituency_name'];
            $i++;
        }
        
        return $result;
    }
    
    function getById($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."constituency WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result = array();
        $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>