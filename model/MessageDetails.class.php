<?php
require_once '../config/classload.php';
class MessageDetails
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."message_details (title_msg) values (:title_msg) ");
        $arrVals = array('title_msg'=>$params['titlemsg']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $_SESSION['chat_id'] = $this->dbconn->lastInsertId();
        return TRUE;
    }
    
    function clearSession()
    {
        $_SESSION['chat_id'] = 0;
        return TRUE;
    }
}

?>