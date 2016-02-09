<?php
require_once '../config/classload.php';
class Message{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message ( from_user_id,to_user_id,message,date_time,message_det_id ) VALUES (:from_user_id,:to_user_id,:message,NOW(),:message_det_id) ");
        $arrVals = array('from_user_id'=>$_SESSION['user_id'],'to_user_id'=>$params['toid'],'message'=>$params['message'],'message_det_id'=>$params['msgdetid']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return "TRUE";
    }
    
    function getUserMsgs($params)
    {
        //die(print_r($params));
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message as message LEFT JOIN ".$this->tb_prefix."users as users ON message.from_user_id = users.user_id WHERE message.from_user_id =:from_user_id AND message.to_user_id = :to_user_id || message.from_user_id =:to_user_id AND message.to_user_id = :from_user_id");
        $arrVals = array('from_user_id'=>$_SESSION['user_id'],'to_user_id'=>$params['toid']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        $result = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['message_id']    = $row['message_id'];
            $result[$i]['from_user_id']  = $row['from_user_id'];
            $result[$i]['to_user_id']    = $row['to_user_id'];
            $result[$i]['message']       = $row['message']; 
            $result[$i]['date_time']     = $row['date_time'];
            $result[$i]['user_name']     = $row['user_name'];
            $result[$i]['profile_image'] = $row['profile_image'];
            $i++;
        }
        
        return $result;
    }
    
    function lastMsgDetId($params)
    {
        $qrystmt = $this->dbconn->prepare("SELECT message_det_id FROM ".$this->tb_prefix."message WHERE  from_user_id = :from_user_id ORDER BY message_det_id DESC  ");
        $arrVals = array('from_user_id'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result = array();
        $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result['message_det_id'];
    }
}

?>