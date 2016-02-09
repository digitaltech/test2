
<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body class="bdCls" >

            
   

<div style="height:10%;background-color: lightblue;"  class="col-md-12" >
    
</div>

<div style="height:85%;" class="col-md-12" >
   
    
    
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign Up</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" method="post" action="cabs_cntr" enctype='multipart/form-data' class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="orgname" value="" placeholder="Organisation Name">                                        
                            </div>
                                
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <textarea name="orgaddress" class="form-control"  placeholder="Address" ></textarea>                                
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="number" class="form-control" name="orgphoneno" value="" placeholder="Phone Number">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="email" class="form-control" name="emailid" value="" placeholder="Email Id">                                        
                            </div>
                            
                             <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="text" class="form-control" name="orgwebsite" value="" placeholder="Website">                                        
                            </div>
                      
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                 <h3>Cabs Authorized Person Only:</h3>                                        
                            </div>
                            
                            
                             <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="text" class="form-control" name="cabauthname" value="" placeholder="Name">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="text" class="form-control" name="cabauthsurname" value="" placeholder="Sur Name">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="email" class="form-control" name="cabauthemail" value="" placeholder="Email Id">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="login-username" type="number" class="form-control" name="cabauthphone" value="" placeholder="Phone Number">                                        
                            </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i >Scanned Document</i></span>
                                <input id="login-username" type="file" class="form-control" name="cabauthscandoc" />                                        
                            </div>
                            
                            
                            <div style="margin-bottom: 25px">
                                 <h3>Choose Level Of Accreditation:</h3>                                        
                            </div>
                            
                           <div style="margin-bottom: 25px" >
                                <span class="input-group-addon"></span>
                                <input  type="radio"  name="cabauthsacclevel" value="1" /> Initial Accreditation                 <br>                       
                                <input  type="radio" name="cabauthsacclevel" value="2" /> Extension                                  <br>      
                                <input  type="radio"  name="cabauthsacclevel" value="3" /> Renewal Of Accreditation                                         
                           </div>
                            
                            <div style="margin-bottom: 25px">
                                 <h3>Type Of Accreditation Cab Will Apply For:</h3>                                        
                            </div>
                            
                           <div style="margin-bottom: 25px" >
                                <span class="input-group-addon"></span>
                                <input  type="radio"  name="cabauthsacctype" value="1" /> Accreditation Of Testing Laboratories (PT--001-F01-1) <br>                 <br>                       
                                <input  type="radio" name="cabauthsacctype" value="2" /> Accreditation Of Calibration (PT--001-F01-2) <br>                                  <br>      
                                <input  type="radio"  name="cabauthsacctype" value="3" /> Accreditation Of Inspection Bodies (PT--001-F01-3)                                         
                           </div>
                            
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i >Payment Reciepiet</i></span>
                                <input id="login-username" type="file" class="form-control" name="cabpayreceipe" />                                        
                            </div>
                            
                            <input type="hidden" name="action" value="add" />  

                                
                           
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <input type="submit" class="btn btn-success" />
                                    </div>
                                </div>


                                
                            </form>     



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
