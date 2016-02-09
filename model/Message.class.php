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
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message ( from_user_id,to_user_id,message,message_det_id,date_time ) VALUES (:from_user_id,:to_user_id,:message,:message_det_id,NOW()) ");
        $arrVals = array('from_user_id'=>$_SESSION['user_id'],'to_user_id'=>$params['toid'],'message'=>$params['message'],'message_det_id'=>$_SESSION['chat_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return "TRUE";
    }
    
    function getUserMsgs($params)
    {
//        die(print_r($params));
        //die(print_r($params));
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message as message LEFT JOIN ".$this->tb_prefix."users as users ON message.from_user_id = users.user_id WHERE ( (message.from_user_id =:from_user_id AND message.to_user_id = :to_user_id) || (message.from_user_id =:to_user_id AND message.to_user_id = :from_user_id) ) AND message.message_det_id = :message_det_id");
        $arrVals = array('from_user_id'=>$_SESSION['user_id'],'to_user_id'=>$params['toid'],'message_det_id'=>$_SESSION['chat_id']);
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
            $result[$i]['first_name']    = $row['first_name'];
            $result[$i]['last_name']     = $row['last_name'];
            $result[$i]['profile_image'] = $row['profile_image'];
            $result[$i]['file_type']     = $row['file_type'];
            $result[$i]['file_name']     = $row['file_name'];
            $i++;
        }
        
        return $result;
    }
    
    function uploadFile($params,$file,$imageFileType)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message ( from_user_id,to_user_id,message,message_det_id,date_time ) VALUES (:from_user_id,:to_user_id,:message,:message_det_id,NOW()) ");
        $arrVals = array('from_user_id'=>$_SESSION['user_id'],'to_user_id'=>$params['tousrid'],'message'=>'','message_det_id'=>$_SESSION['chat_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $lastId  = $this->dbconn->lastInsertId();
        $filename = $lastId.'.'.$imageFileType;
        move_uploaded_file($file['filename']['tmp_name'], '..'.DIRECTORY_SEPARATOR.CHAT_PICS_FOLDER.DIRECTORY_SEPARATOR.$filename);
        //die('..'.DIRECTORY_SEPARATOR.CHAT_PICS_FOLDER.DIRECTORY_SEPARATOR.$filename);
        
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."message SET file_name = :file_name, file_type = :file_type WHERE message_id = :message_id");
        $arrVals = array('file_name'=>$filename,'file_type'=>1,'message_id'=>$lastId);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        return "TRUE";
    }
}

?>