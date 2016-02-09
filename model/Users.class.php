<?php
require_once '../config/classload.php';

class Users
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params,$files)
    {
        //die(print_r($params));
        //die(print_r($files));
        $params['password'] = sha1($params['password']);
        $qrystmt  = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."users (first_name,last_name,user_email,user_password,is_active,is_admin,is_super_admin,act_code,phone_no) VALUES (:first_name,:last_name,:user_email,:user_password,:is_active,:is_admin,:is_super_admin,:act_code,:phone_no) ");
        $arrVals = array('first_name'=>$params['firstname'],'last_name'=>$params['lastname'],'user_email'=>$params['email'],'user_password'=>$params['password'],'is_active'=>1,'is_admin'=>0,'is_super_admin'=>0,'act_code'=>0,'phone_no'=>$params['phoneno']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $presName = rand(1, 6);
        $lastId = $this->dbconn->lastInsertId();
        //die("yes:".$row);
        $imageFileType = pathinfo($files['profileimg']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")
        {
            $movedFile = move_uploaded_file($files['profileimg']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".PROFILE_PICS_FOLDER."/".$presName);
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."users SET profile_image = :profile_image WHERE user_id = :user_id");
                $arrVals = array('user_id'=>$lastId,'profile_image'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }
        }
        
        return TRUE;
    }
    
    function getAllAdminUsers()
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE is_active = :is_active AND is_admin = :is_admin AND is_super_admin = :is_super_admin AND constituency_id = :constituency_id ");
        $arrVals  = array('is_active'=>1,'is_admin'=>1,'is_super_admin'=>0,'constituency_id'=>$_SESSION['constituency_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_id']    = $row['user_id'];
            $result[$i]['user_email'] = $row['user_email'];
            $result[$i]['user_name']  = $row['user_name'];
            $result[$i]['user_id']    = $row['user_id'];
            $result[$i]['profile_image']    = $row['profile_image'];
            $i++;
        }
        return $result;
    }
    
    
    function getUserDetails($userid)
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE user_id = :user_id");
        $arrVals = array('user_id'=>$userid);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
       $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
           
        return $result;
    }
    
    function update($params,$files)
    {
        //die(print_r($files));
        $query = "UPDATE ".$this->tb_prefix."users SET first_name = :first_name,last_name = :last_name,user_email = :user_email,is_active = :is_active,is_admin = :is_admin,is_super_admin = :is_super_admin,act_code = :act_code ";
        
        $arrVals = array('user_id'=>$_SESSION['user_id'],'first_name'=>$params['firstname'],'last_name'=>$params['lastname'],'user_email'=>$params['email'],'is_active'=>1,'is_admin'=>0,'is_super_admin'=>0,'act_code'=>0);
        
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
        //die("yes:".$row);
        $imageFileType = pathinfo($files['profileimg']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")
        {
            //die($_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".PROFILE_PICS_FOLDER."/".$presName);
            $movedFile = move_uploaded_file($files['profileimg']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".PROFILE_PICS_FOLDER."/".$presName);
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."users SET profile_image = :profile_image WHERE user_id = :user_id");
                $arrVals = array('user_id'=>$_SESSION['user_id'],'profile_image'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }
        }
        
        return TRUE;
    }
   
    function getUserNotification()
    {
     $qrystmt = $this->dbconn->prepare("SELECT noti_poll,noti_survey,noti_town_hall,noti_post FROM ".$this->tb_prefix."users WHERE user_id = :user_id");   
     $arrVals = array('user_id'=>$_SESSION['user_id']);
     $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
     $result = array();
     $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
     
     return $result;
     
    }
    
    function searchUsers($name)
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE is_active = :is_active AND is_admin = :is_admin AND is_super_admin = :is_super_admin AND first_name LIKE '".$name."%' ");
        
        //die(print_r($qrystmt));
        $arrVals  = array('is_active'=>1,'is_admin'=>0,'is_super_admin'=>0);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_id']    = $row['user_id'];
            $result[$i]['first_name'] = $row['first_name'];
            $result[$i]['last_name']  = $row['last_name'];
            $result[$i]['user_email'] = $row['user_email'];
            $result[$i]['user_name']  = $row['user_name'];
            $result[$i]['user_id']    = $row['user_id'];
            $result[$i]['profile_image']    = $row['profile_image'];
            $i++;
        }
        return $result;
    }
    
    
}

?>