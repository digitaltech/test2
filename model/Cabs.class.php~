<?php ini_set('display_errors','on');
require_once '../config/classload.php';

class Cabs
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params,$files)
    {
        $qrystmt  = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."registered ( org_name,org_address,org_phone_no,org_email,org_website,cab_name,cab_surname,cab_email,cab_phone_no,cab_scanned_doc,cab_level_of_accredation,cab_type_of_accredation,cab_payment_reciept ) VALUES (:org_name,:org_address,:org_phone_no,:org_email,:org_website,:cab_name,:cab_surname,:cab_email,:cab_phone_no,:cab_scanned_doc,:cab_level_of_accredation,:cab_type_of_accredation,:cab_payment_reciept) ");

 $arrVals = array('org_name'=>$params['orgname'],'org_address'=>$params['orgaddress'],'org_phone_no'=>$params['orgphoneno'],'org_email'=>$params['emailid'],'org_website'=>$params['orgwebsite'],'cab_name'=>$params['cabauthname'],'cab_surname'=>$params['cabauthsurname'],'cab_email'=>$params['cabauthemail'],'cab_phone_no'=>$params['cabauthphone'],'cab_scanned_doc'=>'','cab_level_of_accredation'=>$params['cabauthsacclevel'],'cab_type_of_accredation'=>$params['cabauthsacctype'],'cab_payment_reciept'=>'');
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $presName = rand(1, 1000);
        $lastId  = $this->dbconn->lastInsertId();
        $imageFileType = pathinfo($files['cabauthscandoc']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "pdf")
        {
            $movedFile = move_uploaded_file($files['cabauthscandoc']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".UPLOAD_PICS_FOLDER."/".$presName);
            //die(var_dump($movedFile));
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."registered SET cab_scanned_doc = :cab_scanned_doc WHERE serial_no = :serial_no");
                $arrVals = array('serial_no'=>$lastId,'cab_scanned_doc'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }

        }


	$presName = rand(1, 1000);
       // $lastId  = $this->dbconn->lastInsertId();
        $imageFileType = pathinfo($files['cabpayreceipe']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "pdf")
        {
            $movedFile = move_uploaded_file($files['cabpayreceipe']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".UPLOAD_PICS_FOLDER."/".$presName);
            
            if ($movedFile)
            {

                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."registered SET cab_payment_reciept = :cab_payment_reciept WHERE serial_no = :serial_no");
                $arrVals = array('serial_no'=>$lastId,'cab_payment_reciept'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
die(var_dump($lastId));
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
    
    function getAllPosts() // function to get all the posts of this user and all the posts of his friend
    {
        $friend = new Friend();
        $friendIds = $friend->getAllFriendIds($_SESSION['user_id']);
        array_push($friendIds, $_SESSION['user_id']);
        $friendIdsStr = implode(",", $friendIds);
        //die($friendIdsStr);
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."posts as posts LEFT JOIN ".$this->tb_prefix."users as users ON posts.user_id = users.user_id WHERE posts.user_id IN ($friendIdsStr) ORDER BY posts.date_time DESC ");
        
        $arrVal = array();
        
        $qrystmt->execute($arrVal) or die(print_r($qrystmt->errorInfo(),TRUE));
        $row      = array();
        $result   = array();
        $i = 0;
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_id']     = $row['user_id'];
            $result[$i]['user_email']  = $row['user_email'];
            $result[$i]['first_name']  = $row['first_name'];
            $result[$i]['last_name']   = $row['last_name']; 
            $result[$i]['title']   = $row['title']; 
            $result[$i]['content']   = $row['content']; 
            $result[$i]['profile_name']   = $row['profile_image']; 
            $result[$i]['file_name']   = $row['file_name']; 
            $i++;
        }
        return $result;
    }
    
    
}

?>
