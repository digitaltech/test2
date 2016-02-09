<?php

class PollResult
{
  
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function getAllByPollId($params)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."user_poll as user_poll INNER JOIN ".$this->tb_prefix."users as users ON user_poll.user_id = users.user_id  WHERE user_poll.poll_id = :poll_id");
        $arrVals = array('poll_id'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $result = array();
        $row    = array();
        while($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']  = $row['serial_no'];
            $result[$i]['user_name']  = $row['user_name'];
            $result[$i]['user_email'] = $row['user_email'];
            $result[$i]['vote']  = $row['vote'];
            $i++;
        }
        
        return $result;
    }
}

?>