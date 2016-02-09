<?php
require_once '../config/classload.php';

$PollResult = new PollResult();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $PollResult->getAllByPollId($_REQUEST);
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>