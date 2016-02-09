<?php
require_once '../config/classload.php';
class MessageGroup{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message_group ( user_id,room_id,message,date_time ) VALUES (:user_id,:room_id,:message,NOW()) ");
        $arrVals = array('user_id'=>$_SESSION['user_id'],'room_id'=>$params['roomid'],'message'=>$params['message']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return "TRUE";
    }
    
    function getUserMsgs($params)
    {
        //die(print_r($params));
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message_group as message LEFT JOIN ".$this->tb_prefix."users as users ON message.user_id = users.user_id  LEFT JOIN ".$this->tb_prefix."message_group_details as message_details ON message.room_id = message_details.serial_no WHERE message.room_id= :room_id ");
        $arrVals = array('room_id'=>$params['roomid']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        $result = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['message_id']     = $row['message_id'];
            $result[$i]['user_id']        = $row['user_id'];
            $result[$i]['message']        = $row['message']; 
            $result[$i]['user_name']      = $row['user_name'];
            $result[$i]['first_name']     = $row['first_name'];
            $result[$i]['last_name']      = $row['last_name'];
            $result[$i]['profile_image']  = $row['profile_image'];
            $result[$i]['date_time']      = $row['date_time'];
            $result[$i]['file_name']      = $row['file_name'];
            $result[$i]['file_type']      = $row['file_type'];
            $result[$i]['liked_user_ids'] = $row['liked_user_ids'];
			$result[$i]['chat_room_name'] = $row['chat_room_name'];
			$result[$i]['chat_title']     = $row['chat_title'];
            $i++;
        }
        
        return $result;
    }
    
    function createGroup($params)
    {
        //die(print_R($params));
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message_group_details (chat_room_name,chat_title,user_id) VALUES(:chat_room_name,:chat_title,:user_id)");
        $arrVals = array('chat_room_name'=>$params['name'],'chat_title'=>$params['topic'],'user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
        
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message_group_details ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i=0;
        $row = array();
        $result = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']      = $row['serial_no'];
            $result[$i]['chat_room_name'] = $row['chat_room_name'];
            $result[$i]['chat_title']     = $row['chat_title'];
            $i++;
        }
        return $result;
    }
    
    function uploadFile($params,$file,$imageFileType)
    {//die(print_r($params));
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message_group ( user_id,room_id,message,date_time ) VALUES (:user_id,:room_id,:message,NOW()) ");
        $arrVals = array('user_id'=>$_SESSION['user_id'],'room_id'=>$params['toroomid'],'message'=>'');
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $lastId  = $this->dbconn->lastInsertId();
        $filename = $lastId.'_group.'.$imageFileType;
        move_uploaded_file($file['filename']['tmp_name'], '..'.DIRECTORY_SEPARATOR.CHAT_PICS_FOLDER.DIRECTORY_SEPARATOR.$filename);
        //die('..'.DIRECTORY_SEPARATOR.CHAT_PICS_FOLDER.DIRECTORY_SEPARATOR.$filename);
        
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."message_group SET file_name = :file_name, file_type = :file_type WHERE message_id = :message_id");
        $arrVals = array('file_name'=>$filename,'file_type'=>1,'message_id'=>$lastId);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        return "TRUE";
    }
    
    
    function likeMsg($params)
    {
        //die(print_r($params));
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."message_group SET liked_user_ids =  CONCAT(liked_user_ids,:liked_user_ids ) WHERE message_id  = :message_id ");
        $arrVals = array('liked_user_ids'=>$_SESSION['user_id'].",",'message_id'=>$params['msgid']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
}

?>