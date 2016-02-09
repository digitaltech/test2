<?php

class TimeHall
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    
    function add($params)
    {
         //die(print_r($params));
         $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message_timehall_details (chat_room_name,chat_title,user_id,from_time,to_time)  VALUES (:chat_room_name,:chat_title,:user_id,:from_time,:to_time) ");
         $arrVals = array('chat_room_name'=>$params['roomname'],'chat_title'=>$params['title'],'user_id'=>$_SESSION['user_id'],'from_time'=>$params['fromtime'],'to_time'=>$params['totime']);
         $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
         return TRUE;
    }
    
    function getById($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message_timehall_details WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$id);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $result  = $qrstmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function getAll()
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."message_timehall_details");
        $arrVals = array();
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $row  = array();
        $i = 0;
        while ($row = $qrstmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']      = $row['serial_no'];
            $result[$i]['chat_room_name'] = $row['chat_room_name'];
            $result[$i]['chat_title']     = $row['chat_title'];
            $result[$i]['from_time']      = $row['from_time'];
            $result[$i]['to_time']        = $row['to_time'];
            $i++;
        }
        
        return $result;
    }
    
    function update($params)
    {
         $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."message_timehall_details SET chat_room_name = :chat_room_name,chat_title = :chat_title,from_time = :from_time,to_time = :to_time WHERE serial_no = :serial_no ");
         $arrVals =  array('chat_room_name'=>$params['roomname'],'chat_title'=>$params['title'],'from_time'=>$params['fromtime'],'to_time'=>$params['totime'],'serial_no'=>$params['id']);
         $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
         return TRUE;
    }
    
    function delete($params)
    {
        $qrstmt = $this->dbconn->prepare("DELETE  FROM ".$this->tb_prefix."survey WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$params['id']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        return $result;
    }
    
    function updateNotiStat()
    {
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."users SET noti_town_hall = :noti_town_hall WHERE user_id = :user_id");
        $arrVals = array('noti_town_hall'=>0,'user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
}

?>