<?php
require_once '../config/classload.php';
if ( isset($_SESSION['user_id']))
{
    header('Location: dashboard');
}
else
{
    header('Location: login');
}

?>