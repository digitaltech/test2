<?php
require_once '../config/classload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { ?>
    <title><?php echo 'Super Admin Dashboard'; ?></title>
<?php  } else if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 0 ) { ?>
    <title><?php echo 'Admin Dashboard'; ?></title>
<?php }  ?>
<?php require_once 'includes/header.php'; ?>

</head>

<body>

    <div id="wrapper" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         
            <?php require_once 'includes/navbar.php'; ?>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                
                <?php require_once 'includes/sidebar.php'; ?>
                
            </div>
            <!-- /.navbar-collapse -->
        </nav>

     

    </div>
    
    <?php if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' ) { ?>
    
    <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 divLft" >
        <form method="POST" action="users_cntr" class="form-horizontal" role="form">
             <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Update User <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Email:</label>
               <div class="col-sm-10">
                   <input type="email" class="form-control" id="idusremail" name="usremail" placeholder="Enter Email">
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Name:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusrnm" name="usrnm" placeholder="Enter Name">
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="pwd">Password:</label>
               <div class="col-sm-10"> 
                 <input type="password" class="form-control" id="idusrpass" name="usrpass" placeholder="Enter Password">
               </div>
             </div>
            
             <div class="form-group"> 
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="hidden" name="action" value="add" />
                   <input type="hidden" name="type" value="admin" />
                 <button type="submit" class="btn btn-default">Submit</button>
               </div>
             </div>
         </form>
    </div>

   <?php } ?>
    
    <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' ) { 
        $Users = new Users();
        $userdet = $Users->getUserDetails($_REQUEST['id']);
        //die(print_r($userdet));
        ?>

    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
        
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
       <!-- <div class="pull-right" >  <a class="btn btn-primary" href="">Add Admin</a> </div> -->
       <form method="POST" action="users_cntr" class="form-horizontal" role="form" enctype="multipart/form-data" >
            <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Update User <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>  
           <div class="form-group">
               <label class="control-label col-sm-2" for="email">Email:</label>
               <div class="col-sm-10">
                   <input type="email" class="form-control" id="idusremail" name="usremail" value="<?php echo $userdet['user_email']; ?>" />
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Name:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusrnm" name="usrnm" value="<?php echo $userdet['user_name']; ?>" />
               </div>
             </div>
    
            <div class="form-group">
               <label class="control-label col-sm-2" for="pwd">Password:</label>
               <div class="col-sm-10"> 
                 <input type="password" class="form-control" id="idusrpass" name="usrpass" placeholder="Enter Password">
               </div>
             </div>
            
           
            
            <div class="form-group"> 
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" name="userid" />
                   <input type="hidden" name="action" value="update" />
                   <input type="hidden" name="type" value="<?php echo $_REQUEST['usertype']; ?>" />
                 <button type="submit" class="btn btn-default">Update   </button>
               </div>
             </div>
         </form>
    </div>
    
    <?php } ?>
    
    <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage' ) { ?>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
         <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Manage User <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
          </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
       <!-- <div class="pull-right" >  <a class="btn btn-primary" href="">Add Admin</a> </div> -->
        <table class="table table-striped" id="idtable" >
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="iddelconfirm" style="display: none;"  >
        <h4>Are you sure you want to delete this record?</h4>
        <input  type="button" class="btn btn-primary yesBtn" onclick="delUser()" value="Yes" /><input type="button" class="btn btn-primary" value="No" />
    </div>
    <?php } ?>

</body>
<script>
    $(function(){
        var serno = -1;
        $('#idtable').DataTable({
          "sPaginationType": "full_numbers",
          "oLanguage": {
          "oPaginate": {
               "sNext": 'Next &rarr;',
               "sLast": '',
               "sFirst": '',
               "sPrevious": '&larr; Previous'
            }
            },
           "lengthMenu": [ 10, 20, 30, 40, 50 ], 
        // Set the default no. of rows to display
          "pageLength": 10 ,
          "processing": true,    
         "ajax": 
          {
             url:"users_cntr",
             method: "post",  
             data: {action:'getall',type:"frontusers"}
          },
          "aoColumns": [
            { "mData": function(data) { serno = serno+1; return serno; },"sWidth": "5%","sTitle":"S.No."},
            { "mData": "user_email","sWidth": "5%","sTitle":"User Email"},
            { "mData": "user_name","sWidth": "5%","sTitle":"User Name" },
            { "mData": function(data,type,full){  return "<ul class = 'nav navbar-nav'><li class = 'datLi'><a class = 'dropdown-toggle anchTog' data-toggle = 'dropdown' href='#' ><span>Action</span><span class = 'caret' ></span></a><ul class='rdBorder dropdown-menu optDown'><li><a  class = 'fntSz' href='users-update-"+data.user_id+"'>Update</a></li><li><a class = 'fntSz delDatCls' data-userid = '"+data.user_id+"' href='javascript:void(0)'>Delete</a></li></ul></li></ul>";},"sWidth": "5%","sTitle":"Action" }
        ],
        "sDom": "<'row-fluid'<'span6'f><'span6 pull-right 'i>>t<'row-fluid'<'span4'l><'span8 pull-right'p>>",
        fnDrawCallback: function(data) { addDtEvent(); }
        });

    })
    
    
     callcou = 0;
    function addDtEvent() // datatables callback after drawing a datatable is called 2 times the 2 call is effective
    {
        if (callcou == 0 || callcou == 1)
        {
            $('.delDatCls').on('click',function() {
                
                 userid = $(this).data('userid');
                
                $('#iddelconfirm').dialog({ title: "Confirm",width:400 });
                });
            callcou++;
        }
    }
    
    function delUser()
    {
        window.location.href="users_cntr-delete-"+userid;
    }
    
    </script>
    
</html>
