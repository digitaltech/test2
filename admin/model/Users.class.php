<?php
require_once '../config/classload.php';

class Users
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        //die(print_r($params));
        $params['usrpass'] = sha1($params['usrpass']);
        $isdoc = 0;
       
        if ($params['type'] == 'admin')
        {
            $arrVals = array('user_id'=>'','user_email'=>$params['usremail'],'user_password'=>$params['usrpass'],'is_active'=>1,'is_admin'=>1,'is_super_admin'=>0,'act_code'=>0,'user_name'=>$params['usrnm']);
        }
        $qrystmt  = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."users (user_id,user_email,user_password,is_active,is_admin,is_super_admin,act_code,user_name) VALUES (:user_id,:user_email,:user_password,:is_active,:is_admin,:is_super_admin,:act_code,:user_name) ");
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        return TRUE;
    }
    
    function getAllUsers($params)
    {
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE is_active = :is_active AND is_admin = :is_admin AND is_super_admin = :is_super_admin  ");
        if ($params['type'] == "frontusers")
        {
            $arrVal = array('is_active'=>1,'is_admin'=>0,'is_super_admin'=>0);
        }
        else if ($params['type'] == "admins")
        {
            $arrVal = array('is_active'=>1,'is_admin'=>1,'is_super_admin'=>0);
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
    
    function deletAdminUser($userid)
    {
        $qrystmt  = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."users WHERE user_id = :user_id");
        $arrVals = array('user_id'=>$userid);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getUserDetails($userid)
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
        //die("yes:".$row);
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
    
    function getDoctorServs($id)
    {
        //die('Please this is a test here'.$id);
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."assigned_services WHERE doctor_id = :doctor_id");
        $arrVals = array('doctor_id'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result  = array();
        $row     = array();
        $i       = 0;
        while ( $row  = $qrystmt->fetch(PDO::FETCH_ASSOC) )
        {
            $result[$i]['serial_no']       = $row['serial_no'];
            $result[$i]['service_pack_id'] = $row['service_pack_id'];
            $result[$i]['doctor_id']       = $row['doctor_id'];
            $i++;
        }
        return $result;
    }
    
     function getDoctorServsIds($id)
    {
        //die('Please this is a test here'.$id);
        $qrystmt = $this->dbconn->prepare("SELECT service_pack_id FROM ".$this->tb_prefix."assigned_services WHERE doctor_id = :doctor_id");
        $arrVals = array('doctor_id'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result  = array();
        $row     = array();
        $i       = 0;
        while ( $row  = $qrystmt->fetch(PDO::FETCH_ASSOC) )
        {
            $result[$i] = $row['service_pack_id'];
            $i++;
        }
        return $result;
    }
    
    function  getAllchatUsers()
    {
        $qrystmt = $this->dbconn->prepare("SELECT DISTINCT from_user_id FROM ".$this->tb_prefix."message WHERE to_user_id = :to_user_id"); //get all the ids of the users that have chat with this sub admin
        $arrVals = array('to_user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        while( $row = $qrystmt->fetch(PDO::FETCH_ASSOC) )
        {
            $users[$i]['from_user_id'] = $row['from_user_id']; 
            $i++;
        }
        
        $j = 0;
        $result = array();
        foreach ($users as $user) // get the details of all the users who had chat with this sub admin user
        {
            $qrystmt = $this->dbconn->prepare("SELECT message.from_user_id,users.user_name, users.user_email FROM ".$this->tb_prefix."message as message INNER JOIN ".$this->tb_prefix."users as users ON message.from_user_id = users.user_id WHERE message.from_user_id = :from_user_id AND users.user_id = :user_id LIMIT 1 ");
            $arrVals = array('from_user_id'=>$user['from_user_id'],'user_id'=>$user['from_user_id']);
            //die(print_r($qrystmt).";;".  print_r($arrVals));
            $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            $row = $qrystmt->fetch(PDO::FETCH_ASSOC);
            $result[$j]['user_name']    = $row['user_name'];
            $result[$j]['user_email']   = $row['user_email'];
            $result[$j]['from_user_id'] = $row['from_user_id'];
            $j++;
        }
        
        return $result;
    }
}

?>