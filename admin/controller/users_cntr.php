<?php
require_once '../config/classload.php';
//die(print_r($_REQUEST));
$users = new Users();

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $users->add($_REQUEST);
    
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Added the user successfully";
        
        header('Location: users_admin-manage');
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to add the user";
        header('Location: users_admin-manage');
    }
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $users->getAllUsers($_REQUEST);
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    
    $stat = $users->deletAdminUser($_REQUEST['id']);
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
    $stat = $users->update($_REQUEST,$_FILES);
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

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'allchatusers' )
{
    $data = $users->getAllchatUsers();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>