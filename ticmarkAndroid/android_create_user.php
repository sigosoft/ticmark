<?php

include 'android_connection.php';


$Name=$_POST['Name'];
$passwe=$_POST['password'];
$password=md5($passwe);
$password=$_POST['password'];
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

$IdentityCardP = $_POST['IdentityCard'];
$UserImageP = $_POST['UserImage'];





$check="SELECT * FROM users WHERE mobile='$mobile'";
$cresult = mysqli_query($conn,$check);



 $usercon="U";
 $UserImage=$usercon.time();
 
 $userpath = "../outlets/uploads/user/$UserImage.png";
 
 $identitycon="ID";
 $IdentityCard=$identitycon.time();
 
 $idpath = "../outlets/uploads/idproof/$IdentityCard.png";





if(mysqli_num_rows($cresult)==0)
{




$refer = "SELECT * FROM users WHERE mobile='$reffered'";
$referer = mysqli_query($conn,$refer);
$lister = mysqli_fetch_assoc($referer);

if(mysqli_num_rows($referer)==1)
{
    $reffered_by=$lister['user_id'];
    $outlet_id=$lister['outlet_id'];



$sql="INSERT INTO users(mobile,Name,password,user_level,reffered_by,outlet_id,status,block,AccountHolder,BankName,account_no,IFSCCode,idproof,UserImage,Address, Pincode, email, PANCard, DOB, AadhaarNumber, NomineeName, Relation, NomineeDOB) VALUES ('$mobile','$Name','$password',1,'$reffered_by','$outlet_id','pending',0,'$AccountHolder','$BankName', '$account_no','$IFSCCode','$IdentityCard.png','$UserImage.png','$Address', '$Pincode', '$email', '$PANCard', '$DOB', '$AadhaarNumber', '$NomineeName', '$Relation', '$NomineeDOB')";


if (mysqli_query($conn, $sql))
{




$tex=mysqli_insert_id($conn);

$user="SELECT * FROM users WHERE user_id='$tex'";
$uresult = mysqli_query($conn,$user);
$ulist=mysqli_fetch_assoc($uresult);

$user_id=$ulist['user_id'];

    file_put_contents($userpath,base64_decode($UserImageP));
    file_put_contents($idpath,base64_decode($IdentityCardP)); 


$points=mysqli_query($conn,"INSERT INTO user_volume (user_id,volume) VALUES ('$user_id','$volume')");

$ledger=mysqli_query($conn,"INSERT INTO user_ledger (user_id,type,volume) VALUES ('$user_id','Credit','$volume')");

 

$customer_message="Hi%20".$Name.",%20Welcome%20to%20Ticmark.%20Your%20Username%20is%20".$mobile."%20and%20Password%20is%20".$passwe.".%20Thank%20You.";


 $test=file_get_contents("http://sms2.sigosoft.com/pushsms.php?username=TIKMARK&api_password=0f41e223ucx1pkfs4&sender=TIKMRK&to=".$mobile."&message=".$customer_message."&priority=11");

$pass['Status']="Success"; 



}
else
{

$pass['Status']="Failed";  

}

}

else
{
   $pass['Status']="Referenec Number Not Found";  
}

}

else
{

$pass['Status']="Already Register";

}

print_r(json_encode($pass));

?>

