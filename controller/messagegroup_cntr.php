<?php
require_once '../config/classload.php';

$MessageGroup = new MessageGroup();

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $MessageGroup->add($_REQUEST);
    echo $stat;
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'getmessages' )
{
    $data = $MessageGroup->getUserMsgs($_REQUEST);
    
    echo json_encode($data);
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'creategroup' )
{
    $stat = $MessageGroup->createGroup($_REQUEST);
   
    if ($stat)
    {
        $_SESSION['suc_msg'] = "Created Chat Room Successfully";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        $_SESSION['err_msg'] = "Unable To Create Chat Room ";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'upfile' )
{
    $target_file = basename($_FILES["filename"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //die(print_r($imageFileType));
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) 
    {
        $stat = $MessageGroup->uploadFile($_REQUEST,$_FILES,$imageFileType);
    }
    else
    {
        $stat = FALSE;
    }
    
    
    echo $stat;
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'likemsg' )
{
    $stat = $MessageGroup->likeMsg($_REQUEST);
    echo $stat;
}

?>