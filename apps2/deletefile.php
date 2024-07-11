<?php
require_once("con.php");

 $fileid =$_GET["fid"];



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
$decId=openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);
$decUser=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
$decToken=openssl_decrypt ( $encToken , $ciphering, $dec_key, $options, $dec_iv);


date_default_timezone_set('Asia/Kolkata');
$date=date('d-m-Y');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";


/*$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {


}
*/


















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


$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `id`='$fileid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
 $myid1 =$row1["id"];
 $myname1 =$row1["filename"].",";
 $mycodename1 =$row1["filecodename"].".".$row1["ext1"];
 $mytype1 =$row1["type"];
 $myposition1 =$row1["position"];
 $myref11 =$row1["ref1"];
 $myref21 =$row1["ref2"];
 $mydate1 =$row1["date"];
 $mytime1 =$row1["time"];
 $myuser1 =$row1["user"];
 $myextn1 =$row1["ext1"];
 
 $sql11= "DELETE FROM `AAfolder` WHERE `id`='$myid1'";
 $result11 = mysqli_query($con, $sql11);
 unlink("folder/$mycodename1");
 
 








}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==11)
{
$check =1;
}
}
if($check==1)
{



$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `id`='$fileid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
 $myid1 =$row1["id"];
 $myname1 =$row1["filename"].",";
 $mycodename1 =$row1["filecodename"].".".$row1["ext1"];
 $mytype1 =$row1["type"];
 $myposition1 =$row1["position"];
 $myref11 =$row1["ref1"];
 $myref21 =$row1["ref2"];
 $mydate1 =$row1["date"];
 $mytime1 =$row1["time"];
 $myuser1 =$row1["user"];
 $myextn1 =$row1["ext1"];
 
 $sql11= "DELETE FROM `AAfolder` WHERE `id`='$myid1'";
 $result11 = mysqli_query($con, $sql11);
 unlink("folder/$mycodename1");
 
 





















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