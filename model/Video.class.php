<?php
require_once '../config/classload.php';

class Video
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params,$files)
    {
        //die(print_r($files));
        $arrVals = array('user_id'=>$_SESSION['user_id'],'title'=>$params['title'],'content'=>$params['content'],'file_name'=>'','file_type'=>2);   
        $qrystmt  = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."posts (user_id,title,content,file_name,file_type,date_time) VALUES (:user_id,:title,:content,:file_name,:file_type,NOW()) ");
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $presName = rand(1, 6);
        $lastId  = $this->dbconn->lastInsertId();
        //$lastId = $_SESSION['user_id'];
        $imageFileType = pathinfo($files['upfile']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        //die($presName);
        if ($imageFileType == "mp4" || $imageFileType == "wav" )
        {
            
            $movedFile = move_uploaded_file($files['upfile']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".UPLOAD_VIDEOS_FOLDER."/".$presName);
            //die(var_dump($movedFile));
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."posts SET file_name = :file_name,file_type = :file_type WHERE serial_no = :serial_no");
                $arrVals = array('serial_no'=>$lastId,'file_name'=>$presName,'file_type'=>$imageFileType);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }
        }
        
        return TRUE;
    }
    
    function getAll()
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE is_active = :is_active AND is_admin = :is_admin  ");
        if ($params['type'] == "frontusers")
        {
            $arrVal = array('is_active'=>1,'is_admin'=>0);
        }
        else if ($params['type'] == "admins")
        {
            $arrVal = array('is_active'=>1,'is_admin'=>1);
        }
       
        
        $qrystmt->execute($arrVal) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_id']    = $row['user_id'];
            $result[$i]['user_email'] = $row['user_email'];
            $result[$i]['user_name']  = $row['user_name'];
            $result[$i]['user_id']    = $row['user_id'];
            $i++;
        }
        return $result;
    }
    
    function delete($id)
    {
        $qrystmt  = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."users WHERE user_id = :user_id");
        $arrVals = array('user_id'=>$userid);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getById($id)
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE user_id = :user_id");
        $arrVals = array('user_id'=>$userid);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
        $result   = $qrystmt->fetch(PDO::FETCH_ASSOC);
            
        return $result;
    }
    
    function update($params,$files)
    {
       //die(print_r($params));
        $query = "UPDATE  ".$this->tb_prefix."users SET user_email = :user_email, user_name = :user_name,constituency_id = :constituency_id";
        $arrVals = array('user_id'=>$params['userid'],'user_email'=>$params['usremail'],'user_name'=>$params['usrnm'],'constituency_id'=>$params['constituency']);
       if (isset($params['password']) && $params['password']!='' )
        {
            $query = $query." ,user_password = :user_password ";
            $arrVals['user_password'] = sha1($params['password']);
        }
        
        $query = $query." WHERE user_id = :user_id ";
        //die(print_r($query));
       // die(print_r($arrVals));
        $qrystmt  = $this->dbconn->prepare($query);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $presName = rand(1, 6);
        $lastId = $_SESSION['user_id'];
        $imageFileType = pathinfo($files['profileimg']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")
        {
            
            $movedFile = move_uploaded_file($files['profileimg']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".PROFILE_PICS_FOLDER."/".$presName);
            //die(var_dump($movedFile));
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."users SET profile_image = :profile_image WHERE user_id = :user_id");
                $arrVals = array('user_id'=>$_SESSION['user_id'],'profile_image'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }
        }
        
        return TRUE;
    }
    
    
}

?>