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
                                <span><?php echo $outlet_name; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $outlet_name; ?>
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="setting.php" class="btn btn-default btn-flat">Setting</a>
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
                            <p><?php echo $outlet_name; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i>Outlet</a>
                        </div>
                    </div>
                
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                       
                        <li>
                            <a href="products.php">
                                <i class="fa fa-bars"></i> <span>Products</span>
                            </a>
                        </li>


                           <!--  <li>
                            <a href="user_stock.php">
                                <i class="fa fa-credit-card"></i> <span>Bill</span>
                            </a>
                        </li> -->
                        
                         <li>
                            <a href="sales.php">
                                <i class="fa fa-bar-chart-o"></i> <span>Sales</span>
                            </a>
                        </li>

                       
                        
                       <!--                 <li>
                            <a href="redeem.php">
                                <i class="fa fa-money"></i> <span>Redeem</span>
                            </a>
                        </li>  -->

                          <li class="treeview">
                            <a href="#">
                                <i class="fa fa-suitcase"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="create_user.php"><i class="fa fa-angle-double-right"></i> Add User</a></li>
                                <li><a href="manage_user.php"><i class="fa fa-angle-double-right"></i> Users List</a></li>
                                <li><a href="blocked_user.php"><i class="fa fa-angle-double-right"></i> Blocked Users</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-check-circle"></i>
                                <span>User Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="ledger.php"><i class="fa fa-angle-double-right"></i> Ledger</a></li>
                                <li><a href="user_purchase.php"><i class="fa fa-angle-double-right"></i>User Purchase Report</a></li>
                                <li><a href="user_sales.php"><i class="fa fa-angle-double-right"></i>User Sale Report</a></li>
                            </ul>
                        </li>
              



                      
              
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>