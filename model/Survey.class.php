<?php
require_once '../config/classload.php';
class Survey
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    
   
    function getById($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."survey WHERE serial_no = :serial_no");
        $arrVals = array('serial_no'=>$id);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $result  = $qrstmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function getAllByConstId($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT * FROM ".$this->tb_prefix."survey WHERE constituency_id = :constituency_id");
        $arrVals = array('constituency_id'=>$id);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        $row  = array();
        $i = 0;
        while ($row = $qrstmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no'] = $row['serial_no'];
            $result[$i]['topic'] = $row['topic'];
            $i++;
        }
        
        return $result;
    }
    
    function vote($params)
    {
        //die(print_r($params));
        $qrstmt = $this->dbconn->prepare(" INSERT INTO ".$this->tb_prefix."user_survey ( survey_id,user_id,vote ) VALUES ( :survey_id,:user_id,:vote ) ");
        $arrVals = array('survey_id'=>$params['id'],'user_id'=>$_SESSION['user_id'],'vote'=>$params['option']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getUsrVtBySurveyId($id)
    {
        $qrstmt = $this->dbconn->prepare("SELECT survey_id FROM ".$this->tb_prefix."user_survey WHERE survey_id = :survey_id AND user_id = :user_id");
        $arrVals = array('survey_id'=>$id,'user_id'=>$_SESSION['user_id']);
        $qrstmt->execute($arrVals) or die(print_r($qrstmt->errorInfo(),TRUE));
        $result = array();
        if ($qrstmt->rowCount() >= 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function updateNotiStat()
    {
        $qrystmt = $this->dbconn->prepare("UPDATE ".$this->tb_prefix."users SET noti_survey = :noti_survey WHERE user_id = :user_id");
        $arrVals = array('noti_survey'=>0,'user_id'=>$_SESSION['user_id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
}

?>