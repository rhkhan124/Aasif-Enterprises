<?php
require_once("con.php");

$uid =$_GET["uid"];
$newpassword =$_GET["newpassword"];
$oldpassword =$_GET["oldpassword"];


/// device info




$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];



/// device info

$encId = $id;
$encUser = $user;
$encToken = $token;
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$dec_iv = '1234567891011121';
$dec_key = "9923377552";

//$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);
$decId=openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);    // userid
$decUser=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv); ///main
$decToken=openssl_decrypt ( $encToken , $ciphering, $dec_key, $options, $dec_iv);


date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";





$req1 = "SELECT * FROM `AAuser` WHERE `id`='$decId' AND `password`='$decToken' and `Main`='$decUser'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) == 0)
{
echo 1;
}
else
{
$reqData = mysqli_fetch_assoc($reqR);
$role = $reqData["role"];
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{



date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$req1g = "SELECT * FROM `AAuser` WHERE `id`='$uid' and `password` ='$oldpassword'";
$reqRg = mysqli_query($con, $req1g);
$reqDatag = mysqli_fetch_assoc($reqRg);
$myoldpassword =$reqDatag["password"];
if($myoldpassword==$oldpassword)
{
$queryA="UPDATE `AAuser` SET `password` = '$newpassword' WHERE `AAuser`.`id` = '$uid'";
  $run =mysqli_query($con, $queryA);
   
echo 6;
}
else
{
echo 8;

}
   
   //notification area start
   
   
  

  




/*
$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {
}

*/

























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($check==0)
{
$check =1;
}
}
if($check==1)
{


date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$req1g = "SELECT * FROM `AAuser` WHERE `id`='$uid' and `password` ='$oldpassword'";
$reqRg = mysqli_query($con, $req1g);
$reqDatag = mysqli_fetch_assoc($reqRg);
$myoldpassword =$reqDatag["password"];
if($myoldpassword==$oldpassword)
{
$queryA="UPDATE `AAuser` SET `password` = '$newpassword' WHERE `AAuser`.`id` = '$uid'";
  $run =mysqli_query($con, $queryA);
   
echo 6;
}
else
{
echo 8;

}




































}
else
{
echo 2;
}
}
else
{
echo 3; //Temporary blocked
}
}


}


/// encryption


?>