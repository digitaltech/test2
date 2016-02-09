<?php 

require_once '../config/classload.php';
//die(print_r($_REQUEST));
$signin = new SignIn();

$signstat = $signin->sigin($_REQUEST['useremail'], $_REQUEST['userpass']);

if ($signstat)
{
    header('Location: dashboard');
}
else 
{
    $_SESSION['err_msg'] = 'Please re check email id or password';
    header('Location: home');

}
?>