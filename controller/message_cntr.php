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

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'upfile' )
{
    $target_file = basename($_FILES["filename"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //die(print_r($imageFileType));
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) 
    {
        $stat = $Message->uploadFile($_REQUEST,$_FILES,$imageFileType);
    }
    else
    {
        $stat = FALSE;
    }
    
    
    echo $stat;
}

?>