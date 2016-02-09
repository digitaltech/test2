<?php
require_once '../config/classload.php';
class Poll
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
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
    
    function getAllByConstId($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."polls WHERE constituency_id = :constituency_id");
        $arrVals = array('constituency_id'=>$id);
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
    
    function vote($params)
    {
        //die(print_r($params));
        $qrstmt = $this->dbconn->prepare(" INSERT INTO ".$this->tb_prefix."user_poll ( poll_id,user_id,vote ) VALUES ( :poll_id,:user_id,:vote ) ");
        $arrVals = array('poll_id'=>$params['id'],'user_id'=>$_SESSION['user_id'],'vote'=>$params['option']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getUsrVtByPollId($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT poll_id FROM ".$this->tb_prefix."user_poll WHERE poll_id = :poll_id AND user_id = :user_id");
        $arrVals = array('poll_id'=>$id,'user_id'=>$_SESSION['user_id']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        if ($qrstmt->rowCount() >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function updateNotiStat()
    {
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."users SET noti_poll = :noti_poll WHERE user_id = :user_id");
        $arrVals = array('noti_poll'=>0,'user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
}

?>