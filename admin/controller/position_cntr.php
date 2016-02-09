<?php
require_once '../config/classload.php';
$Position = new Position();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Position->add($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Added the Position Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Add Position Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Position->delete($_REQUEST['id']);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Deleted the Position Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Delete Position Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $Position->update($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Updated the Position Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Update Position Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $Position->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>