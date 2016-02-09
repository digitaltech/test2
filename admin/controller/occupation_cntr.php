<?php
require_once '../config/classload.php';
$Occupation = new Occupation();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Occupation->add($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Added the Occupation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Add Occupation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Occupation->delete($_REQUEST['id']);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Deleted the Occupation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Delete Occupation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $Occupation->update($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Updated the Occupation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Update Occupation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $Occupation->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>