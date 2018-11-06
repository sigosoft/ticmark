<?php
session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];

require 'db/config.php';

date_default_timezone_set('Asia/Kolkata');

$user_id=$_GET['id'];




$sql="SELECT * FROM users WHERE user_id='$user_id'";


$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tick Mark | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
    <style type="text/css">
    /* Blue Flat Button
==================================================*/
.btn-xlarge{
  position: relative;
  vertical-align: center;
  margin: 30px;
  /*width: 100%;*/
  height: 100x;
  padding: 48px 48px;
  font-size: 22px;
  color: white;
  text-align: center;
  /*text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);*/
  background: #62b1d0;
  border: 0;
 
  cursor: pointer;
 /* -webkit-box-shadow: inset 0 -3px #9FE8EF;*/
 /* box-shadow: inset 0 -3px #9FE8EF;*/
}
.btn-xlarge:active {
  top: 2px;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.btn-xlarge:hover {
  background: ##f9f9f9;
}

    </style>     



    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        
<?php require 'sidebar.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                

        <div class="container-fluid">
        <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">User Details</h1>
            
            
            
           <h5><srtorng>Name:</strong><?php echo $row['Name'];?></h5>
            <h5><srtorng>Email: </strong><?php echo $row['email'];?></h5>
           <h5><srtorng>Account Holder: </strong><?php echo $row['AccountHolder'];?></h5>
           <h5><srtorng>Bank Name: </strong><?php echo $row['BankName'];?></h5>
           <h5><srtorng>Account No: </strong><?php echo $row['account_no'];?></h5>
           <h5><srtorng>IFSC Code: </strong><?php echo $row['IFSCCode'];?></h5>
           
           
           <h5><srtorng>Aadhaar Number: </strong><?php echo $row['AadhaarNumber'];?></h5>
           
           <h5><srtorng>DOB: </strong><?php echo $row['DOB'];?></h5>
           <h5><srtorng>Address: </strong></br><?php echo str_replace(',', '<br />', $row['Address']); ?></h5>
           <h5><srtorng> Pin code: </strong><?php echo $row['Pincode'];?></h5>
           <h5><srtorng> PAN Card: </strong><?php echo $row['PANCard'];?></h5>
           <h5><srtorng> Nominee Name: </strong><?php echo $row['NomineeName'];?></h5>
           <h5><srtorng> Relation: </strong><?php echo $row['Relation'];?></h5>
           <h5><srtorng> Nominee DOB: </strong><?php echo $row['NomineeDOB'];?></h5>
           
            
        </div>

       
        <br/>

          
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <h5>ID Proof</h5>
                <img src="../outlets/uploads/idproof/<?php echo $row['idproof'];?>" class="img-responsive"><br>
             

            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <h5>User Image</h5>
                <img src="../outlets/uploads/user/<?php echo $row['UserImage'];?>" class="img-responsive"><br>
              

            </div>
            
        </div>
    </div>





                        </section><!-- right col -->



                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        


        </script> 
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html>