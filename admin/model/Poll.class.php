<?php
require_once '../config/classload.php';
class Poll
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    
    function add($params)
    {
        //die(print_r($params));
         $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."polls (topic,constituency_id)  VALUES (:topic,(SELECT constituency_id from ".$this->tb_prefix."users WHERE user_id = :user_id)) ");
         $arrVals = array('topic'=>$params['topic'],'user_id'=>$_SESSION['user_id']);
         $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
         //die(print_r($_SESSION));
         $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."users SET noti_poll = :noti_poll WHERE constituency_id = :constituency_id");
         $arrVals = array('noti_poll'=>1,'constituency_id'=>$_SESSION['constituency_id']);
         $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
         
         return TRUE;
    }
    
    function getById($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."polls WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$id);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $result  = $qrstmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function getAll()
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."polls");
        $arrVals = array();
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $row  = array();
        $i = 0;
        while ($row = $qrstmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no'] = $row['serial_no'];
            $result[$i]['topic'] = $row['topic'];
            $i++;
        }
        
        return $result;
    }
    
    function update($params)
    {
         $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."polls SET topic = :topic WHERE serial_no = :serial_no ");
         $arrVals = array('topic'=>$params['topic'],'serial_no'=>$params['id']);
         $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
         return TRUE;
    }
    
    function delete($params)
    {
        $qrstmt = $this->dbconn->prepare("DELETE  FROM ".$this->tb_prefix."polls WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$params['id']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        return $result;
    }
}

?>