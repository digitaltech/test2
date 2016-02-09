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
                
                if (value.from_user_id == msgfromid)
                {
                    var username = "You";
                }
                else
                {
                    var username = value.user_name;
                }
                
                messages = messages+"<li class='media'><div class='media-body'><div class='media'><a class='pull-left' href='#'><img class='media-object img-circle ' height = '75px' width = '75px' src='"+proimgfold+"/"+value.profile_image+"' /></a><div class='media-body' >"+value.message+"  <br /> <small class='text-muted'>"+username+" | "+value.date_time+"</small><hr /></div></div></div></li>";
                //scrollULBottom();
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
        data: {action:"add",toid:$("#msgtoid").val(),message:$("#usermsgsnd").val(),msgdetid:$('#msgdetid').val()},
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