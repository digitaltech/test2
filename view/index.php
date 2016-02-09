<?php
require_once '../config/config.php';
require_once '../config/classload.php';
//die(print_r($_SESSION));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title><?php echo PROJECT_NAME; ?></title>
    
<?php require_once 'includes/header.php'; ?>

</head>

<body>

   
         
            <?php require_once 'includes/navbar.php'; ?>
            
    <div class="container" >
       <div class="jumbotron">
           <?php if(isset($_SESSION['suc_msg']) && $_SESSION['suc_msg'] != '' ) { ?>
           <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $_SESSION['suc_msg']; ?>
          </div>
           <?php $_SESSION['suc_msg'] = ''; } ?>
           
            <?php if(isset($_SESSION['err_msg']) && $_SESSION['err_msg'] != '' ) { ?>
           <div class="alert alert-danger">
            <strong>Fail!</strong> <?php echo $_SESSION['err_msg']; ?>
          </div>
           <?php $_SESSION['err_msg'] = ''; } ?>
           <h3>Connect with your Constituency today!</h3>
	</div>
    </div>
         
   


   

</body>

<script>


    
</script>

</html>
