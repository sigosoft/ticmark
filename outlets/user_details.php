<?php

session_start();
if(!isset($_SESSION['outlet']))
 {
   header('location:index.php');
 };

date_default_timezone_set('Asia/Kolkata');

$user_id=$_GET['id'];
$outlet=$_SESSION['outlet'];
$outlet_id=$outlet['id'];
$outlet_name=$outlet['name'];

require 'db/config.php';

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

     <style type="text/css">
         
.btn-default:active .filter-button:active
{
    background-color: #42B32F;
    color: white;
}

.port-image
{
    width: 100%;
}

.gallery_product
{
    margin-bottom: 30px;
}

     </style>

    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        
<?php require 'sidebar.php'; ?>

          
            <aside class="right-side">
                
                <section class="content-header">
                    
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>


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
                <img src="uploads/idproof/<?php echo $row['idproof'];?>" class="img-responsive"><br>
                <a href="user_idproof.php?id=<?php echo $row['user_id'];?>"><button type="submit" name="submit" class="btn btn-primary">Edit</button></a>

            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <h5>User Image</h5>
                <img src="uploads/user/<?php echo $row['UserImage'];?>" class="img-responsive"><br>
                <a href="user_image.php?id=<?php echo $row['user_id'];?>"><button type="submit" name="submit" class="btn btn-primary">Edit</button></a>

            </div>
            
        </div>
    </div>
</section>



                </section>

    
                
                        
            </aside>
        </div>

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