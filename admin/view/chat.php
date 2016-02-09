<?php
require_once '../config/classload.php';
$Message = new Message();
//die(print_r($_REQUEST));
$msgLastID = $Message->lastMsgDetId($_REQUEST);
//die($msgLastID);
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
    <div class="container" style="float:left;margin: 0 0 0 30%;" >
<div class="row " >
    <h3 class="text-left" > &nbsp;&nbsp; Talking To:  </h3>
    
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading" id="idadminame" >
                RECENT CHAT HISTORY
            </div>
            <div class="panel-body">
                <ul class="media-list" id="idmsgsul" style="height:300px;overflow-y: auto;" >
                    
                            <img src='../images/loading1.gif' width='100px' height='100px' />      
                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Message" id="usermsgsnd" />
                                    <span class="input-group-btn">
                                        <input type="hidden" value="" id="ajaxload" />
                                        <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" id="msgtoid" />
                                        <input type="hidden" value="" id="idloadgif" />
                                        <input type="hidden" value="<?php echo $msgLastID; ?>" id="msgdetid" />
                                        <button class="btn btn-info" id="sendmsgbtn" type="button">SEND</button>
                                    </span>
                                </div>
            </div>
        </div>
    </div>
   
</div>
  </div>
</body>

<script>
    $(function(){
        
        $('.chatadmin').on('click',function(){    
        $("#msgtoid").val(($(this).data('adminid')));
        $('#idadminame').html($(this).html());
        $('#idloadgif').val(1); //load the gif image only when the user user clicks on the admin name
        loadMessages();
        })
        
        $("#usermsgsnd").on('keydown',function(event){
            if (event.keyCode == 13){
                sendMessage();
                $("#usermsgsnd").val('');
            }
            
        });
        
        $("#sendmsgbtn").on('click',function(){
            sendMessage();
            $("#usermsgsnd").val('');
        });
        scrollULBottom();
    })
    
     $('#idmsgsul').animate({
        scrollTop: $(document).height()
    }, 'slow');
    
       msgInterval = setInterval( function(){ 
           console.log('ooooo');
            if ($("#msgtoid").val() != '') //if the user is not selected
            {    
                loadMessages(); 
            }
        },1000 );
    
    
</script>
</html>
