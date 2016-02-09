<?php
require_once '../config/config.php';
require_once '../config/classload.php';
$MessageGroup = new MessageGroup();
$chatGroups = $MessageGroup->getAll();
?>
<html lang="en">

<head>

    <title><?php echo PROJECT_NAME; ?></title>
    
<?php require_once 'includes/header.php'; ?>
     <script src="js/groupchat.js"></script>

</head>

<body>

   <?php require_once 'includes/navbar.php'; ?>
  <div class="container">
<div class="row " >
    <h3 class="text-left" > &nbsp;&nbsp;   </h3>
    
    <div class="col-md-8"  >
        <div class="panel panel-info"  >
            <div class="panel-heading" >
                TOPIC:  <span id="idadminame"  ></span><br>
				GROUP NAME:  <span id="idgroupname"  ></span>
            </div>
            <div class="panel-body">
                <ul class="media-list" id="idmsgsul" style="height:35%;overflow-y: auto;" >
                    
                </ul>
            </div>
            <div class="panel-footer" id="idsender" >
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Message" id="usermsgsnd" />
                                    <span class="input-group-btn">
                                        <input type="image" src="images/attachment.png" id="idattach" height="40px" class="btn" />
                                        <button class="btn btn-info" id="sendmsgbtn" type="button">SEND</button>
                                    </span>
                                </div>
            </div>
            
            <input type="hidden" value="" id="ajaxload" />
            
            <input type="hidden" value="" id="idloadgif" />
            <input type="hidden" value="" id="roomid" />
        </div>
    </div>
    <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
                <input type="button" class="btn btn-success" id="idcrtgrp" value="Create Group" />
               Your Active Conversation Rooms
            </div>
            <div class="panel-body"  >
                <ul class="media-list"  >
                     
                    <?php foreach($chatGroups as $chatGroup) { ?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <!--<a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="<?php echo PROFILE_PICS_FOLDER.DIRECTORY_SEPARATOR.$admin['profile_image']; ?>" />
                                                </a>-->
                                                <div class="media-body" >
                                                    <h5><a href="javascript:void(0)" class="chatadmin" title="Click To Chat" data-roomid="<?php echo $chatGroup['serial_no']; ?>" ><?php echo $chatGroup['chat_room_name']; ?></a>  </h5>
                                                    
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
  </div>
    <div id="idcrtChat" style="display:none;" >
       
    
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" id="idsignupform" method="post" action="messagegroup_cntr" >
                    <fieldset>
                        

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-8">
                                <input id="fname" name="name" type="text" placeholder="Chat Room Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-8">
                                <input id="idpassword" name="topic" type="text" placeholder="Chat Topic" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="action" value="creategroup" />
                                <button type="submit" class="btn btn-primary btn-lg">Create</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    

    </div>
    
    <div id="idattachdiv"  style="display:none;" >
        <form id="idattachform" enctype="multipart/form-data" >
            <input type="file" name="filename"/>
            <input type="hidden" name="toroomid" id="idtoroomid" />
            <input type="hidden" name="action" value="upfile" />
            <input type="submit" value="Upload" class="btn btn-success frmEleTp"  />
        </form>
    </div>
</body>

<script>
    $(function(){
        clearOldChat();
        $('#idcrtgrp').on('click',function(){
         $('#idcrtChat').dialog( { title:"Create Conversation Room",width:400 });   
        });
         
        $('.chatadmin').on('click',function(){
            clearOldChat();
           
        $("#roomid").val(($(this).data('roomid')));
        
        //$('#idadminame').html($(this).html());
        $('#idloadgif').val(1); //load the gif image only when the user user clicks on the admin name
        loadMessages();
        scrollULBottom();
        });
        
         $('#idattach').on('click',function(){
            
            $('#idattachdiv').dialog({ title:"Upload File",width:400 });
            $('#idtoroomid').val($("#roomid").val());
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
            if ($('#idtitlemsg').val() == '')
            {
                alert('Please Enter A Title');
            }
            {
                $.ajax({
                    url:"messagedetails_cntr",
                    method:"POST",
                    data:{action:"add",titlemsg:$('#idtitlemsg').val()},
                    success: function(response){
                        if (response == 1)
                        {
                            $('#idsender').css('display','block');
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
            if ($("#roomid").val() != '') //if the user is not selected
            {    
                loadMessages(); 
            }
        },1000 );
    
    
</script>
</html>
