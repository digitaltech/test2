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
    <div style="margin-top: 50px;" class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
      
    </div>
    
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
        <form method="POST" action="timehall_cntr" class="form-horizontal" role="form" enctype="multipart/form-data" >
              
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Add Time Hall <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Room Name:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="roomname" />
               </div>
             </div>
            
           
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Room Title:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="title" >
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">From:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Start Time" id="idfromtime" name="fromtime" >
               </div>
             </div>
            
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">End:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="End Time" id="idtotime" name="totime" />
               </div>
             </div>
            
            
             <div class="form-group"> 
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="hidden" name="action" value="add" />
                  
                 <button type="submit" class="btn btn-default">Submit</button>
               </div>
             </div>
         </form>
    </div>

   <?php } ?>
    
    <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' ) { 
        $TimeHall = new TimeHall();
        $details = $TimeHall->getById($_REQUEST['id']);
        //die(print_r($details));
        ?>

    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
        
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
       <!-- <div class="pull-right" >  <a class="btn btn-primary" href="">Add Admin</a> </div> -->
       <form method="POST" action="timehall_cntr" class="form-horizontal" role="form" enctype="multipart/form-data" >
           <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Update Time Hall <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>
       
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Room Name:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="roomname" value="<?php echo $details['chat_room_name']; ?>" />
               </div>
             </div>
            
           
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Room Title:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="title" value="<?php echo $details['chat_title']; ?>" >
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">From:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Start Time" id="idfromtime" name="fromtime" value="<?php echo $details['from_time']; ?>" >
               </div>
             </div>
            
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">End:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="End Time" id="idtotime" name="totime" value="<?php echo $details['to_time']; ?>" />
               </div>
             </div>
            
           
             <div class="form-group"> 
               <div class="col-sm-offset-2 col-sm-10">
                   <input type="hidden" name="id" value="<?php echo $details['serial_no']; ?>" />
                   <input type="hidden" name="action" value="update" />
                  
                 <button type="submit" class="btn btn-default">Update</button>
               </div>
             </div>
       </form>
    </div>
    
    <?php } ?>
    
    <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage' ) { ?>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
         <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Time Hall <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
          </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
        <div class="pull-right" >  <a class="btn btn-primary" href="timehall-add">Add</a> </div> 
        <table class="table table-striped" id="idtable" >
            <thead>
                <tr>
                    <th></th>
                    <th></th>
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
             url:"timehall_cntr",
             method: "post",  
             data: {action:'getall'}
          },
          "aoColumns": [
            { "mData": function(data) { serno = serno+1; return serno; },"sWidth": "5%","sTitle":"S.No."},
            { "mData": "chat_room_name","sWidth": "5%","sTitle":"Room Name"},
            { "mData": "chat_title","sWidth": "5%","sTitle":"Chat Title"},
            { "mData": "from_time","sWidth": "5%","sTitle":"From Time"},
            { "mData": "to_time","sWidth": "5%","sTitle":"To Time"},
            { "mData": function(data,type,full){  return "<ul class = 'nav navbar-nav'><li class = 'datLi'><a class = 'dropdown-toggle anchTog' data-toggle = 'dropdown' href='#' ><span>Action</span><span class = 'caret' ></span></a><ul class='rdBorder dropdown-menu optDown'><li><a  class = 'fntSz' href='timehall-update-"+data.serial_no+"'>Update</a></li><li><a class = 'fntSz delDatCls' data-userid = '"+data.serial_no+"' href='javascript:void(0)'>Delete</a></li></ul></li></ul>";},"sWidth": "5%","sTitle":"Action" }
        ],
        "sDom": "<'row-fluid'<'span6'f><'span6 pull-right 'i>>t<'row-fluid'<'span4'l><'span8 pull-right'p>>",
        fnDrawCallback: function(data) { addDtEvent(); }
        });

        $('#idfromtime').datetimepicker({dateFormat: 'yy-mm-dd'});
        $('#idtotime').datetimepicker({dateFormat: 'yy-mm-dd'});

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
        window.location.href="constituency_cntr-delete-"+userid;
    }
    
    
    
    </script>
    
</html>
