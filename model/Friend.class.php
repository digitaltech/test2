<?php

class Friend
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        //die(print_r($_SESSION));
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."friend_list WHERE user_id = (SELECT user_id FROM ".$this->tb_prefix."users WHERE user_id = :user_id AND friend_id = :friend_id)");
        $arrVals = array('user_id'=>$_SESSION['user_id'],'friend_id'=>$params['friendid']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));


        if ($qrystmt->rowCount()>=1)
        {
                return "User already exists in your friend list";
        }			
		
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."friend_list (user_id,friend_id,is_blocked) VALUES (:user_id,:friend_id,:is_blocked) ");
        $arrVals = array('user_id'=>$_SESSION['user_id'],'friend_id'=>$params['friendid'],'is_blocked'=>0);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."friend_list (user_id,friend_id,is_blocked) VALUES (:user_id,:friend_id,:is_blocked) ");
        $arrVals = array('user_id'=>$params['friendid'],'friend_id'=>$_SESSION['user_id'],'is_blocked'=>0);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return "Added the user to your friend list";
    }
    
    function getFriendList($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."friend_list as friend_list INNER JOIN ".$this->tb_prefix."users as users ON users.user_id = friend_list.friend_id WHERE friend_list.user_id = :user_id ORDER BY friend_list.last_message_date_time DESC");
        $arrVals = array('user_id'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        $result = array();
        
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_email']      = $row['user_email'];
            $result[$i]['user_name']       = $row['user_name'];
            $result[$i]['first_name']      = $row['first_name'];
            $result[$i]['last_name']       = $row['last_name'];
            $result[$i]['user_id']         = $row['user_id'];
            $result[$i]['is_blocked']      = $row['is_blocked'];
            $result[$i]['profile_image']      = $row['profile_image'];
            $result[$i]['has_new_message'] = $row['has_new_message'];
            $result[$i]['last_message_date_time'] = $row['last_message_date_time'];
            $i++;
        }
        
        return $result;
    }
    
     function getFriendListLatest($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."friend_list as friend_list INNER JOIN ".$this->tb_prefix."users as users ON users.user_id = friend_list.friend_id WHERE friend_list.user_id = :user_id ORDER BY friend_list.added_date_time DESC");
        $arrVals = array('user_id'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        $result = array();
        
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['user_email']      = $row['user_email'];
            $result[$i]['user_name']       = $row['user_name'];
            $result[$i]['first_name']      = $row['first_name'];
            $result[$i]['last_name']       = $row['last_name'];
            $result[$i]['user_id']         = $row['user_id'];
            $result[$i]['is_blocked']      = $row['is_blocked'];
            $result[$i]['profile_image']      = $row['profile_image'];
            $result[$i]['has_new_message'] = $row['has_new_message'];
            $result[$i]['last_message_date_time'] = $row['last_message_date_time'];
            $i++;
        }
        
        return $result;
    }
    
    function getAllFriendIds($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."friend_list as friend_list INNER JOIN ".$this->tb_prefix."users as users ON users.user_id = friend_list.friend_id WHERE friend_list.user_id = :user_id ORDER BY friend_list.last_message_date_time DESC");
        $arrVals = array('user_id'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $row = array();
        $result = array();
        
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i] = $row['user_id'];
            $i++;
        }
        
        return $result;
    }
	
	function changeReadStatus($params)
	{
		$qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."friend_list SET has_new_message = :has_new_message WHERE user_id = :user_id AND friend_id = :friend_id");
		
		$arrVals = array('has_new_message'=>0,'user_id'=>$params['fromid'],'friend_id'=>$params['toid']);
		$qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
		
		return "TRUE";
	}
	
	
	function blockFriend($params)
	{
		$qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."friend_list SET is_blocked = :is_blocked WHERE user_id = :user_id AND friend_id = (SELECT user_id FROM ".$this->tb_prefix."users WHERE user_no = :user_no) ");
		
		$arrVals = array('is_blocked'=>1,'user_id'=>$params['fromid'],'user_no'=>$params['blockinguserno']);
		$qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
		
		return "TRUE";
	}
	
	function unBlockFriend($params)
	{
		$qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."friend_list SET is_blocked = :is_blocked WHERE user_id = :user_id AND friend_id = (SELECT user_id FROM ".$this->tb_prefix."users WHERE user_no = :user_no) ");
		
		$arrVals = array('is_blocked'=>0,'user_id'=>$params['fromid'],'user_no'=>$params['blockinguserno']);
		$qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
		
		return "TRUE";
	}
    
}

?>