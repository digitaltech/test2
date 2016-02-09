<?php
require_once '../config/config.php';
require_once '../config/classload.php';
$Announcment = new Announcment();
//die(print_r($_SESSION));
$allAnnouncments = $Announcment->getAll();
$Announcment->updateNotiStat();
//die(print_r($allPolls));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title><?php echo PROJECT_NAME; ?></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body>

   
         
            <?php require_once 'includes/navbar.php'; ?>
            
    <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage' ) { ?>
    <div class="container" >
       <div class="jumbotron">
           <table class="table table-striped " >
               <thead>
                   <tr>
                       <th>S.No</th>
                       <th>Post</th>
                       
                   </tr>
               </thead>
               <tbody>
                   <?php
                   $i = 0;
                   foreach($allAnnouncments as $announcment)
                   {
                       ?>
                   <tr><td width="40%" ><?php echo $i+1; ?></td><td width="48%" > <a href="posts-view-<?php echo $announcment['serial_no']; ?>"> <?php echo strip_tags($announcment['title']) ; ?> </a> </td> </tr>
                   <?php
                   $i++;
                   }
                   ?>
               </tbody>
           </table>
	</div>
    </div>
    <?php } ?>
   

<?php if (isset($_REQUEST['action'] ) && $_REQUEST['action'] == 'view' ) { 
   $announcmentDet = $Announcment->getById($_REQUEST['id']);
    ?>
    <div class="container" >
       
           <div class="col-md-6">
               <img width="100%" height="50%" src="<?php echo UPLOAD_PICS_FOLDER."/".$announcmentDet['file_name']  ?>" />
               <br>
               <span>Posted On: <?php echo $announcmentDet['date_time']; ?> </span> 
           </div>
           <div class="col-md-6" >
               <span><?php echo $announcmentDet['content']; ?></span>
           </div>
	
    </div>
    
<?php } ?>
   

</body>

<script>


    
</script>

</html>
