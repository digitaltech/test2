<?php
require_once '../config/classload.php';
$Announcment = new Announcment();
//die(print_r($_REQUEST));
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    
    $target_file = basename($_FILES["filename"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //die(print_r($imageFileType));
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) 
    {
        $stat = $Announcment->add($_REQUEST,$_FILES,$imageFileType);
    
        if ($stat)
        {
            $_SESSION['suc_msg'] = "Added the record successfully";
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            $_SESSION['err_msg'] = "Unable to add the record";
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
    }
    else
    {
        $stat = FALSE;
    }
    
    
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Announcment->delete($_REQUEST);
    
    if ($stat)
    {
        $_SESSION['suc_msg'] = "Delted the record successfully";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        $_SESSION['err_msg'] = "Unable to delete the record";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $Announcment->update($_REQUEST,$_FILES);
    
    if ($stat)
    {
        $_SESSION['suc_msg'] = "Updated the record successfully";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        $_SESSION['err_msg'] = "Unable to update the record";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $Announcment->getAll();
    
    $data = array('aaData'=>$data);
    echo json_encode($data);
    
}


?>