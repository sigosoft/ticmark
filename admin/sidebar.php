      
      <header class="header">
            <a href="dashboard.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Tick Mark
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        

                            
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Admin
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="settings.php" class="btn btn-default btn-flat">Settings</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>









        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Admin</p>

                            <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
                        </div>
                    </div>
                
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                       
                       
                        
                         <li>
                            <a href="sales.php">
                                <i class="fa fa-bar-chart-o"></i> <span>Sales</span>
                            </a>
                        </li>
                        
                        
                         <li>
                            <a href="customer_list.php">
                                <i class="fa fa-user"></i> <span>Customers</span>
                            </a>
                        </li>
                        

                         <li>
                            <a href="social_redeem.php">
                                <i class="fa fa-star"></i> <span>Social Redeem</span>
                            </a>
                        </li> 



                        
                        
                         <li>
                            <a href="initial_credit.php">
                                <i class="fa fa-gift"></i> <span>Initial Credit</span>
                            </a>
                        </li>
                        
                          <li>
                            <a href="achievers.php">
                                <i class="fa fa-trophy"></i> <span>Achievers</span>
                            </a>
                        </li>
                        
                         <li>
                            <a href="payment_request.php">
                                <i class="fa fa-credit-card"></i> <span>Payment Request</span>
                            </a>
                        </li>
                        
                        
                        
                        
                        

                        <li>
                            <a href="advertisment.php">
                                <i class="fa fa-video-camera"></i> <span>Video Advertisment</span>
                            </a>
                        </li>





                         <li>
                            <a href="redeem_limit.php">
                                <i class="fa fa-star"></i> <span>Redeem Limit</span>
                            </a>
                        </li> 

                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-square"></i>
                                <span>Outlets</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="create_outlet.php"><i class="fa fa-angle-double-right"></i> Add Outlet</a></li>
                                <li><a href="manage_outlet.php"><i class="fa fa-angle-double-right"></i> Manage Outlet</a></li>
                             
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Category</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="add_category.php"><i class="fa fa-angle-double-right"></i> Add Category</a></li>
                                <li><a href="view_category.php"><i class="fa fa-angle-double-right"></i> View Category</a></li>
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Products</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="add_product.php"><i class="fa fa-angle-double-right"></i> Add Products</a></li>
                                <li><a href="view_product.php"><i class="fa fa-angle-double-right"></i> View Products</a></li>
                                
                            </ul>
                        </li>
                        
                          <li class="treeview">
                            <a href="#">
                                <i class="fa fa-check-circle"></i>
                                <span>User Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                 <li><a href="manage_user.php"><i class="fa fa-angle-double-right"></i> Users List</a></li>
                                 <li><a href="block_users.php"><i class="fa fa-angle-double-right"></i> Block User</a></li>
                                 <li><a href="blocked_user.php"><i class="fa fa-angle-double-right"></i> Blocked Users</a></li>
                                <li><a href="ledger.php"><i class="fa fa-angle-double-right"></i> Ledger</a></li>
                                <li><a href="user_purchase.php"><i class="fa fa-angle-double-right"></i>User Purchase Report</a></li>
                                <li><a href="user_sales.php"><i class="fa fa-angle-double-right"></i>User Sale Report</a></li>
                            </ul>
                        </li>
                      
                     <li class="treeview">
                            <a href="#">
                                <i class="fa fa-picture-o"></i>
                                <span>Gallery</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="add_image.php"><i class="fa fa-angle-double-right"></i> Add Image</a></li>
                                <li><a href="view_images.php"><i class="fa fa-angle-double-right"></i> View Images</a></li>
                             
                            </ul>
                        </li>  
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-picture-o"></i>
                                <span>Slider</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="add_slider.php"><i class="fa fa-angle-double-right"></i> Add Slider</a></li>
                                <li><a href="view_slider.php"><i class="fa fa-angle-double-right"></i> View Slider</a></li>
                             
                            </ul>
                        </li> 
                        
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-sun-o"></i>
                                <span>News</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="add_news.php"><i class="fa fa-angle-double-right"></i> Add News</a></li>
                                <li><a href="view_news.php"><i class="fa fa-angle-double-right"></i> View News</a></li>
                             
                            </ul>
                        </li> 
                     
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>