

<?php
session_start();

if(!isset($_SESSION['admin']))
 {
   header('location:index.php');
 };

$admin=$_SESSION['admin'];
$admin_name=$admin['id'];
require 'db/config.php';

if(isset($_POST['submit']))
{

$username=$_POST['username'];
$password=md5($_POST['password']);
$mobile=$_POST['mobile'];
$name=$_POST['name'];
$location=$_POST['location'];
$account_no=$_POST['account_no'];
$IFSCCode=$_POST['IFSCCode'];

$BankName=$_POST['BankName'];
$AccountHolder =$_POST['AccountHolder'];

$check="SELECT * FROM auth WHERE username='$username'";
$cresult = mysqli_query($conn,$check);




if(mysqli_num_rows($cresult)==0)
{



     $target_dir = "uploads/idproof/"; //directory details
    
    $imageFileType = pathinfo($_FILES["idproof"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $idproof = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["idproof"]["tmp_name"], $target))
    {

    $idproofD=$idproof;

    }
    else
    {
   
    $idproofD="Dummy.jpg";
   
    }

   


    $target_dir = "uploads/passbook/"; //directory details
    
    $imageFileType = pathinfo($_FILES["passbook"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $passbook = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["passbook"]["tmp_name"], $target))
    {

    $passbookD=$passbook;

    }
    else
    {
   
    $passbookD="Dummy.jpg";
   
    }


     $sql="INSERT INTO auth (username,password,name,mobile,location,type,account_no,idproof,passbook,BankName,AccountHolder,IFSCCode) VALUES ('$username','$password','$name','$mobile','$location','outlet','$account_no','$idproofD','$passbookD','$BankName','$AccountHolder','$IFSCCode')";
     mysqli_query($conn,$sql);


    echo "<script> alert('Outlet Added Successfully');window.location.href = 'manage_outlet.php';</script>";
    
  

}

else 
{

     
     echo "<script> alert('Username Already used!')</script>";

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


                                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add Outlet</h3>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="box-body">

                                         <div class="form-group">
                                            <label for="location">Name<span style="color:Red">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username<span style="color:Red">*</span></label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password<span style="color:Red">*</span></label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile No<span style="color:Red">*</span></label>
                                            <input type="number"  pattern="[0-9]" id="mobile" name="mobile" onblur="validatormob();" onKeyPress="if(this.value.length==10) return false;" class="form-control" placeholder="Mobile No" required>
                                            
                                            <p id="div1" style="display: none;color:red">Invalid Number</p> 
                                        </div>

                                        <div class="form-group">
                                            <label for="location">Location<span style="color:Red">*</span></label>
                                            <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                                        </div>

                                        <div class="form-group">
                                            <label for="AccountHolder">Account Holder<span style="color:Red">*</span></label>
                                            <input type="text" name="AccountHolder" class="form-control" id="AccountHolder" placeholder="Account Holder" required>
                                        </div>



                                        <div class="form-group">
                                            <label for="account_no">Bank Name <span style="color:Red">*</span></label>
                                            <input type="text" name="BankName" class="form-control" id="BankName" placeholder="Bank Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="account_no">Account Number<span style="color:Red">*</span></label>
                                            <input type="text" name="account_no" class="form-control" id="account_no" placeholder="Account Number">
                                        </div>

                                         <div class="form-group">
                                            <label for="IFSCCode">IFSC Code <span style="color:Red">*</span></label>
                                            <input type="text" name="IFSCCode" class="form-control" id="IFSCCode" placeholder="IFSC Code" required>
                                        </div>

                                         <div class="form-group">
                                            <label for="idproof">ID Proof</label>
                                            <input type="file" class="form-control" id="idproof" name="idproof">
                                         </div>

                                         <div class="form-group">
                                            <label for="passbook">Pass Book</label>
                                            <input type="file" class="form-control" id="passbook" name="passbook">
                                         </div>

             


                                        
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                            </div>
                            </div>


                </section>

    
                
                        
            </aside>
        </div>
        
        
         <script>
  function validatormob()
    {
      var ph = document.getElementById('mobile').value;
      var n = ph.length;
  
     if (n!=10) {
     
       document.getElementById('div1').style.display ='block';
     
    }
    else
    {
    
    document.getElementById('div1').style.display = 'none';
    
    }
    }
       
             
        
        
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