<?php
session_start();
if(!isset($_SESSION['outlet']))
 {
   header('location:index.php');
 };

date_default_timezone_set('Asia/Kolkata');

$outlet=$_SESSION['outlet'];
$outlet_id=$outlet['id'];
$outlet_name=$outlet['name'];

require 'db/config.php';

if(isset($_POST['submit']))
{

$distributor_number=$_POST['distributor_number'];

$sql="SELECT * FROM users WHERE mobile='$distributor_number'";
$result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);
 $block=$row['block'];
 $user_id=$row['user_id'];

if(mysqli_num_rows($result)==1)
{

 

  if($block==0)
  { 

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
  
  }

  else {

    echo "<script> alert('User Blocked')</script>";
  } 

}
else
{
    echo "<script> alert('Distributor Mobile Number Not Found')</script>";
}    

};




if(isset($_POST['redeem']))  
{ 
$mobile=$_POST['mobile']; 
$available=$_POST['available'];    
$redeem_amount=$_POST['redeem_amount'];
$user=$_POST['user'];

if($redeem_amount < $available)

{


$new="UPDATE user_volume SET volume=volume-'$redeem_amount' WHERE user_id='$user'";
mysqli_query($conn,$new);

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user','Debit','$redeem_amount')");

echo "<script> alert(' Rs $redeem_amount Redeemed');window.location.href = 'redeem.php';</script>";

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
        

        <link href="css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="css/buttons.dataTables.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
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
                <div class="container">
                <div class="row">

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
                                            <label>Distributor No</label>
                                            <input type="number" class="form-control" name="distributor_number" placeholder="Distributor No" required />
                                        </div>
                                        
                                        </div>
&nbsp&nbsp<input type="submit" class="btn btn-primary" value="Go" name="submit">
                                        
                                    </form>


</div>
                                </div>


<?php

if(isset($display))
{
    ?>
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
<?php } ?>

         
        <!-- add new calendar event modal -->


        <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#tb').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    } );
    </script>
        
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
        
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="jquery/jquery-1.12.4.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script> 
   



    </body>
</html>