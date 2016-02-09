<?php
require_once '../config/classload.php';

class SignIn
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    function sigin($usremail,$usrpass)
    {
        $encpPass = sha1($usrpass);
        $qrystmt  = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."users WHERE user_email = :user_email AND user_password = :password AND is_active = :is_active AND is_admin = :is_admin ");
        $arrVals  = array('user_email'=>$usremail,'password'=>$encpPass,'is_active'=>1,'is_admin'=>0);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),true));
        $row      = $qrystmt->fetch(PDO::FETCH_ASSOC);
        if ( $qrystmt->rowCount() >= 1 )
        {
            $_SESSION['user_id']        = $row['user_id'];
            $_SESSION['is_admin']       = $row['is_admin'];
            $_SESSION['is_super_admin'] = $row['is_super_admin'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['constituency_id'] = $row['constituency_id'];
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

?>