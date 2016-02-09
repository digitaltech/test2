<?php require_once '../config/classload.php'; 
$photo = new Photo();
$activitie = new Activitie();
$allPosts = $photo->getAllPosts();
$allActivities = $activitie->getAll();
$allTrends = $activitie->getAllTrending();
$noofparts = count($allActivities)/3; //each row has 3 images
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>
    
<?php require_once 'includes/header.php'; ?>
    
    <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  
  /*Facebool post area css start*/
  
  .facebook-share-box {
    width: 100%;
}
.facebook-share-box .share {
    -webkit-transition: 0.1s ease-out height;
    -moz-transition: 0.1s ease-out height;
    -ms-transition: 0.1s ease-out height;
    -o-transition: 0.1s ease-out height;
    transition: 0.1s ease-out height;
    clear: both;
    background: white;
    border: 2px solid #dddddd;
    margin-bottom: 10px;
    position: relative;
}
 
.facebook-share-box .share .arrow {
    background: url(arrow.png) no-repeat #dddddd;
    position: absolute;
    width: 14px;
    height: 10px;
    left: 4px;
    display: inline;
    top: -10px;
    -webkit-transition: 0.3s ease-out all;
    -moz-transition: 0.3s ease-out all;
    -ms-transition: 0.3s ease-out all;
    -o-transition: 0.3s ease-out all;
    transition: 0.3s ease-out all;
}
 
.facebook-share-box .post-types li a {
    color: #085083;
    text-decoration: none;
}
 
.facebook-share-box .post-types li a.active {
    color: #404040;
}
 
.facebook-share-box .post-types {
    padding-left: 5px;
}
 
.facebook-share-box ul {
    list-style: none;
    margin-bottom: 9px;
}
 
.facebook-share-box .post-types li {
    display: inline;
    margin-right: 10px;
}
 
.message {
    border-radius: 0;
    border: none;
}
.panel {
    border-radius: 0;
    border: none;
    margin-bottom: 0;
}
 
.privacy-dropdown {
    width: 100px;
}

/*facebook post css ends here*/

/*Frind list design starts here*/
.list-content{
 min-height:300px;
}
.list-content .list-group .title{
  background:#5bc0de;
  border:2px solid #DDDDDD;
  font-weight:bold;
  color:#FFFFFF;
}
.list-group-item img {
    height:80px; 
    width:80px;
}

.jumbotron .btn {
    padding: 5px 5px !important;
    font-size: 12px !important;
}
.prj-name {
    color:#5bc0de;    
}
.break{
    width:100%;
    margin:20px;
}
.name {
    color:#5bc0de;    
}

/*Frind list design ends here*/
  </style>
<link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
</head>

<body class="bdCls2" >

   <?php // require_once 'includes/navbar.php'; ?>
            


<div style="height:10%;background-color: lightblue;"  class="col-md-12" >
    <div style="float:left;margin-top: 20px;margin-left:30%;" >
        
        <select> <option value="0" selected="true" >-- SELECT ACTIVITY --</option> <?php foreach ($allActivities as $activity) { ?>
            <option value="<?php echo $activity['serial_no']; ?>" ><?php echo $activity['title']; ?></option>
            <?php } ?>
        </select>
        <input type="button" class="btn-success" value="Search" />
    </div>
    
    <div style="float:left;margin-top: 20px;margin-left:5%;" >
        <span>Karma Points:</span><span> 20</span>
    </div>
    
    <div style="float:right;margin-top: 20px;margin-right:5%;" >
            <a href="#"> <img src="images/logout.png" width="25px" height="25px" /> </a>
        </div>
    
        <div style="float:right;margin-top: 20px;margin-right:1%;" >
            <a href="#"> <img src="images/notifications.png" width="25px" height="25px" /><span>(1)</span> </a>
        </div>
</div>
<?php require_once 'includes/leftsidebar.php'; ?>
<div style="height:85%;background-color: yellow;margin: 0;padding: 0;" class="col-md-8" >
    
    
    
    <div style="background-color: lightgrey;height: 120%;margin: 0;padding: 0;overflow-y: scroll;" class="col-md-12" >
        
        <?php $count = 0; 
        for($i=0;$i<=$noofparts;$i++) {
        ?>
        <div class="row text-center">
          <?php   for($j=0;$j<3;$j++) { if (isset($allActivities[$count]['title'])) { ?>
            <div class="col-md-4 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="<?php echo UPLOAD_PICS_FOLDER.'/'.$allActivities[$count]['file_name']; ?>" style="height:170px;" alt="">
                    <div class="caption">
                        <?php echo $allActivities[$count]['title']; ?>
                    </div>
                    <div class="caption">
                        Karma Points: 20
                    </div>
                </div>
            </div>
          <?php $count++; } } ?>
        </div>
        <?php } ?>
        
       
        <input type="button" class="btn btn-success" value="+ Create New Activity" id="newactid" />
	</div> 
    
    
    
    </div>
    <div style="background-color: lightgreen;height: 100%;margin: 0;padding-left: 10px;overflow-y: scroll;" class="col-md-2" >
        <div>
       
        
        <span>Trends</span>
       
        </div>
        
        <?php foreach ($allTrends as $trend) { ?>
        <div style="height:30%;background-color: red;margin-top:5px;padding:0;" class="col-md-12" >
            <img style="float:left;padding:0;width:100%;height:100%;" src="upimages/<?php echo $trend['file_name']; ?>" />
        </div>            
       <?php } ?>
        

       
        
        
    </div>
    
</div>
   <div id="idupphoto" style="display:none;" >
    <form id="loginform" action="activitie_cntr" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                    
        <div style="margin-bottom: 25px" class="input-group">
             <input id="login-username" type="text" class="form-control" name="title"  placeholder="Title">                                        
        </div>

        <div style="margin-bottom: 25px" class="input-group">
            <input id="login-username" type="file" class="form-control" name="upfile" />
        </div>


        <!--<div style="margin-bottom: 25px" class="input-group">
            <textarea id="login-username" type="text" class="form-control" name="content"  placeholder="First name">  </textarea>                                      
        </div>-->
        <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit"  class="btn btn-success"  value="Post" />

                </div>
            </div>
        <input type="hidden" name="action" value="add" />
                        
    </form>
</div>

<div style="" class="col-md-12" >
    <?php require_once 'includes/footer.php'; ?>
</div>
   

</body>

<script>
      $(function(){
          
           $('#newactid').on('click',function(){
              $('#idupphoto').dialog();
          });
          
          $('.status').click(function() { $('.arrow').css("left", 0);});
			$('.photos').click(function() { $('.arrow').css("left", 146);});
          
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
