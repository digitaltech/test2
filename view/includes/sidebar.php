<?php if ($_SESSION['is_admin'] == 1 && $_SESSION['is_super_admin'] == 1 ) { //sidebar that should show only for the super admin ?>
   <ul class="nav navbar-nav side-nav">
                   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#serivces"><i class="fa fa-fw fa-arrows-v"></i> Services <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="serivces" class="collapse">
                            <li>
                                <a href="../manage-services-level-1/">Manage Child Services Level1</a>
                            </li>
                             <li>
                                <a href="../manage-services-level-2/">Manage Child Services Level 2</a>
                            </li>
                            <li>
                                <a href="../manage-services-level-3/">Manage Child Services Level 3</a>
                            </li>
                            <li>
                                <a href="../manage-services-level-4/">Manage Child Services Level 4</a>
                            </li>
                             <li>
                                <a href="../manage-services-level-createserv/">Manage Packages</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                      
                    </li>
                    
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#doctors"><i class="fa fa-fw fa-arrows-v"></i> Doctors <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="doctors" class="collapse">
                            <li>
                                <a href="#">Manage Doctors</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="fa fa-fw fa-arrows-v"></i> Admin <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="admin" class="collapse">
                            <li>
                                <a href="../manage-admins/">Manage Admins</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#patients"><i class="fa fa-fw fa-arrows-v"></i> Patients <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="patients" class="collapse">
                            <li>
                                <a href="#">Manage Patients</a>
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
                        <a href="javascript:;" data-toggle="collapse" data-target="#patients"><i class="fa fa-fw fa-arrows-v"></i> Patients <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="patients" class="collapse">
                            <li>
                                <a href="#">Manage Patients</a>
                            </li>
                           <!-- <li>
                                <a href="#">Dropdown Item</a>
                            </li> -->
                        </ul>
                    </li>
                    
                  
                  
                </ul>
<?php }  ?>