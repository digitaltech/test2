<?php
require_once '../config/classload.php';

$Friend = new Friend();
//die(print_r($_REQUEST));
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $Friend->add($_REQUEST);
    
    echo $stat;
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getfriendlist' )
{
    $data = $Friend->getFriendList($_REQUEST);
    
    echo json_encode($data);
    
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'readmsgstatus' )
{
    $stat = $Friend->changeReadStatus($_REQUEST);
    
    echo $stat;
    
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'blockuser' )
{
    $stat = $Friend->blockFriend($_REQUEST);
    
    echo $stat;
    
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'unblockuser' )
{
    $stat = $Friend->unBlockFriend($_REQUEST);
    
    echo $stat;
    
}

?>