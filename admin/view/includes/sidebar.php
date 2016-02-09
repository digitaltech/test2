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
                        <a href="javascript:;" data-toggle="collapse" data-target="#idmessages"><i class="fa fa-fw fa-arrows-v"></i> Messages <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="idmessages" class="collapse">
                            <li>
                                <a href="message-manage">Manage Messages</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#announcment"><i class="fa fa-fw fa-arrows-v"></i> Announcments <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="announcment" class="collapse">
                            <li>
                                <a href="announcment-manage">Announcment</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                  <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#polls"><i class="fa fa-fw fa-arrows-v"></i> Polls <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="polls" class="collapse">
                            <li>
                                <a href="poll-manage">Polls</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#survey"><i class="fa fa-fw fa-arrows-v"></i> Survey <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="survey" class="collapse">
                            <li>
                                <a href="survey-manage">Survey</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#timehall"><i class="fa fa-fw fa-arrows-v"></i> Time Hall <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="timehall" class="collapse">
                            <li>
                                <a href="timehall-manage">Time Hall</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                   
                  
                </ul>
<?php }  ?>