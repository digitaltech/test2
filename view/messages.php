<?php
require_once '../config/config.php';
require_once '../config/classload.php';
$Users = new Users();
$Friend = new Friend();

$friends = $Friend->getFriendList($_SESSION['user_id']);
//die(print_r($friends));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>
    
    <script src="js/chat.js" ></script>

</head>

<body class="bdCls" >

   <?php // require_once 'includes/navbar.php'; ?>

<?php require_once 'includes/navbar.php'; ?>
    <?php require_once 'includes/leftsidebar.php'; ?>

    <div style="float:left;min-height: 80%;" class="col-md-8" >


    
    <div class="col-md-8"   >
        <div class="panel panel-info"  >
            <div class="panel-heading" >
                Messages:  <span id="idadminame"  ></span>
            </div>
            <div style="height:400px;" class="panel-body">
                <ul  class="media-list" id="idmsgsul" style="height:90%;overflow-y: auto;" >
                    
                </ul>
            </div>
            <div class="panel-footer" id="idsender" style="display: none;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Message" id="usermsgsnd" />
                                    <span class="input-group-btn">
                                        <input type="image" src="images/attachment.png" id="idattach" height="40px" class="btn" />
                                        <button class="btn btn-info" id="sendmsgbtn" type="button">SEND</button>
                                    </span>
                                </div>
            </div>
            
            <input type="hidden" value="" id="ajaxload" />
            <input type="hidden" value="" id="msgtoid" />
            <input type="hidden" value="" id="idloadgif" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary col " style="min-height: 443px;overflow-y: scroll;"  >
            <div class="panel-heading">
               Choose Friend to chat
            </div>
            <div class="panel-body"  >
                <ul class="media-list"  >
                    <?php foreach($friends as $admin) { ?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="<?php echo PROFILE_PICS_FOLDER.DIRECTORY_SEPARATOR.$admin['profile_image']; ?>" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5><a href="javascript:void(0)" class="chatadmin" title="Click To Chat" data-adminid="<?php echo $admin['user_id']; ?>" ><?php echo $admin['first_name']; ?></a> | User </h5>
                                                    
                                                  <!-- <small class="text-muted">Active From 3 hours</small> -->
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    
                    <?php } ?>
                </ul>
            </div>
            </div>
        
    </div>

  
    </div>
    <?php require_once 'includes/rightsidebar.php'; ?>
    
    
    <div id="idattachdiv"  style="display:none;" >
        <form id="idattachform" enctype="multipart/form-data" >
            <input type="file" name="filename"/>
            <input type="hidden" name="tousrid" id="idtousrid" />
            <input type="hidden" name="action" value="upfile" />
            <input type="submit" value="Upload" class="btn btn-success frmEleTp"  />
        </form>
    </div>

        
   

<div style="" class="col-md-12" >
    <?php require_once 'includes/footer.php'; ?>
</div>
   

</body>

<script>
      $(function(){
        clearOldChat();
        $('.chatadmin').on('click',function(){
            clearOldChat();
            $('#idsender').css('display','block');
            
        $("#msgtoid").val(($(this).data('adminid')));
        //$('#idadminame').html($(this).html());
        $('#idloadgif').val(1); //load the gif image only when the user user clicks on the admin name
        loadMessages();
        scrollULBottom();
        });
        $('#idattach').on('click',function(){
            
            $('#idattachdiv').dialog({ title:"Upload File",width:400 });
        });
        
        $('#idattachform').on('submit',function(event){
            event.preventDefault();
            $('#idtousrid').val($("#msgtoid").val());
            data = new FormData($('#idattachform')[0]); // FormData will convert the form with particular id into key, value pair in the same format as data for ajax call
            ajaxUploadFile(data);
        });
        
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
        
        $("#contitbtn").on('click',function(){
           
            {
                $.ajax({
                    url:"messagedetails_cntr",
                    method:"POST",
                    data:{action:"add",titlemsg:$('#idtitlemsg').val()},
                    success: function(response){
                        if (response == 1)
                        {
                            
                            $('#idchattitle').dialog('close');
                            $('#idadminame').html($('#idtitlemsg').val());
                            $('#idtitlemsg').val('');
                        }
                    },
                    fail: function(){}
                })
            }
        });
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
