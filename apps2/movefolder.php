<?php
require_once("con.php");

 $filename =$_GET["filename"];
 $ftype = $_GET["type"];
 $position = $_GET["position"];
 $codename = $_GET["codename"];
 $extn = $_GET["extn"];
 $ref1 = $_GET["ref1"];
 $ref2 = $_GET["ref2"];
 $ref3 = $_GET["ref3"];
 $req = $_GET["req"];



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
$date=date('Y/m/d');
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

if($req=="move")
{
$sql3= "UPDATE `AAfolder` SET `ref1` = '$ref1' WHERE `AAfolder`.`id` ='$ref3'";
$result3 = mysqli_query($con, $sql3);
echo 4;
}
else if($req=="copy")
{

$ftype = $ftype;
$position = $position;

$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;



$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '', '')";
$result2 = mysqli_query($con, $sql2);
echo 5;
}
























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if(5==5)
{
$check =1;
}
}
if($check==1)
{


if($req=="move")
{
$sql3= "UPDATE `AAfolder` SET `ref1` = '$ref1' WHERE `AAfolder`.`id` ='$ref3'";
$result3 = mysqli_query($con, $sql3);
echo 4;
}
else if($req=="copy")
{

$ftype = $ftype;
$position = $position;

$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;



$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '', '')";
$result2 = mysqli_query($con, $sql2);
echo 5;
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