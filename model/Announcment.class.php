<?php

class Announcment
{
     function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params,$file,$imageFileType)
    {
        //die(print_r($params));
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."announcment (title,content,file_name,constituency_id,date_time)  VALUES (:title,:content,:file_name,(SELECT constituency_id from ".$this->tb_prefix."users WHERE user_id = :user_id),NOW()) ");
        $arrVals = array('title'=>$params['title'],'content'=>$params['content'],'file_name'=>'','user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $lastId  = $this->dbconn->lastInsertId();
        $filename = $lastId.'.'.$imageFileType;
        move_uploaded_file($file['filename']['tmp_name'], '../../'.UPLOAD_PICS_FOLDER.'/'.$filename);
        //die('../..'.DIRECTORY_SEPARATOR.UPLOAD_PICS_FOLDER.DIRECTORY_SEPARATOR.$filename);
        
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."announcment SET file_name = :file_name WHERE serial_no = :serial_no");
        $arrVals = array('file_name'=>$filename,'serial_no'=>$lastId);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        
        return TRUE;
    }
    
    function delete($params)
    {
        $qrystmt = $this->dbconn->prepare("DELETE FROM".$this->tb_prefix."announcment WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getById($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."announcment WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result  = array();
        $result  = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."announcment as announcment INNER JOIN ".$this->tb_prefix."constituency as constituency ON announcment.constituency_id = constituency.serial_no ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result  = array();
        $row   = array();
        $i = 0;
        
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no'] = $row['serial_no'];
            $result[$i]['title'] = $row['title'];
            $result[$i]['content'] = $row['content'];
            $result[$i]['date_time'] = $row['date_time'];
            $result[$i]['file_name'] = $row['file_name'];
            $result[$i]['constituency_id'] = $row['constituency_id'];
            $i++;
        }
        return $result;
    }
    
    function update($params)
    {
        $qrstmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."announcment SET title = :title,content = :content WHERE serial_no = :serial_no");
        $arrVals = array('title'=>$params['title'],'content'=>$params['content'],'serial_no'=>$params['id']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function updateNotiStat()
    {
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."users SET noti_post = :noti_post WHERE user_id = :user_id");
        $arrVals = array('noti_post'=>0,'user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
}

?>