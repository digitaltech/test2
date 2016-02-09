<?php
require_once '../config/classload.php';

$Poll = new Poll();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'vote' )
{
    $stat = $Poll->vote($_REQUEST);
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
    $stat = $Poll->delete($_REQUEST);
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
    $stat = $Poll->update($_REQUEST);
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
    $data = $Poll->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}
?>