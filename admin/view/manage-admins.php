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

    <div id="wrapper">

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
    
    <div class="divLftSuc" >
        
   <?php if ( isset($_SESSION['suc_msg']) && $_SESSION['suc_msg']!='' ) { ?>
        <div class="alert alert-success col-xs-8 col-sm-8 col-md-6 col-lg-6 " role="alert"><?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg'] = '';  ?></div>
   <?php } ?>
        
    </div>
    
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 divLftTb" >
        <div class="pull-right" >  <a class="btn btn-primary" href="">Add Admin</a> </div>
        <table id="idtable" >
            <thead>
                <tr>
                    <th>Email Id</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
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

   

</body>

<script>
    
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
        window.location.href="../users_cntr-"+userid+"-deleteuser/";
    }
    
    $(function(){
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
             url:"../users_cntr/",
             method: "post",  
             data: {action:'getallusers',type:"admins"}
          },
          "aoColumns": [
            { "mData": "user_email","sWidth": "5%","sTitle":"Admin Email"},
            { "mData": "user_name","sWidth": "5%","sTitle":"User Name" },
            { "mData": function(data,type,full){  return "<ul class = 'nav navbar-nav'><li class = 'datLi'><a class = 'dropdown-toggle anchTog' data-toggle = 'dropdown' href='#' ><span>Action</span><span class = 'caret' ></span></a><ul class='rdBorder dropdown-menu optDown'><li><a  class = 'fntSz' href='../update-admin-"+data.user_id+"/'>Update</a></li><li><a class = 'fntSz delDatCls' data-userid = '"+data.user_id+"' href='javascript:void(0)'>Delete</a></li></ul></li></ul>";},"sWidth": "5%","sTitle":"Action" }
        ],
        "sDom": "<'row-fluid'<'span6'f><'span6 pull-right 'i>>t<'row-fluid'<'span4'l><'span8 pull-right'p>>",
        fnDrawCallback: function(data) { addDtEvent(); }
        });

    })
</script>

</html>
