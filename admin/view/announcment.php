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
   <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
      
    </div>
    
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
        <form method="POST" action="announcment_cntr" class="form-horizontal" role="form" enctype="multipart/form-data" >
              
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Add Announcement <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Title:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="title" placeholder="Title" />
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Content:</label>
               <div class="col-sm-10">
                   <textarea placeholder="Annoucment Brief" name="content" ></textarea>
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Image:</label>
               <div class="col-sm-10">
                   <input type="file" class="form-control" id="idusremail" name="filename" placeholder="Constituency Name">
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
        $Announcment = new Announcment();
        $details = $Announcment->getById($_REQUEST['id']);
        //die(print_r($details));
        ?>

    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg msgShDiv" >
        
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
       <!-- <div class="pull-right" >  <a class="btn btn-primary" href="">Add Admin</a> </div> -->
       <form method="POST" action="announcment_cntr" class="form-horizontal" role="form" enctype="multipart/form-data" >
        <div class="form-group">
               <label class="control-label col-sm-2" for="email"></label>
               <div class="col-sm-10">
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                
                Update Announcement <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
              </div>
               </div>
             </div>
            
             <div class="form-group">
               <label class="control-label col-sm-2" for="email">Title:</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="idusremail" name="title" placeholder="Title" value="<?php echo $details['title']; ?>" />
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Content:</label>
               <div class="col-sm-10">
                   <textarea placeholder="Annoucment Brief" name="content" ><?php echo $details['content']; ?></textarea>
               </div>
             </div>
            
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Image:</label>
               <div class="col-sm-10">
                   <input type="file" class="form-control" id="idusremail" name="filename" placeholder="Constituency Name">
                   <img width="100px" height="100px" src="<?php echo '../'.UPLOAD_PICS_FOLDER.'/'.$details['file_name']; ?>" />
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
                
                Manage Announcement <span class="clrGreen"> <?php echo $_SESSION['suc_msg']; $_SESSION['suc_msg']=''; ?></span>
          </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-10 adminTbDsg">
        <div class="pull-right" >  <a class="btn btn-primary" href="announcment-add">Add Announcment</a> </div> 
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
             url:"announcment_cntr",
             method: "post",  
             data: {action:'getall'}
          },
          "aoColumns": [
            { "mData": function(data) { serno = serno+1; return serno; },"sWidth": "5%","sTitle":"S.No."},
            { "mData": "title","sWidth": "5%","sTitle":"Title"},
            { "mData": "content","sWidth": "5%","sTitle":"Content"},
            { "mData": "date_time","sWidth": "5%","sTitle":"Added On"},
            { "mData": function(data) { return "<img width = '50px' height = '50px' src = '../upimages/"+data.file_name+"'/>"; },"sWidth": "5%","sTitle":"file_name"},
            { "mData": function(data,type,full){  return "<ul class = 'nav navbar-nav'><li class = 'datLi'><a class = 'dropdown-toggle anchTog' data-toggle = 'dropdown' href='#' ><span>Action</span><span class = 'caret' ></span></a><ul class='rdBorder dropdown-menu optDown'><li><a  class = 'fntSz' href='announcment-update-"+data.serial_no+"'>Update</a></li><li><a class = 'fntSz delDatCls' data-userid = '"+data.serial_no+"' href='javascript:void(0)'>Delete</a></li></ul></li></ul>";},"sWidth": "5%","sTitle":"Action" }
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
    
    tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
    
    </script>
    
</html>
