<?php 
require_once '../config/config.php';

class Database
{
    function __construct() 
    {
        $this->db_name = DB_NAME;
        $this->db_user = DB_USER;
        $this->db_host = DB_HOST;
        $this->db_password = DB_PASS;
        try{
        $this->dbconn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
        if (!$this->dbconn)
        die("Connection to the database could not be established");
        }
        catch (PDOException $e){
            echo "Exception".$e;
        }
    }
    
    
}

//$db = new Database();

?>