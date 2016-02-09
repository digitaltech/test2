<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { //sidebar that should show only for the super admin ?>
   <ul class="nav navbar-nav side-nav">
                   
                   
                    
                     
                    
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="users-manage">Manage Users</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#trending"><i class="fa fa-fw fa-arrows-v"></i> Support <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="trending" class="collapse">
                            <li>
                                <a href="trending-manage">Manage Support</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                    
                    
                    
                  
                </ul>
<?php  } else if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 0 ) { ?>
    <ul class="nav navbar-nav side-nav">
                    
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#idmessages"><i class="fa fa-fw fa-arrows-v"></i> Approval Requests <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="idmessages" class="collapse">
                            <li>
                                <a href="message-manage">Request</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                </ul>
<?php }  ?>