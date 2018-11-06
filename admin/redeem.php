<?php
session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];

require 'db/config.php';



$UserID=$_GET['id'];




$sql="SELECT * FROM users WHERE user_id='$UserID'";
$result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);
 $block=$row['block'];
 $user_id=$row['user_id'];
 




 

  if($block==1)
  { 
  
  echo "<script> alert('User Blocked');;</script>";
  
  };

   $display=1;
   $volume="SELECT * FROM user_volume WHERE user_id='$user_id'";
   $vresult=mysqli_query($conn,$volume);
   $vrow=mysqli_fetch_assoc($vresult);

   $price="SELECT * FROM bussiness_volume";
   $presult=mysqli_query($conn,$price);
   $prow=mysqli_fetch_assoc($presult);
   $current_volume=$prow['volume'];
   $available=$vrow['volume'];
   $total=$current_volume*$available;
  
 
   






if(isset($_POST['redeem']))  
{ 
$mobile=$_POST['mobile']; 
$available=$_POST['available'];    
$redeem_amount=$_POST['redeem_amount'];
$user=$_POST['user'];

if($redeem_amount <= $available)

{


$new="UPDATE user_volume SET volume=volume-'$redeem_amount' WHERE user_id='$user'";
mysqli_query($conn,$new);

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user','Debit','$redeem_amount')");

if($_GET['uid'])
{

$PaymentID=$_GET['uid'];
$pay=mysqli_query($conn,"UPDATE payment_request SET Status='Approved' WHERE PaymentRequestID ='$PaymentID'");

};



echo "<script> alert(' Rs $redeem_amount Redeemed');window.history.go(-2);</script>";

}

else
{
        echo "<script> alert('Insufficent Amount');window.location.href = 'redeem.php';</script>";


}



};
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

                
                <div class="row">

<div class="col-md-6">
<form action="" method="POST">  
         <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Bank Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <h5><srtorng>Account Holder: </strong><?php echo $row['AccountHolder'];?></h5>
           <h5><srtorng>Bank Name: </strong><?php echo $row['BankName'];?></h5>
           <h5><srtorng>Account No: </strong><?php echo $row['account_no'];?></h5>
           <h5><srtorng>IFSC Code: </strong><?php echo $row['IFSCCode'];?></h5>
                                        
                                        </div>

                                        
                                    </form>


</div>
                                </div>





<div class="col-md-6">
<form action="" method="POST">  
         <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Redeem</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="<?php echo $row['Name'];?>" name="name"  readonly />
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" value="<?php echo $row['mobile'];?>" name="mobile"  readonly />
                                            <label>Available Amount</label>
                                            <input type="text" class="form-control" value="<?php echo $available;?>" name="available"  readonly />
                                            
                                            <label>Redeem Points</label>
                                            <input type="text" class="form-control" placeholder="Enter Amount To Be Redeemed" name="redeem_amount" required />
                                            <input type="hidden" value="<?php echo $row['user_id'];?>" name="user">
                                        </div>
                                        
                                        </div>
&nbsp&nbsp<input type="submit" class="btn btn-primary" value="Redeem" name="redeem">
                                        
                                    </form>
                                </div><!-- /.box-body -->
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