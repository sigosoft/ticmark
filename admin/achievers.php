<?php

session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];

require 'db/config.php';

$query=mysqli_query($conn,"SELECT redeem_points FROM redeem_limit WHERE id=1");
$qrow=mysqli_fetch_assoc($query);
$limited=$qrow['redeem_points'];


$sql="SELECT users.*, user_volume.* FROM users INNER JOIN user_volume ON users.user_id=user_volume.user_id WHERE user_volume.volume >= '$limited' AND users.block=0";
$result=mysqli_query($conn,$sql);



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
                <center><h2 style="font-family: "Times New Roman", Times, serif;">Achievers</h2></center> 
                <section class="content-header">
                    
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>


                
                <table id="tb" class="display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Amount</th>
                <th>User Level</th>
                <th>Status</th>
                <th>Date & Time</th>
               
               
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Amount</th>
                <th>User Level</th>
                <th>Status</th>
                <th>Redeem</th>
               

                
            </tr>
        </tfoot>
        <tbody>
       
            <?php 
        while($row=mysqli_fetch_assoc($result))
        {
        
        $status=$row['status'];  
        if($status=='Pending')
        {
            
        $color="Red";    
            
        }
        else
        {
            $color="Green";
        }
        
        $ref=$row['reffered_by'];
        
        $query_ref=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$ref'");
        $ref_num_row=mysqli_fetch_assoc($query_ref);
        
        $ref_numbered=$ref_num_row['mobile'];
        
            
        ?>

            <tr style="color:<?php echo $color; ?>">
                <td><?php echo $row['Name'];?></td>
                <td><?php echo $row['mobile'];?></td>
                

                <?php 
                $lvl=$row['user_level'];
                $user=$row['user_id'];
                $level="SELECT * FROM user_level WHERE id='$lvl'";
                $lr=mysqli_query($conn,$level);
                $lev=mysqli_fetch_assoc($lr);
                $clevel=$lev['name'];
                

                $volume="SELECT * FROM user_volume WHERE user_id='$user'";
                $voler=mysqli_query($conn,$volume);
                $vol=mysqli_fetch_assoc($voler);
                $cvol=$vol['volume'];

                ?> 
                <td><?php echo $cvol;?></td>
                <td><?php echo $clevel;?></td>
                <td><?php echo $row['status'];?></td>
               <td><a href="redeem.php?id=<?php echo $row['user_id'];?>&uid=<?php echo $row['PaymentRequestID'];?>">Redeem</a></td>
                
               
                
               

                
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