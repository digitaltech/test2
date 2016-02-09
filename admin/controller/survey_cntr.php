<?php
require_once '../config/classload.php';

$Survey = new Survey();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Survey->add($_REQUEST);
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

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Survey->delete($_REQUEST);
    if ($stat)
    {
        $_SESSION['suc_msg'] = "Deleted the record successfully";
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
    $stat = $Survey->update($_REQUEST);
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
    $data = $Survey->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}
?>