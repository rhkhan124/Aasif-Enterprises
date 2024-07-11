<?php
require_once("con.php");
 
 $filename =$_GET["filename"];
 $filename2 =$_GET["filename2"];
 $ref2 = $_GET["ref2"];
 



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


$filename =$filename;
$codename =$codename;
$ftype = $ftype;
$position = $position;
$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;
$extn = $extn;
$con =$con;

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '', 'folder', '1', 'home', '$ref2', '$date', '$time', '$encUser', '$encId', '', '', '')";
$result2 = mysqli_query($con, $sql2);

$sql3= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result3 = mysqli_query($con, $sql3);
$row3 =mysqli_fetch_assoc($result3);
$myref1 = $row3["id"];


$sql1A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result1A = mysqli_query($con, $sql1A);
if (mysqli_num_rows($result1A) == 0)
{

$sql2A= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename2', '', 'folder', '1', '$myref1', '$ref2', '$date', '$time', '$encUser', '$encId', '', '', '')";
$result2A = mysqli_query($con, $sql2A);

$sql3A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result3A = mysqli_query($con, $sql3A);
$row3A =mysqli_fetch_assoc($result3A);
echo $row3A["id"];
}
else
{
$sql4A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result4A = mysqli_query($con, $sql4A);
$row4A =mysqli_fetch_assoc($result4A);
echo $row4A["id"];
}













}
else
{
$sql4= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result4 = mysqli_query($con, $sql4);
$row4 =mysqli_fetch_assoc($result4);
$myref1= $row4["id"];

$sql1A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result1A = mysqli_query($con, $sql1A);
if (mysqli_num_rows($result1A) == 0)
{

$sql2A= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename2', '', 'folder', '1', '$myref1', '$ref2', '$date', '$time', '$encUser', '$encId', '', '', '')";
$result2A = mysqli_query($con, $sql2A);

$sql3A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result3A = mysqli_query($con, $sql3A);
$row3A =mysqli_fetch_assoc($result3A);
echo $row3A["id"];
}
else
{
$sql4A= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='$myref1' and `filename`='$filename2'";
$result4A = mysqli_query($con, $sql4A);
$row4A =mysqli_fetch_assoc($result4A);
echo $row4A["id"];
}

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

$filename =$filename;
$codename =$codename;
$ftype = $ftype;
$position = $position;
$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;
$extn = $extn;
$con =$con;

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '', 'folder', '1', 'home', '$ref2', '$date', '$time', '$encUser', '$encId', '', '', '')";
$result2 = mysqli_query($con, $sql2);

$sql3= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result3 = mysqli_query($con, $sql3);
$row3 =mysqli_fetch_assoc($result3);
echo $row3["id"];
}
else
{
$sql4= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `type`='folder' and `ref1`='home' and `filename`='$filename'";
$result4 = mysqli_query($con, $sql4);
$row4 =mysqli_fetch_assoc($result4);
echo $row4["id"];
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