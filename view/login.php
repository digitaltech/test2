<?php require_once '../config/classload.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body class="bdCls" >

   <?php // require_once 'includes/navbar.php'; ?>
            
    <!--<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" id="idsignupform" method="post" action="signin_cntr" >
                    <fieldset>
                        <legend class="text-center header">Login</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="fname" name="useremail" type="text" placeholder="User Login Email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-asterisk bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="idpassword" name="userpass" type="password" placeholder="Password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="action" value="add" />
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
-->

<div  class="col-md-12 mainNavBa" >
    
    <?php if(isset($_SESSION['suc_msg']) && $_SESSION['suc_msg'] != '' ) { ?>
           
    <div style="float:left;margin-top:20px;" ><strong style="color:green;" >Success!</strong> <span style="color:green;" > <?php echo $_SESSION['suc_msg']; ?> </span></div>
          
    <?php $_SESSION['suc_msg'] = ''; } ?>
    
    <div class="mainNavBaSub" >
        
        
        <form method="post" action="signin_cntr" >
        <input type="text" name="useremail" placeholder="Email" />
        <input type="password" name="userpass"  placeholder="Password" />
        <select><option value="0" >--SELECT COUNTRY--</option><option value="1" >United States</option><option value="2" >India</option></select>
        <input type="submit" class="btn-success" value="Login" />
        <input type="button" class="btn-success" value="Signup" onclick="window.location.href = 'signup'" />
        </form>
    </div>
</div>

<div  class="col-md-12 mainContDivAll" >
    <table class="mainTbDsh">
        <tr style="width:50%;"><td style="width:30%;"><a style="color:white;" href="#"><h3>Education</h3></a></td><td style="width:30%;"><a style="color:white;float: left;margin-left: 35%;" href="#"><h3>Health</h3></a></td><td style="width:30%;"><a style="color:white;float: right;" href="#"><h3>Plant A Tree</h3></a></td></tr>
        <tr><td style="width:30%;"><br><br><br><a style="color:white;" href="#"><h3>Fitness</h3></a></td><td style="width:30%;"><br><br><br><img style="height:200px;" src="images/logo.jpg" /></td><td style="width:30%;"><br><br><br><a style="color:white;float: right;" href="#"><h3>Save Water</h3></a></td></tr>
        <tr><td style="width:30%;"><br><br><br><a style="color:white;" href="#"><h3>Save Energy</h3></a></td><td style="width:30%;"><br><br><br><a style="color:white;float: left;margin-left: 25%;" href="#"><h3>Pollution</h3></a></td><td style="width:30%;"><br><br><br><a style="color:white;float: right;" href="#"><h3>Cleanliness</h3></a></td></tr>
    </table>
    
    
    <div style="margin-top:30px;float:right;">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-12 col-md-12">
        	<div class="panel panel-default">
        		
	    		</div>
    		</div>
    	</div>
    </div>
    
    
</div>
   


   
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
