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

$user=$_GET['id'];

$view="SELECT users.*, user_level.* FROM users INNER JOIN user_level ON users.user_level= user_level.id WHERE users.user_id='$user'";
$viewer=mysqli_query($conn,$view);
$list=mysqli_fetch_assoc($viewer);

$status=$list['status'];


if(isset($_POST['bill']))
{


$totalvolume=0;

for($i = 0; $i<count($_POST['productname']); $i++)  
{ 


$stock="SELECT * FROM user_stock WHERE product_name='{$_POST['productname'][$i]}' AND user_id='$user'";
$stock_result=mysqli_query($conn,$stock);

$get_product="SELECT * FROM products WHERE product_name='{$_POST['productname'][$i]}'";
$get_result=mysqli_query($conn,$get_product);
$get_list=mysqli_fetch_assoc($get_result);
$product_id=$get_list['id'];
$category_id=$get_list['category'];
$unit_price=$get_list['price'];
$volume=$get_list['volume'];


 $add=$_POST['quantity'][$i];

 $tv=$volume*$add;

 $totalvolume = $totalvolume+$tv; 


if(mysqli_num_rows($stock_result)>0)
{
 

 $available=mysqli_fetch_assoc($stock_result);
 $current=$available['stock'];
 

 $new=$add+$current; 
 $price=$add*$unit_price;


 mysqli_query($conn,"UPDATE user_stock  
 SET stock='$new' WHERE product_name='{$_POST['productname'][$i]}' AND user_id='$user'");  

$out="INSERT INTO outlet_sale(user_id, product_id, unit_price, product_name, category_id, volume, qty, outlet_id, price) VALUES ('$user','$product_id','$unit_price','{$_POST['productname'][$i]}','$category_id','$volume','{$_POST['quantity'][$i]}','$outlet_id','$price')";
mysqli_query($conn,$out);


}

else
{    


 $price=$add*$unit_price;


mysqli_query($conn,"INSERT INTO user_stock  
SET   
user_id =  $user,
product_id = '$product_id',
unit_price = '$unit_price',
product_name = '{$_POST['productname'][$i]}',
category_id = $category_id,
volume = '$volume',
stock = '{$_POST['quantity'][$i]}',
outlet_id = '$outlet_id'
");  


$out="INSERT INTO outlet_sale(user_id, product_id, unit_price, product_name, category_id, volume, qty, outlet_id, price) VALUES ('$user','$product_id','$unit_price','{$_POST['productname'][$i]}','$category_id','$volume','{$_POST['quantity'][$i]}','$outlet_id','$price')";
mysqli_query($conn,$out);




}





}


if($status=='Pending')
{

$update = "UPDATE users SET status='Active' WHERE user_id='$user'";
mysqli_query($conn,$update);



};


// -------------Algorithm starts--------------









$parent_vol=$totalvolume;

$update="UPDATE user_volume SET volume=volume+'$parent_vol' WHERE user_id='$user'";
mysqli_query($conn,$update);

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user','Credit','$parent_vol')");

$bv=$totalvolume*2;

for($i=1;$i<=10;++$i)
{

$id=check_parent($user);


$user=$id;



if($i==1)
{
 $bussiness_percentage=40;
 $earned=$bv*($bussiness_percentage/100);
}     


else if($i==2)
{
 $bussiness_percentage=20;
  $earned=$bv*($bussiness_percentage/100);

} 


else if($i==3)
{
 $bussiness_percentage=15;
 $earned=$bv*($bussiness_percentage/100);

} 


else if($i==4)
{
$bussiness_percentage=8;
$earned=$bv*($bussiness_percentage/100);

} 


else if($i==5)
{
$bussiness_percentage=5;
$earned=$bv*($bussiness_percentage/100);

} 


else if($i==6)
{
$bussiness_percentage=3;
$earned=$bv*($bussiness_percentage/100);

} 


else if($i==7)
{
$bussiness_percentage=3;
$earned=$bv*($bussiness_percentage/100);

} 


else if($i==8)
{
$bussiness_percentage=2;
$earned=$bv*($bussiness_percentage/100);

} 


else if($i==9)
{
$bussiness_percentage=2;
$earned=$bv*($bussiness_percentage/100);

}

else if($i==10)
{
$bussiness_percentage=2;
$earned=$bv*($bussiness_percentage/100);

};


if($user==0)
{
 
  $social=mysqli_query($conn,"INSERT INTO social_credit (user_id,Credit) VALUES ('$user','$earned')");
  
  $updater="UPDATE social_bag SET volume=volume+'$earned' WHERE id=1";
  mysqli_query($conn,$updater);

} 
else
{

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user','Credit','$earned')");

$update="UPDATE user_volume SET volume=volume+'$earned' WHERE user_id='$user'";
mysqli_query($conn,$update);

}


// echo $user;
// echo "\t";
// echo $bussiness_percentage;
// echo "\t";
// echo $earned;



}


echo "<script> alert('Stock Added Successfully');window.location.href = 'manage_user.php';</script>";




};


function check_parent($user)
{
      
        require 'db/config.php';
        $sql1="SELECT * FROM users WHERE user_id=$user";
        $result1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_array($result1);
       
            if($row1['reffered_by']==0)
            {
                return 0;
            }
            else
            {
                return $row1['reffered_by'];
            }
       

}




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
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">

        <!-- Morris chart -->
        



        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />



    <script src="jquery/jquery-1.12.0.min.js"></script>  
    <script src="jquery/jquery-migrate-1.2.1.min.js"></script>
    
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/typeahead.min.js"></script>

    
        <style type="text/css">
.bs-example{
    font-family: sans-serif;
    position: relative;
    margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
    border: 2px solid #CCCCCC;
    border-radius: 8px;
    font-size: 24px;
    height: 30px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 396px;
}
.typeahead {
    background-color: #FFFFFF;
}
.typeahead:focus {
    border: 2px solid #0097CF;
}
.tt-query {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    color: #999999;
}
.tt-dropdown-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    padding: 8px 0;
    width: 422px;
}
.tt-suggestion {
    font-size: 24px;
    line-height: 24px;
    padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
    background-color: #0097CF;
    color: #FFFFFF;
}
.tt-suggestion p {
    margin: 0;
}
.tt-hint {
    border: 2px solid #CCCCCC;
    border-radius: 8px;
    font-size: 24px;
    height: 30px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 100% !important;
}
.typeahead, .tt-query, .tt-hint {
    border: 1px solid #CCCCCC;
    border-radius: 8px;
    font-size: 18px;
    height: 34px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 100%;
}
</style>    
    </head>
    <body class="skin-black">
        
            
                   <?php
require 'sidebar.php';
    ?>
                <!-- /.sidebar -->
            </aside>

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

                

<div class="container">

  <div class="bs-example">
        
    </div>
<form action="" method="POST">  
                    <div class="box box-primary">  
                        <div class="box-header">  
                            <h3 class="box-title">Invoice </h3>  
                        </div>
                        <div class="pull-right" style="border: 1px solid #f2f4f9;position: absolute;
    top: 2%;
    right: 8.3%;padding-right: 5%; padding-left:5%;padding-bottom: 1%;padding-top: 1%; margin-top: 3%;">
                            <p>Name:<span style="margin-left: 4%;"><?php echo $list['Name'];?></span></p>
                            <p>Rank:<span style="margin-left: 4%;"><?php echo $list['name'];?></span></p>
                            <p>Mobile:<span style="margin-left: 4%;"><?php echo $list['mobile'];?></span></p>
                        </div>  
                        <div class="box-body">  
                              
                              
                        &nbsp&nbsp&nbsp&nbsp<input type="submit" class="btn btn-primary" name="bill" value="Bill">  
                    </div><br/> 
                        <div class="col-md-3" style="margin-top: 5%;">  
                        <div class="form-group"> 
                     <input type="text" name="productname" id="typeahead" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false" placeholder="Product"> 
                     </div></div>
                     <div class="col-md-3" style="margin-top: 5%;"> 
                     <div class="form-group"> 
                     <input type="text" id="product" name="Quantity" placeholder="Quantity" class="form-control">
                     </div></div>
                     <div class="col-md-3" style="margin-top: 5%;">
                     <div class="form-group"> 
                     <input type="text" id="price" name="price" placeholder="Price" class="form-control" readonly>
                    </div></div>
                    <div class="form-group col-md-3 pull-right" style="margin-top: 5%;"> 
                    <button type="button"  onclick="updateinput()" class="btn btn-primary">Get</button>
                     <input type="button" value="Add" id="add" class="btn btn-primary" style="width: 50%">
</div>
<br><br>
                    <table class="table table-bordered table-hover" style="width: 96%;">  
                        <thead>  
                            <th>No</th>  
                            <th>Product Name</th>
                            <th>Quantity</th>    
                            <th>Price</th> 
                            <th>#</th> 

                        
                              
                            
                        </thead>  
                        <tbody class="detail">  
                          
                               
                                
                                 
                                
 
</tbody>  
  
  
</table>  
</form>

</div>








                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->



<script type="text/javascript">
function updateinput(){


var typeahead = document.getElementById("typeahead").value;
var product = document.getElementById('product').value;







xhr = new XMLHttpRequest();

  xhr.open('POST' , 'price.php' , true);
  xhr.setRequestHeader('content-type','application/json');
  xhr.send(JSON.stringify({
     typeahead:typeahead

   }));

xhr.onreadystatechange = function()
{
  
 var temp =xhr.responseText;
 console.log(temp);

if (temp) {
temp= JSON.parse(temp);

console.log(temp);




var test = temp.price;

var total=test*product;
document.getElementById('price').value=total;

var temp= xhr.responseText;
};

}


}    
</script>    


</script>        
<script type="text/javascript">  
$(function()  
{  
$('#add').click(function()  
{  
addnewrow();  
});  
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
});  
$('body').delegate('.quantity,.price,.discount','keyup',function()  
{  
var tr=$(this).parent().parent();  
var qty=tr.find('.quantity').val();  
var price=tr.find('.price').val();  
  
var dis=tr.find('.discount').val();  
var amt =(qty * price)-(qty * price *dis)/100;  
tr.find('.amount').val(amt);  
total();  
});  
});  

function addnewrow()   
{  

var typeahead = document.getElementById('typeahead').value;

var price = document.getElementById('price').value;
var product = document.getElementById('product').value;






document.getElementById('price').value="";
document.getElementById('typeahead').value="";
document.getElementById('product').value="";


var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+ 
'<td><input type="text" name="productname[]" value="'+typeahead+'" id="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Product"></td>' +
'<td><input type="text" class="form-control price" value="'+product+'" name="quantity[]"></td>'+  
  
'<td><input type="text" class="form-control price" value="'+price+'" name="price[]"></td>'+  


'<td><a href="#" class="remove">Delete</td>'+  
'</tr>';  
$('.detail').append(tr);   
}  
</script>

    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({

        name: 'typeahead',
        remote:'searcher.php?key=%QUERY',
        limit : 10
    });
});
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
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html>