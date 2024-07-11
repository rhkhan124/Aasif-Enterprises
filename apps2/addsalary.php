
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empid =$_GET["empid"];
$empdate =$_GET["date"];
$empremarks =$_GET["remarks"];
$empamount =$_GET["amount"];
$empcheck =$_GET["check"];
$hide =$_GET["hide"];

$newdate =explode("/",$empdate);
$empdate =$newdate[2]."-".$newdate[1]."-".$newdate[0];

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
$date=date('Y-m-d');
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

$sql3= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `name`='$empid' and `amount`='$empamount' and `datetime`='$date'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$myamount =$row3['amount'];
$myremark =$row3['remarks'];
$mydate =$row3['datetime'];

if($myamount==$empamount && $date==$mydate && $empcheck !=1)
{
echo $myremark;
}
else
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];


$sql2= "INSERT INTO `AASalary` (`name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES ('$empid', '$empdate', '$empremarks', '$empamount', '$date', '$time', 'Restore', '$pid', '', '', '$encUser', '$encId', '', '$hide', '', '')";
$result2 = mysqli_query($con, $sql2);
if($result2)
{
echo 4;

}
else
{
echo "Error";

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
if($permissionA[$x]==17)
{
$check =1;
}
}
if($check==1)
{



$sql3= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `name`='$empid' and `amount`='$empamount' and `datetime`='$date'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$myamount =$row3['amount'];
$myremark =$row3['remarks'];
$mydate =$row3['datetime'];

if($myamount==$empamount && $date==$mydate && $empcheck !=1)
{
echo $myremark;
}
else
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];


$sql2= "INSERT INTO `AASalary` (`name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES ('$empid', '$empdate', '$empremarks', '$empamount', '$date', '$time', 'Restore', '$pid', '', '', '$encUser', '$encId', '', '$hide', '', '')";
$result2 = mysqli_query($con, $sql2);
if($result2)
{
echo 4;

}
else
{
echo "Error";

}
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