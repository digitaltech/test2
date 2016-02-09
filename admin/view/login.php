<?php
require_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo PROJECT_TITLE; ?></title>
    <?php require_once 'includes/header.php'; ?>

</head>

<body>

<div   >
    	  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 signMnDiv ">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form method = "post" action = "signin_cntr" >
					<input type="text" class = "form-control"  name="useremail" placeholder="Username"> <br><br>
					<input type="password" class = "form-control" name="userpass" placeholder="Password"><br><br>
					<input type="submit" name="login" class = "btn btn-primary" value="Login">
				  </form>
					
				  <div class="login-help"><br><br>
					<!--<a href="#"  >Register</a> - <a href="#">Forgot Password</a> -->
				  </div>
				</div>
			</div>
		  </div>
		  
</body>