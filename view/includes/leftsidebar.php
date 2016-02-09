<?php 
$users = new Users();
$userDet = $users->getUserDetails($_SESSION['user_id']);
?>

<div style="background-color: lightblue;height: 100%;margin: 0;padding: 0;" class="col-md-2" >
        <img style="width: 100%;height:200px;" src="<?php echo PROFILE_PICS_FOLDER."/".$userDet['profile_image']; ?>" />
        <div>
            <h5>Sourabh</h5>
            <a href="profile">Edit Profile</a>
        </div>
        <div class="list-group">
        <a href="#" class="list-group-item active">
            Favorites 
        </a>
            <a href="messages" target="_blank" class="list-group-item">
            Messages 
        </a>
        <a href="friends" target="_blank" class="list-group-item">
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