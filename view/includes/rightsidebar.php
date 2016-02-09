<?php 
$Friend = new Friend();
$activitie = new Activitie();
$allActivities = $activitie->getAll();
$latestFriends = $Friend->getFriendListLatest($_SESSION['user_id']); ?>
<?php //die(print_r($latestFriends)); ?>
<div style="background-color: lightcyan;height: 106%;margin: 0;padding-left: 10px;overflow-y: scroll;" class="col-md-2" >
        <div>
        <h4>My Activities</h4>
        
        <div style="height:150px;overflow-y: scroll;" >
        <ul style="padding:0;margin: 0;list-style:none;" class="post-types" >
            
                
           <?php foreach($allActivities as $activity) { ?>
            <li style="padding-top:10px;height:60px;"  class="">
                    <img style="float:left;" width="50px" height="50px" src="<?php echo UPLOAD_PICS_FOLDER.DIRECTORY_SEPARATOR.$activity['file_name']; ?>" /> <span style="padding-left: 5px;"> <?php echo $activity['title']; ?> </span>
            </li>    
            <?php } ?>
                
            
           
	</ul>
        </div>
        
        <h4>Latest Friends</h4>
        <div style="height:150px;overflow-y: scroll;" >
        <ul style="padding:0;margin: 0;list-style:none;" class="post-types" >
            
                
                <?php foreach($latestFriends as $friend) { ?>
            <li style="padding-top:10px;height:60px;"  class="">
                    <img style="float:left;" width="50px" height="50px" src="<?php echo PROFILE_PICS_FOLDER.DIRECTORY_SEPARATOR.$friend['profile_image']; ?>" /> <span style="padding-left: 5px;"> <?php echo $friend['first_name']; ?> </span>
            </li>    
            <?php } ?>
                
            
           
	</ul>
        </div>
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