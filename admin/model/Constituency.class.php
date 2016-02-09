<?php

class Constituency
{
    function __construct() {
        $dbObj          = new Database();
        $this->tb_prefix = DB_PREFIX;
        $this->dbconn   = $dbObj->dbconn;
    }
    
    function add($params,$files)
    {
        $qrystmt = $this->dbconn->prepare("INSERT INTO ".$this->tb_prefix."trending ( title ) VALUES (:title) ");
        $arrVals = array('title'=>$params['title']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        //die(print_r($files));
        $presName = rand(1, 6);
        $lastId = $this->dbconn->lastInsertId();
        //die("yes:".$row);
        $imageFileType = pathinfo($files['filename']['name'], PATHINFO_EXTENSION);
        $presName = $presName.$lastId.".".$imageFileType;
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")
        {
            $movedFile = move_uploaded_file($files['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".UPLOAD_PICS_FOLDER."/".$presName);
           // die($_SERVER['DOCUMENT_ROOT']."/".ROOT_FOLDER."/".PROFILE_PICS_FOLDER."/".$presName);
            if ($movedFile)
            {
                $qrystmt  = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."trending SET file_name = :file_name WHERE serial_no = :serial_no");
                $arrVals = array('serial_no'=>$lastId,'file_name'=>$presName);
                $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
            }
        }
        
        return TRUE;
    }
    
    function delete($id)
    {
        $qrystmt = $this->dbconn->prepare("DELETE FROM ".$this->tb_prefix."trending WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function update($params)
    {
        $qrystmt = $this->dbconn->prepare("UPDATE  ".$this->tb_prefix."trending SET title = :title WHERE serial_no = :serial_no  ");
        $arrVals = array('title'=>$params['title'],'serial_no'=>$params['id']);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        return TRUE;
    }
    
    function getAll()
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."trending ");
        $arrVals = array();
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $i = 0;
        $result = array();
        $row    = array();
        while ($row = $qrystmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[$i]['serial_no']         = $row['serial_no'];
            $result[$i]['title'] = $row['title'];
            $result[$i]['file_name'] = $row['file_name'];
            $i++;
        }
        
        return $result;
    }
    
    function getById($id)
    {
        $qrystmt = $this->dbconn->prepare("SELECT * FROM  ".$this->tb_prefix."trending WHERE serial_no = :serial_no ");
        $arrVals = array('serial_no'=>$id);
        $qrystmt->execute($arrVals) or die(print_r($qrystmt->errorInfo(),TRUE));
        $result = array();
        $result = $qrystmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>