<?php require_once '../config/classload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php 
$users = new Users();
$allUsers = $users->searchUsers($_REQUEST['id']);
$friends = new Friend();
$allFriends = $friends->getFriendList($_SESSION['user_id']);

?>
<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body class="bdCls" >

   <?php // require_once 'includes/navbar.php'; ?>
            
   

<?php require_once 'includes/navbar.php'; ?>

    <?php require_once 'includes/leftsidebar.php'; ?>
    
<div style="height:100%;" class="col-md-8" >
   
    
   

  


  <div class="col-md-12" style="height:545px;background-color: white;padding:20px;border-radius: 4px;overflow-y: scroll;" >
    <ul class="list-group">
      <li href="#" class="list-group-item title">
        Your Search Result
      </li>
      
      <?php foreach($allUsers as $user) { ?>
      
      <li href="#" class="list-group-item text-left">
          <img class="img-thumbnail" width="100px" height="100px" src="<?php echo PROFILE_PICS_FOLDER.'/'.$user['profile_image']; ?>">
        <label class="name">
            <?php echo $user['first_name']." ".$user['last_name']; ?><br>
        </label>
        <label class="pull-right">
            <a  class="btn btn-success btn-xs glyphicon <?php if (in_array($user['user_id'],$allFriends)) { echo 'glyphicon-ok'; } else { echo 'glyphicon-plus';  } ?>  addnewfrnd" data-userid="<?php echo $user['user_id']; ?>" href="#" title="Add Friend"></a>
            <a  class="btn btn-danger  btn-xs glyphicon glyphicon-trash " href="#"  data-userid="<?php echo $user['user_id']; ?>" title="Delete"></a>
            <a  class="btn btn-info  btn-xs glyphicon glyphicon glyphicon-comment" data-userid="<?php echo $user['user_id']; ?>" href="#" title="Send message"></a>
        </label>
        <div class="break"></div>
      </li>
      
      <?php } ?>
      
      
    </ul>
  </div>
 
</div>
    
<?php require_once 'includes/rightsidebar.php'; ?>
        
   

<div style="" class="col-md-12" >
    <?php require_once 'includes/footer.php'; ?>
</div>
   

</body>

<script>
      $(function(){
          
          $('.addnewfrnd').on('click',function(){
              //alert('yes this ');
              $.ajax({
                  url:"friend_cntr",
                  method:"post",
                  data: {friendid:$(this).data('userid'),action:'add'},
                  success: function(response)
                  {
                   alert(response);   
                  },
                  fail: function(response)
                  {
                      
                  }
              });
          });
          
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
