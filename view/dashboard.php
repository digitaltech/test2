<?php require_once '../config/classload.php'; 
$photo = new Photo();
$activitie = new Activitie();
$users = new Users();
$Friend = new Friend();
$allPosts = $photo->getAllPosts();
$allActivities = $activitie->getAll();
$userDet = $users->getUserDetails($_SESSION['user_id']);
$allActivities = $activitie->getAll();
$noofparts = count($allActivities)/4; //each row has 4 images
//die(print_r($allActivities));
//die(print_r($allPosts));
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
.carousel-control {
  padding-top:10%;
  width:5%;
}
/*Frind list design ends here*/
  </style>
<link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
</head>

<body class="bdCls2" >

  

<?php require_once 'includes/navbar.php'; ?>

<div style="height:85%;background-color: yellow;margin: 0;padding: 0;" class="col-md-12" >
    
    <?php require_once 'includes/leftsidebar.php'; ?>
    
    <div style="background-color: lightgrey;height: 106%;margin: 0;padding: 0;overflow-y: scroll;" class="col-md-8" >
        <div class="container" style="margin:10px 0 0 30px;" >
    <div class="col-md-12">
         
<?php if (is_array($allActivities) && !empty($allActivities)) { ?>
        <div  style="width:770px;height: 200px;background-color: white;" >
            <div id="myCarousel" class="carousel slide">
                
                <!-- Carousel items -->
                <div class="carousel-inner">
                    
                   <?php $count = 0; 
                    for($i=0;$i<=$noofparts;$i++) {
                    ?>
                        <div class="item <?php if($i==0) { echo 'active'; } ?> ">
                                <div class="item">
                                <div class="row">
                                    <?php   for($j=0;$j<4;$j++) { ?> 
                                        <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="<?php echo UPLOAD_PICS_FOLDER.'/'.$allActivities[$count]['file_name']; ?>" style =" width:150px;height:150px;" alt="Image" class="img-responsive"></a>
                                    </div>
                                        <?php 

                                        $count++;
                                    } ?>


                                </div>
                                <!--/row-->
                            </div>
                                <!--/row-->
                        </div>    
                <?php } ?>
                   
                </div>
                <!--/carousel-inner--> <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
            </div>
            <!--/myCarousel-->
        </div>
        <?php } ?>
        <!--/well-->
    </div>
</div>
        
        
	
        <div style="height:200px;margin-left: 4%;" class="col-md-11">
		
		<form action="#" method="post" role="form" enctype="multipart/form-data" class="facebook-share-box">
			
			
                    <div class="arrow"></div>
                    <div class="panel panel-default whatsonmind">
                      
                      <div class="panel-body">
                        <div class="">
                            <textarea name="message" cols="40" rows="10" id="status_message" class="form-control message" style="height: 62px; overflow: hidden;" placeholder="What's on your mind ?"></textarea> 
						</div>
                      </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="btn-group" style="margin-left:5%;">
                                        <a id = "anchphotoup" href="javascript:void(0)"><img src="images/photo.png" width="25px" height="25px" /></a>
                                    </div>
                                    <div class="btn-group" style="margin-left:5%;">
                                        <a id = "anchvideoup" style="margin-left:20%;" href="javascript:void(0)"><img src="images/video.png" width="25px" height="25px" /></a>
                                    </div>
                                    <div class="btn-group" style="margin-left:5%;">
                                    <input type="submit" name="submit" value="Post" class="btn btn-primary">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <!--<select name="privacy" class="form-control privacy-dropdown pull-left input-sm">
                                        <option value="1" selected="selected">Public</option>
                                        <option value="2">Only my friends</option>
                                        <option value="3">Only me</option>
                                    </select>   -->                                 
                                   <!-- <input type="submit" name="submit" value="Post" class="btn btn-primary">    -->                           
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
		
		</form>
            
            </div>
	
	<div style="margin-left:7%;margin-top:170px;width:86%;" >
        <?php foreach ($allPosts as $post) { ?>
        
        <div style="width:100%;margin-top: 10px;background-color:white;" >
            
                
                    <div style="padding:10px;" >
                        <a href="#"><?php echo $post['first_name']." ".$post['last_name']; ?></a>
                    </div>
                    
                    
                    
                    <div style="padding:10px;">
                        <img src="<?php echo PROFILE_PICS_FOLDER."/".$post['profile_name']; ?>" width="50px" />
                    </div>

                     <div style="padding:10px;">
                        <a href="#"><?php echo $post['title']; ?></a>
                    </div>
            
                    <div style="padding:10px;">
                        <img src="<?php echo UPLOAD_PICS_FOLDER."/".$post['file_name']; ?>" width="300px" />
                    </div>

                    <div style="padding:10px;">
                        <?php echo $post['content']; ?>
                    </div>
                
            
        </div>
        
        <?php } ?>
        </div>
        
        
        
	</div> 
    
    <?php require_once 'includes/rightsidebar.php'; ?>
    
    </div>
    
    
</div>
   
<div id="idupvideo" style="display:none;"  >
    <form id="loginform" action="video_cntr" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                    
        <div style="margin-bottom: 25px;width:100%;" class="input-group">
             <input id="login-username" type="text" class="form-control" name="title"  placeholder="Title">                                        
        </div>

        <div style="margin-bottom: 25px" class="input-group">
            <input id="login-username" type="file" class="form-control" name="upfile" />
        </div>


        <div style="margin-bottom: 25px" class="input-group">
            <textarea style="width:127%;" id="login-username" type="text" class="form-control" name="content"  ></textarea>                                      
        </div>
        <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit"  class="btn btn-success"  value="Post" />

                </div>
            </div>
        <input type="hidden" name="action" value="add" />
                        
    </form>
</div>

<div id="idupphoto" style="display:none;" >
    <form id="loginform" action="photo_cntr" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                                    
        <div style="margin-bottom: 25px;width:100%;" class="input-group">
             <input id="login-username" type="text" class="form-control" name="title"  placeholder="Title">                                        
        </div>

        <div style="margin-bottom: 25px" class="input-group">
            <input id="login-username" type="file" class="form-control" name="upfile" />
        </div>


        <div style="margin-bottom: 25px" class="input-group">
            <textarea id="login-username" style="width:127%;" type="text" class="form-control" name="content"  placeholder="First name">  </textarea>                                      
        </div>
        <div style="margin-top:10px" class="form-group">
                <!-- Button -->

                <div class="col-sm-12 controls">
                    <input type="submit"  class="btn btn-success"  value="Post" />

                </div>
            </div>
        <input type="hidden" name="action" value="add" />
                        
    </form>
</div>

   

</body>

<script>
      $(function(){
          
          $('#anchvideoup').on('click',function(){
              $('#idupvideo').dialog({title:"Upload A Video"});
          });
          
          $('#anchphotoup').on('click',function(){
              $('#idupphoto').dialog({title:"Upload A Picture"});
          });
          
          $('#idsearchuser').on('click',function(){
              window.location.href = "search-user-"+$('#idusername').val();
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
          
          $(document).ready(function() {
	$('#myCarousel').carousel({
	interval: 10000
	})
    
    $('#myCarousel').on('slid.bs.carousel', function() {
    	//alert("slid");
	});
    
    
});


  </script>

</html>
