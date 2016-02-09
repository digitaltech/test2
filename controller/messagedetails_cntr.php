<?php
require_once '../config/classload.php';
$MessageDetails = new MessageDetails();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' )
{
    $stat = $MessageDetails->add($_REQUEST);
    echo $stat;
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'clear' )
{
    $stat = $MessageDetails->clearSession(); //this function is at present clearing the chat id when the page is loaded so that old chat does not show
    echo $stat;
}
?>