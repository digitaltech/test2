
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

<div style="height:10%;background-color: red;"  class="col-md-12" >
    <div style="float:left;margin-top: 20px;margin-left:30%;" >
        <input type="text" name="useremail" />
        
        <input type="button" class="btn-success" value="Search" />
    </div>
    
    <div style="float:left;margin-top: 20px;margin-left:5%;" >
        <span>Karma Points:</span><span> 20</span>
    </div>
</div>

<div style="height:85%;background-color: yellow;margin: 0;padding: 0;" class="col-md-12" >
    
    <div style="background-color: lightblue;height: 100%;margin: 0;padding: 0;" class="col-md-2" >
        <img style="width: 100%;height:200px;" src="images/logo.jpg" />
        <div>
            <h5>Sourabh</h5>
            <a href="#">Edit Profile</a>
        </div>
        <div class="list-group">
        <a href="#" class="list-group-item active">
            Favorites 
        </a>
        <a href="#" class="list-group-item">
            Messages 
        </a>
        <a href="#" class="list-group-item">
            Friends 
        </a>
        <a href="#" class="list-group-item">
            Events 
        </a>
       <a href="#" class="list-group-item">
            Interests 
        </a>
       <a href="#" class="list-group-item">
            Some Empty Text 
        </a>
            <a href="#" class="list-group-item">
            Some Empty Text 
        </a>
</div>
    </div>
    
    <div style="background-color: lightgrey;min-height: 100%;margin: 0;padding: 0;" class="col-md-8" >
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img style="width:250px;height:250px;" src="images/img_flower.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>

    <div class="item">
      <img style="width:250px;height:250px;" src="images/img_flower.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
       
    </div>

    <div class="item">
        <img style="width:250px;height:250px;" src="images/logo.jpg" alt="Flower">
      <div class="carousel-caption">
        <h3>Flowers</h3>
        <p>Beatiful flowers in Kolymbari, Crete.</p>
      </div>
    </div>

    <div class="item">
      <img style="width:250px;height:250px;" src="images/img_flower.jpg" alt="Flower">
      <div class="carousel-caption">
        <h3>Flowers</h3>
        <p>Beatiful flowers in Kolymbari, Crete.</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        
        <div class="container">
	<div class="row">
	<div class="col-md-10 col-md-offset-2">
		
		<form action="#" method="post" role="form" enctype="multipart/form-data" class="facebook-share-box">
			<!--<ul class="post-types">
				<li class="post-type">
					<a class="status" title="" href="#"><i class="icon icon-file"></i> Share an Update</a>
				</li>
				<li class="post-type">
					<a class="photos" href="#"><i class="icon icon-camera"></i> Add photos</a>
				</li>
			</ul> -->
			<div class="share">
				<div class="arrow"></div>
				<div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-file"></i> Update Status</div>
                      <div class="panel-body">
                        <div class="">
                            <textarea name="message" cols="40" rows="10" id="status_message" class="form-control message" style="height: 62px; overflow: hidden;" placeholder="What's on your mind ?"></textarea> 
						</div>
                      </div>
						<div class="panel-footer">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<div class="btn-group">

											  <button type="button" class="btn btn-default"><i class="icon icon-picture"></i> Photo</button>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<select name="privacy" class="form-control privacy-dropdown pull-left input-sm">
												<option value="1" selected="selected">Public</option>
												<option value="2">Only my friends</option>
												<option value="3">Only me</option>
											</select>                                    
											<input type="submit" name="submit" value="Post" class="btn btn-primary">                               
										</div>
									</div>
								</div>
						</div>
                    </div>
			</div>
			</div>
		</form>
	</div>
	</div>
        
        <div  class="container">
	<div class="row">
        <div style="background-color:white;margin-left:21%;" class="col-md-9">
            Feed i 
        </div>
        </div>
        </div>
        
        <div style="margin-top:2%;" class="container">
	<div class="row">
        <div style="background-color:white;margin-left:21%;" class="col-md-9">
            Feed i 
        </div>
        </div>
        </div>
        
	</div> 
    
    <div style="background-color: lightgreen;height: 100%;margin: 0;padding-left: 10px;" class="col-md-2" >
        <div>
        <h4>My Activities</h4>
        
        <h4>Latest Friends</h4>
        <ul style="padding:0;margin: 0;list-style:none;" class="post-types" >
            <li style="padding-top:10px;"  class="">
                <img style="float:left;" width="50px" height="50px" src="images/profile.png" /> <span style="padding-left: 5px;"> Sourabh </span>
            </li>
            <li style="padding-top:40px;"  class="">
                <img style="float:left;" width="50px" height="50px" src="images/profile.png" /> <span style="padding-left: 5px;"> Sourabh </span>
            </li>
	</ul>
        </div>
        <div style="height:30%;background-color: red;margin-top:5px;padding:0;" class="col-md-12" >
            <img style="float:left;padding:0;width:100%;height:100%;" src="images/sponsored.jpg" />
        </div>
        
        <div style="height:30%;margin-top:5px;padding:0;" class="col-md-12" >
            <h4>Groups</h4>
            
            <h4>People</h4>
            
            <h4>People You May Know</h4>
        </div>
    </div>
    
    </div>
    
    
</div>
   


   

</body>

<script>
      $(function(){
          
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
