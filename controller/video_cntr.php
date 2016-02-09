<?php
require_once '../config/classload.php';

$video = new Video();

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $video->add($_REQUEST,$_FILES);
    
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Added the post successfully";
        
        header('Location: users_admin-manage');
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to add the post";
        header('Location: users_admin-manage');
    }
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $video->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    
    $stat = $video->delet($_REQUEST['id']);
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Delete the user successfully";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to delete the user";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $video->update($_REQUEST,$_FILES);
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Updated the user successfully";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to update the user";
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}

?>