function loadMessages()
{
    if ($('#ajaxload').val() == 1)
    {
        return false;
    }
    var messages = "";
    $.ajax({
        url:"message_cntr",
        method:"POST",
        data: {action:"getmessages",toid:$("#msgtoid").val()},
        beforeSend: function(){
            $('#ajaxload').val(1);
            var loadimg = "<img src='images/loading1.gif' width='100px' height='100px' />";
            if ($('#idloadgif').val() == 1)
            {
                $('#idmsgsul').empty().append(loadimg);
                $('#idloadgif').val(0);
            }
            
        },
        success:function(response){
           $('#ajaxload').val(0);
            response = JSON.parse(response);
            
            $.each(response, function(key,value){
                if (value.file_type == 0) // if file_type = 0, then that means it is a text message
                {
                    messages = messages+"<li class='media'><div class='media-body'><div class='media'><a class='pull-left' href='#'><img class='media-object img-circle ' height = '75px' width = '75px' src='"+proimgfold+"/"+value.profile_image+"' /></a><div class='media-body' >"+value.message+"  <br /> <small class='text-muted'>"+value.first_name+" "+value.last_name+" | "+value.date_time+"</small><hr /></div></div></div></li>";
                }
                else if (value.file_type == 1)
                {
                    messages = messages+"<li class='media'><div class='media-body'><div class='media'><a class='pull-left' href='#'><img class='media-object img-circle ' height = '75px' width = '75px' src='"+proimgfold+"/"+value.profile_image+"' /></a><div class='media-body' ><img width = '100px' height = '100px' src = '"+chatimgfold+"/"+value.file_name+"'  /><br /> <small class='text-muted'>"+value.first_name+" "+value.last_name+" | "+value.date_time+"</small><hr /></div></div></div></li>";
                }
            })
            
            $('#idmsgsul').empty().append(messages);
        },
        fail: function(response){
            
        }
    })
    
}

function sendMessage()
{
    $.ajax({
        url:"message_cntr",
        method:"POST",
        data: {action:"add",toid:$("#msgtoid").val(),message:$("#usermsgsnd").val()},
        success: function(response)
        {
            $("#usermsgsnd").val(''); //empty the textbox after the message is sent
        },
        fail: function(response)
        {
            
        }
    });
}

function scrollULBottom()
{
    $('#idmsgsul').animate({
        scrollTop: $(document).height()
    }, 'slow');
}

function clearOldChat()
{
    $.ajax({
        url:"messagedetails_cntr",
        method:"POST",
        data: {action:"clear"},
        success:function(response)
        {
            $('#idmsgsul').empty();
        },
        fail: function(response)
        {
            
        }
    })
}


function ajaxUploadFile(data)
{
    console.log(data);
    data.toid = $("#msgtoid").val();
    //alert('ajax upload file');
	//event.stopPropogation();
	//event.preventDefault();
	 
	 $.ajax({
		url: 'message_cntr',
		method: 'post',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success:function(response){
			
			$("#idattachdiv").dialog( 'close' );
		}
	});

}