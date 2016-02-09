<?php
require_once '../config/classload.php';
//die(print_r($_REQUEST));
$users = new Users();

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $users->add($_REQUEST,$_FILES);
    
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Sign Up Successfull.";
        header('Location: home');
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to add the user";
        header('Location: home');
    }
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'getallusers' )
{
    $data = $users->getAllAdminUsers();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'deleteuser' )
{
    $stat = $users->deletAdminUser($_REQUEST['userid']);
    if ($stat == TRUE)
    {
        $_SESSION['suc_msg'] = "Delete the user successfully";
        header('Location: ../manage-admins/');
    }
    else
    {
        $_SESSION['suc_msg'] = "Unable to delete the user";
        header('Location: ../manage-admins/');
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

?>