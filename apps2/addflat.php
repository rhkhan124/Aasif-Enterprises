<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$wing =$_GET["wing"];
$bhk =$_GET["bhk"];
$flat =$_GET["flat"];


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

$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{

  $queryB="INSERT INTO `AAFlat` (`project`, `wing`, `bhk`, `flat`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$bhk', '$flat', 'Restore', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
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
if(25==25)
{
$check =1;
}
}
if($check==1)
{

$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{

  $queryB="INSERT INTO `AAFlat` (`project`, `wing`, `bhk`, `flat`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$bhk', '$flat', 'Restore', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
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