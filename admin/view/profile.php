<?php
require_once '../config/classload.php';
$Users = new Users();
$userdet = $Users->getUserDetails($_SESSION['user_id']);
//die(print_r($userdet));
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { ?>
    <title><?php echo 'Super Admin Dashboard'; ?></title>
<?php  } else if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 0 ) { ?>
    <title><?php echo 'Admin Dashboard'; ?></title>
<?php }  ?>
<?php require_once 'includes/header.php'; ?>

</head>

<body>

    <div id="wrapper" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         
            <?php require_once 'includes/navbar.php'; ?>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                
                <?php require_once 'includes/sidebar.php'; ?>
                
            </div>
            <!-- /.navbar-collapse -->
        </nav>

     

    </div>
            
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <form class="form-horizontal" id="idsignupform" method="post" action="users_cntr" enctype="multipart/form-data" >
                    <fieldset>
                        <legend class="text-center header">Update Profile</legend>

                        
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="idusremail" name="usremail" value="<?php echo $userdet['user_email']; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="idusrnm" name="usrnm" value="<?php echo $userdet['user_name']; ?>" />
                            </div>
                        </div>
                        
                       
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <span>Profile Image:</span><input id="idusername" name="profileimg" type="file" > <img width="75px" height="75px" src="<?php echo '../'.PROFILE_PICS_FOLDER.DIRECTORY_SEPARATOR.$userdet['profile_image']; ?>" />
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-asterisk bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="idpassword" name="password" type="password" placeholder="Password" class="form-control">
                            </div>
                        </div>
                        
                        
                        

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="action" value="update" />
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

         
   


   

</body>

<script>
      $(function(){
          $('#idsignupform').validate({
                rules:{
                    constituency:  {required:true},
                    firstname:  {required:true,namesval:true},
                    lastname:  {required:true,namesval:true},
                    username:  {required:true},
                    gender:  {required:true},
                    occupation:  {required:true},
                    identification:  {required:true},
                    identificationno: {required:true},
                    phone: {required:true,phoneval:true},
                    email: {required:true,emailsval:true}
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
