<?php
require_once '../config/classload.php';
$Constituency = new Constituency();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Constituency->add($_REQUEST,$_FILES);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Added the record successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable to add the record successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' )
{
    $stat = $Constituency->delete($_REQUEST['id']);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Deleted the Record Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Delete Record Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' )
{
    $stat = $Constituency->update($_REQUEST);
    if ($stat)
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['suc_msg'] = "Updated the Record Successfully";
    }
    else
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        $_SESSION['err_msg'] = "Unable To Update Record Successfully";
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $Constituency->getAll();
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>