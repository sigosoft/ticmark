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


$current = date('Y-m-d');

require 'db/config.php';
$sql="SELECT * FROM outlet_sale WHERE outlet_id='$outlet_id' AND date(timestamp)='$current'";



$query="SELECT(SELECT SUM(price) FROM outlet_sale WHERE date(timestamp)='$current' AND outlet_id='$outlet_id') AS daily,(SELECT SUM(price) FROM outlet_sale WHERE outlet_id='$outlet_id') AS total ";
$qresult=mysqli_query($conn,$query);
$list=mysqli_fetch_assoc($qresult);
$dr=$list['daily'];

if($dr>0)
{
$daily=$dr;

}
else{

$daily=0;


}




$total=$list['total'];

if($total>0)
{
$total=$total;

}
else{

$total=0;


}

if(isset($_POST['submit']))
{



$from=$_POST['from'];
$start = date("Y-m-d", strtotime($from));


$to=$_POST['to'];

$end = date("Y-m-d", strtotime($to));

$pquery="SELECT SUM(price) AS period FROM outlet_sale WHERE (DATE(`timestamp`) >= '$start' AND DATE(`timestamp`) <= '$end' AND outlet_id='$outlet_id')";
$pqresult=mysqli_query($conn,$pquery);
$plist=mysqli_fetch_assoc($pqresult);
$pdr=$plist['period'];


if($pdr>0)
{
$period=$pdr;

}
else{

$period=0;


}


$sql="SELECT * FROM outlet_sale WHERE outlet_id='$outlet_id' AND (DATE(`timestamp`) >= '$start'AND DATE(`timestamp`) <= '$end')";




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

          
            <aside class="right-side">
                <center><h1 style="font-family: "Times New Roman", Times, serif;">Sales Report</h1></center> 
                <section class="content-header">
                    
                 
                <div class="row">

                        <div class="col-lg-3 col-xs-6 text-center"> 
                          
                            <div class="small-box bg-red">

                                <div class="inner">
                                    <h3>
                                      <?php echo $total;?>
                                    </h3>
                                    <p>
                                        Total Sale
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer">
                                     <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                      
                      
                         

                        <div class="col-lg-3 col-xs-6 text-center"> 
                          
                            <div class="small-box bg-red">
                                                              
                              <?php    
                                 if(isset($_POST['submit']))
                              {
                                ?>
                                 <div class="inner">
                                    <h3>
                                        <?php echo $period;?>
                                    </h3>
                                    <p>
                                         Sale(
                                         <?php echo $from ;
                                         echo "\t";
                                         echo "To" ;
                                         echo "\t";
                                         echo $to;  ?>
                                         ) 
                                    </p>
                                </div>
                              <?php
                              }    
                              else
                              {

                              ?>                                
                               <div class="inner">
                                    <h3>
                                        <?php echo $daily;?>
                                    </h3>
                                    <p>
                                        Todays Sale
                                    </p>
                                </div>



                               
                               

  <?php                             }?>

                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="levels.php?lvl=10" class="small-box-footer">
                                     <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                         <div class="box-body">

<div class="col-md-2">
<form method="POST">
 
  <label>From</label>
 <input type="date" class="form-control" name="from">
 </div>

<div class="col-md-2">

 <label>To</label>
 <input type="date" class="form-control" name="to">
 </div>

<div class="col-md-2">

 <input type="submit" class="btn btn-danger" name="submit" style="margin-top: 16%;">

 </div>
</form>
 </div>

 </div>

                    


                
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










                </section>

    
                
                        
            </aside>
        </div>






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