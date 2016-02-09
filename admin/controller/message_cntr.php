<?php
require_once '../config/classload.php';

$Message = new Message();

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Message->add($_REQUEST);
    echo $stat;
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'getmessages' )
{
    $data = $Message->getUserMsgs($_REQUEST);
    
    echo json_encode($data);
}

?>