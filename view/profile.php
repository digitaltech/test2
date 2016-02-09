<?php require_once '../config/classload.php'; ?>
<?php $Users = new Users();
//die(print_r($_SESSION));
$userdet = $Users->getUserDetails($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body class="bdCls" >

   <?php // require_once 'includes/navbar.php'; ?>
            
    

<div style="height:10%;background-color: lightblue;"  class="col-md-12" >
    <div style="float:right;margin-top: 20px;margin-right:5%;" >
            <a href="#"> <img src="images/logout.png" width="25px" height="25px" /> </a>
        </div>
    
        <div style="float:right;margin-top: 20px;margin-right:1%;" >
            <a href="#"> <img src="images/notifications.png" width="25px" height="25px" /><span>(1)</span> </a>
        </div>
    
</div>
    
    <?php require_once 'includes/leftsidebar.php'; ?>
    <div class="col-md-8">
        <div id="loginbox" style="margin-top:10px;margin-left: 18%;" class="col-md-8">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Edit Profile</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" action="users_cntr" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="email" value="<?php echo $userdet['user_email']; ?>" placeholder="Email">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <img src="<?php echo PROFILE_PICS_FOLDER.'/'.$userdet['profile_image']; ?>" width="150px" height="150px" /><br><br>
                                <input id="login-username" type="file" class="form-control" name="profileimg" />
                            </div>
                                
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="firstname" value="<?php echo $userdet['first_name']; ?>" placeholder="First name">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="lastname" value="<?php echo $userdet['last_name']; ?>" placeholder="Last name">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="phoneno" value="<?php echo $userdet['phone_no']; ?>" placeholder="Last name">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                      
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <input type="submit"  class="btn btn-success"  value="update" />
                                    
                                    </div>
                                </div>
                            
                            <input type="hidden" name="action" value="update" />
   
                        </form>     

                        </div>                     
                    </div>  
        </div>
    </div>
        
<?php require_once 'includes/rightsidebar.php'; ?>   

<div style="" class="col-md-12" >
    <?php require_once 'includes/footer.php'; ?>
</div>
   

</body>

<script>
      $(function(){
          $('#idsignupform').validate({
                rules:{
                    useremail:  {required:true},
                    userpass:  {required:true,minlength:8},
                     },
                messages:
                        {
                           
                        }
            });
         $.validator.addMethod("emailsval", function(value, element) {
         return this.optional(element) || /^([a-z0-9_.+-])+\@(([a-z0-9-]+[a-z0-9])+\.)+([a-z0-9]{2,4})+$/.test(value);
        }, "Enter a Valid Email Id"); 

        $.validator.addMethod("namesval", function(value, element) {
         return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
        }, "Enter A Valid Name With Aplhabets"); 
        
        $.validator.addMethod("phoneval", function(value, element) {
         return this.optional(element) || /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/.test(value);
        }, "Enter A Valid Phone Number"); 
            
      })
	  
	  function itemname()
	  {
		 var itemname= $( "#emochar option:selected" ).text();
		  $("#item_name").val(itemname);
		 
	  }
  </script>

</html>
