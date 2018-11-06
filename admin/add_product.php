


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

$product_name=$_POST['product_name'];
$product_code=$_POST['product_code'];
$volume=$_POST['volume'];
$price=$_POST['price'];
$category=$_POST['category'];


    $file = $_FILES['file'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $shuffled = str_shuffle('1234');
    $file_name = $shuffled.time().'.'.$ext;
    
    if(move_uploaded_file($file['tmp_name'], 'uploads/products/' . $file_name))
    {


       $sql="INSERT INTO products(product_code,product_name,volume,price,category,image) VALUES ('$product_code','$product_name','$volume','$price','$category','$file_name')";
       mysqli_query($conn,$sql);
       echo "<script> alert('Product Added Successfully');window.location.href = 'view_product.php';</script>";

}
else
{
die;
echo "<script> alert('Upload Error');window.location.href = 'add_product.php';</script>";


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
                                    <h3 class="box-title">Add Products</h3>
                                </div>
                                <form method="POST" enctype="multipart/form-data">



                                    <div class="box-body">

                                     
                                   <div class="form-group">
                                   <label for="category">Category</label>
                                   <select class="form-control" id="category" name="category" required>
        
                                   <?php
                                   $query="SELECT * FROM category";
                                   $result=mysqli_query($conn,$query);
                                   while($row=mysqli_fetch_assoc($result))
                                   {

                                    ?>

                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
                
           
 
                                   <?php }; ?>
                      
                                   </select>
                                   </div>


                                        <div class="form-group">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" name="product_code" class="form-control" id="product_code" placeholder="Product Code" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_code">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_code">Bussiness Volume</label>
                                            <input type="text" name="volume" class="form-control" id="volume" placeholder="Bussiness Volume" required>
                                        </div>

                                        <div class="form-group">
                                        <label for="file">Image (300*300)</label>
                                        <input type="file" class="form-control" name="file" id="file">
                                        </div>

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