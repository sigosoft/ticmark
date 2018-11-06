
<?php
session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];

date_default_timezone_set('Asia/Kolkata');



$user_type=$_GET['lvl'];

require 'db/config.php';
$s="s";
$query = "SELECT * FROM user_level WHERE id='$user_type' ";
$qresult = mysqli_query($conn,$query);
$list = mysqli_fetch_assoc($qresult); 

$sql="SELECT * FROM users WHERE user_level='$user_type'";
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

          
            


            <aside class="right-side" style="margin-top: 10%">
                <center><h1 style="font-family: "Times New Roman", Times, serif;"><?php echo $list['name'].$s; ?></h1></center> 
                <section class="content-header">
                    
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>


                
                <table id="tb" class="display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>S No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Volume Earned</th>
                <th>Reffered By Mobile</th>
                <th>Status</th>
                <th>Date & Time</th>
                <th>Outlet</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>S No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Volume Earned</th>
                <th>Reffered By Mobile</th>
                <th>Status</th>
                <th>Date & Time</th>
                <th>Outlet</th>
                
                
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

                <?php 
                $user=$row['user_id'];
                $volume="SELECT * FROM user_volume WHERE user_id='$user'";
                $voler=mysqli_query($conn,$volume);
                $vol=mysqli_fetch_assoc($voler);
                $cvol=$vol['volume'];

                ?> 
                  <td style="font-size:20px"><?php echo $row['user_id'];?></td>
                <td style="font-size:20px"><?php echo $row['Name'];?></td>
                <td style="font-size:20px"><?php echo $row['mobile'];?></td>

                <td style="font-size:20px"><?php echo $cvol;?></td>
                <td style="font-size:20px"><?php echo $ref_numbered ?></td>
                <td style="font-size:20px"><?php echo $row['status'];?></td>
                
                <td style="font-size:20px"><?php echo $row['timestamp'];?></td>
                 <td style="font-size:20px"><?php $out_id=$row['outlet_id'];
                $Get_outlet="SELECT name FROM auth WHERE id='$out_id'";
                $Get_outlet_res=mysqli_query($conn,$Get_outlet);
                $Get_outlet_row=mysqli_fetch_assoc($Get_outlet_res);
                echo $Get_outlet_row['name'];
                
                
                ?></td>

                
                
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