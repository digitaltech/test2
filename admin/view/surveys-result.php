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
    
   
    
    
    
   
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
        
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
        <div class="pull-right" >  <a class="btn btn-primary" href="poll-add">Add</a> </div> 
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
             url:"surveyresult_cntr",
             method: "post",  
             data: {action:'getall','id':"<?php echo $_REQUEST['id']; ?>"}
          },
          "aoColumns": [
            { "mData": function(data) { serno = serno+1; return serno; },"sWidth": "5%","sTitle":"S.No."},
            { "mData": "user_name","sWidth": "5%","sTitle":"User Name"},
             { "mData": "user_email","sWidth": "5%","sTitle":"User Email"},
            { "mData": function(data,type,full){ if(data.vote == 1) { return "Yes"; } else if (data.vote == 2) { return "Yes"; } else { return "Neutral"; } },"sWidth": "5%","sTitle":"Vote" }
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
        window.location.href="constituency_cntr-delete-"+userid;
    }
    
    
    </script>
    
</html>
