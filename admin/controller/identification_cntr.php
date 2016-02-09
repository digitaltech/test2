<?php
require_once '../config/classload.php';
$Identifcation = new Identification();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Identifcation->add($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Added the Identifcation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Add Identifcation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Identifcation->delete($_REQUEST['id']);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Deleted the Identifcation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Delete Identifcation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $Identifcation->update($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Updated the Identifcation Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Update Identifcation Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $Identifcation->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>