<?php
require_once '../config/config.php';
require_once '../config/classload.php';
$Breakout = new Breakout();
$activeBreakout = $Breakout->getActiveBreakout();
//die(print_r($activeBreakout));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>S2S</title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body>

   
         
            <?php require_once 'includes/navbar.php'; ?>
            
    <div class="container" >
       <div class="jumbotron">
        	<h3> Today's Breakout Message </h3>
                <p> <?php echo $activeBreakout['message']; ?> </p>
	</div>
    </div>
         
   


   

</body>

<script>


    
</script>

</html>
