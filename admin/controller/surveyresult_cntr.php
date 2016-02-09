<?php
require_once '../config/classload.php';

$SurveyResult = new SurveyResult();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getall' )
{
    $data = $SurveyResult->getAllBySurveyId($_REQUEST);
    $data = array('aaData'=>$data);
    echo json_encode($data);
}

?>