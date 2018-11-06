<?php
session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];
date_default_timezone_set('Asia/Kolkata');



require 'db/config.php';

if(isset($_POST['submit']))
{

$distributor_number=$_POST['distributor_number'];

$sql="SELECT users.*, user_level.* FROM users INNER JOIN user_level ON users.user_level= user_level.id WHERE users.mobile='$distributor_number'";
$result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);
 $block=$row['block'];
 $user_id=$row['user_id'];

if(mysqli_num_rows($result)==1)
{

 

  if($block==0)
  { 

   $display=1;
  
 
   $sql="SELECT * FROM outlet_sale WHERE user_id='$user_id'";

   
  
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
                                    <h3 class="box-title">Ledger</h3>
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


<?php  if(isset($display))
{?>
<div class="col-md-4">

         <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">User Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <p>Name:<span style="margin-left: 4%;"><?php echo $row['Name'];?></span></p>
                            <p>Rank:<span style="margin-left: 4%;"><?php echo $row['name'];?></span></p>
                            <p>Mobile:<span style="margin-left: 4%;"><?php echo $row['mobile'];?></span></p>
                                        </div>
                                        
                                        </div>

                                        
                                    </form>



                                </div>
                        </div>

                          </div>

                </section><!-- /.content -->



 <div class="container" >
 <div style="padding-right: 5%!important;">

     
<table id="tb" class="display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Total</th>
            </tr>
        </tfoot>
        <tbody>
            
            
            <?php 
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result))
        {
        ?>

            <tr>


                
                <?php 
              
                $user=$row['user_id'];
                $level="SELECT * FROM users WHERE user_id='$user'";
                $lr=mysqli_query($conn,$level);
                $lev=mysqli_fetch_assoc($lr);
                $name=$lev['Name'];
                

               

                ?> 
                <td><?php echo $name;?></td>
                <td><?php echo $row['product_name'];?></td>
                <td><?php echo $row['unit_price'];?></td>
                <td><?php echo $row['qty'];?></td>
                <td><?php echo $row['price'];?></td>
                

               
                <td><?php echo $row['timestamp'];?></td>
                
                

                
            </tr>
         <?php };?>   
        </tbody>
    </table>



    </div>
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