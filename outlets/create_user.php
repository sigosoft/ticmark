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


$ipo="SELECT * FROM initial_credit";
$initial=mysqli_query($conn,$ipo);
$volumer=mysqli_fetch_assoc($initial);
$volume=$volumer['points'];

if(isset($_POST['submit']))
{

$Name=$_POST['Name'];

$pass=$_POST['password'];
$password=md5($pass);
$mobile=$_POST['mobile'];
$reffered=$_POST['reffered'];
$account_no=$_POST['account_no'];



$PANCard=$_POST['PANCard'];
$DOB=$_POST['DOB'];
$AadhaarNumber=$_POST['AadhaarNumber'];
$NomineeName=$_POST['NomineeName'];
$Relation=$_POST['Relation'];
$NomineeDOB=$_POST['NomineeDOB'];
$IFSCCode=$_POST['IFSCCode'];
$Address=$_POST['Address'];
$Pincode=$_POST['Pincode'];
$email=$_POST['email'];
$BankName=$_POST['BankName'];
$AccountHolder =$_POST['AccountHolder'];

$check="SELECT * FROM users WHERE mobile='$mobile' OR AadhaarNumber='$AadhaarNumber'";
$cresult = mysqli_query($conn,$check);





if(mysqli_num_rows($cresult)==0)
{


if(!empty($reffered))
{

$refer = "SELECT * FROM users WHERE mobile='$reffered'";
$referer = mysqli_query($conn,$refer);
$lister = mysqli_fetch_assoc($referer);

if(mysqli_num_rows($referer)==1)
{
    $reffered_by=$lister['user_id'];


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


    $target_dir = "uploads/user/"; //directory details
    
    $imageFileType = pathinfo($_FILES["user"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $user_pic = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target)) 
    {
   
    $user_picD=$user_pic;

    }
    else
    {
      
    $user_picD="Dummy.jpg";

    }  





$sql="INSERT INTO users(mobile,Name,password,user_level,reffered_by,outlet_id,status,block,AccountHolder,BankName,account_no,IFSCCode,idproof,UserImage,Address, Pincode, email, PANCard, DOB, AadhaarNumber, NomineeName, Relation, NomineeDOB) VALUES ('$mobile','$Name','$password',1,'$reffered_by','$outlet_id','pending',0,'$AccountHolder','$BankName', '$account_no','$IFSCCode','$idproofD','$user_picD','$Address', '$Pincode', '$email', '$PANCard', '$DOB', '$AadhaarNumber', '$NomineeName', '$Relation', '$NomineeDOB')";

mysqli_query($conn,$sql);




$tex=mysqli_insert_id($conn);

$user="SELECT * FROM users WHERE user_id='$tex'";
$uresult = mysqli_query($conn,$user);
$ulist=mysqli_fetch_assoc($uresult);

$user_id=$ulist['user_id'];


$points=mysqli_query($conn,"INSERT INTO user_volume (user_id,volume) VALUES ('$user_id','$volume')");

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user_id','Credit','$volume')");

$customer_message="Hi%20".$Name.",%20Welcome%20to%20Ticmark.%20Your%20Username%20is%20".$mobile."%20and%20Password%20is%20".$pass.".%20Thank%20You.";


$test=file_get_contents("http://sms2.sigosoft.com/pushsms.php?username=TIKMARK&api_password=0f41e223ucx1pkfs4&sender=TIKMRK&to=".$mobile."&message=".$customer_message."&priority=11");


echo "<script> alert('User Added Successfully');window.location.href = 'manage_user.php';</script>";


}


else
{
   echo "<script> alert('Reference Mobile Not Found!')</script>";   
}




}
else
{
    $reffered_by=0;



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


    $target_dir = "uploads/user/"; //directory details
    
    $imageFileType = pathinfo($_FILES["user"]["name"],PATHINFO_EXTENSION); //image type(png or jpg etc)
    $target=$target_dir.time().'.'.$imageFileType;
    $user_pic = time().'.'.$imageFileType; //full path
    if(move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target)) 
    {
   
    $user_picD=$user_pic;

    }
    else
    {
      
    $user_picD="Dummy.jpg";

    }  
    
$sql="INSERT INTO users(mobile,Name,password,user_level,reffered_by,outlet_id,status,block,AccountHolder,BankName,account_no,IFSCCode,idproof,UserImage,Address, Pincode, email, PANCard, DOB, AadhaarNumber, NomineeName, Relation, NomineeDOB) VALUES ('$mobile','$Name','$password',1,'$reffered_by','$outlet_id','pending',0,'$AccountHolder','$BankName', '$account_no','$IFSCCode','$idproofD','$user_picD','$Address', '$Pincode', '$email', '$PANCard', '$DOB', '$AadhaarNumber', '$NomineeName', '$Relation', '$NomineeDOB')";

mysqli_query($conn,$sql);


$tex=mysqli_insert_id($conn);

$user="SELECT * FROM users WHERE user_id='$tex'";
$uresult = mysqli_query($conn,$user);
$ulist=mysqli_fetch_assoc($uresult);

$user_id=$ulist['user_id'];


$points=mysqli_query($conn,"INSERT INTO user_volume (user_id,volume) VALUES ('$user_id','$volume')");

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user_id','Credit','$volume')");


$customer_message="Hi%20".$Name.",%20Welcome%20to%20Ticmark.%20Your%20Username%20is%20".$mobile."%20and%20Password%20is%20".$pass.".%20Thank%20You.";


$test=file_get_contents("http://sms2.sigosoft.com/pushsms.php?username=TIKMARK&api_password=0f41e223ucx1pkfs4&sender=TIKMRK&to=".$mobile."&message=".$customer_message."&priority=11");

echo "<script> alert('User Added Successfully');window.location.href = 'manage_user.php';</script>";



}

}


else {

     
     echo "<script> alert('Mobile Or Aadhar Number Already used!')</script>";

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
                                    <h3 class="box-title">Add User</h3>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="username">Name <span style="color:Red">*</span></label>
                                            <input type="text" name="Name" class="form-control" id="Name" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password <span style="color:Red">*</span></label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>
                                       
                                       
                                       <div class="form-group">
                                            <label>Mobile No <span style="color:Red">*</span></label>
                                            <input type="number" pattern="[0-9]" id="mobile" name="mobile" onblur="validatormob();" onkeypress="if(this.value.length==10) return false;" class="form-control" placeholder="Mobile No" required>
                                        </div>
                                            
                                      <p id="div1" style="display: none;color:red">Invalid Number</p>  
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="DOB">DOB <span style="color:Red">*</span></label>
                                            <input type="date" name="DOB" class="form-control" id="DOB" placeholder="DOB" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="Address">Address <span style="color:Red">*</span></label>
                                            <textarea id="Address" required="required" name="Address" class="form-control col-md-7 col-xs-12" rows="10"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="NomineeName">PIN Code</label>
                                            <input type="number" name="Pincode" class="form-control" id="Pincode" placeholder="PIN Code">
                                        </div>


                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="email" name="Email" class="form-control" id="Email" placeholder="Email">
                                        </div>



                                        <div class="form-group">
                                            <label for="reffered">Reffered By Mobile Number <span style="color:Red">*</span></label>
                                            <input type="number" name="reffered" class="form-control" minlength="10" id="reffered" onblur="validatorref();" onkeypress="if(this.value.length==10) return false;" placeholder="Reffered By" required>
                                            
                                            <p id="div2" style="display: none;color:red">Invalid Number</p> 
                                            
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
                                            <label for="account_no">Account Number <span style="color:Red">*</span></label>
                                            <input type="number" name="account_no" class="form-control" id="account_no" placeholder="Account Number" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="IFSCCode">IFSC Code <span style="color:Red">*</span></label>
                                            <input type="text" name="IFSCCode" class="form-control" id="IFSCCode" placeholder="IFSC Code" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="AadhaarNumber">Aadhar Number <span style="color:Red">*</span></label>
                                            <input type="number" name="AadhaarNumber" class="form-control" minlength="12" id="AadhaarNumber" onblur="validatoradhar();" onkeypress="if(this.value.length==12) return false;" placeholder="Aadhar Number">

                                            <p id="div3" style="display: none;color:red">Invalid Aadhar dNumber</p> 
                                        </div>


                                         <div class="form-group">
                                            <label for="idproof">ID Proof</label>
                                            <input type="file" class="form-control" id="idproof" name="idproof" >
                                         </div>

                                         <div class="form-group">
                                            <label for="user_pic">user Image</label>
                                            <input type="file" class="form-control" id="user_pic" name="user_pic" >
                                         </div>


                                         <div class="form-group">
                                            <label for="PANCard">PAN Card</label>
                                            <input type="text" name="PANCard" class="form-control" id="PANCard" placeholder="PAN Card">
                                        </div>


                                        <div class="form-group">
                                            <label for="NomineeName">Nominee Name</label>
                                            <input type="text" name="NomineeName" class="form-control" id="NomineeName" placeholder="Nominee Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="Relation">Relation</label>
                                            <input type="text" name="Relation" class="form-control" id="Relation" placeholder="Relation">
                                        </div>

                                        <div class="form-group">
                                            <label for="NomineeDOB">Nominee DOB</label>
                                            <input type="date" name="NomineeDOB" class="form-control" id="NomineeDOB" placeholder="Nominee DOB">
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
    
    
      function validatorref()
      {
      var phc = document.getElementById('reffered').value;
      var nc = phc.length;
      
      if(phc!=null || phc!="")
      {
  
     if (nc!=10) {
     
       document.getElementById('div2').style.display ='block';
     
    }
    else
    {
    
    document.getElementById('div2').style.display = 'none';
    
    }
    
    }
    
    }
       
      function validatoradhar()
    {
      var adhr = document.getElementById('AadhaarNumber').value;
      var n = adhr.length;
      
      
  
     if (n!=12) {
     
       document.getElementById('div3').style.display ='block';
     
    }
    else
    {
    
    document.getElementById('div3').style.display = 'none';
    
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