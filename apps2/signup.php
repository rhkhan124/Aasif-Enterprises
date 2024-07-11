<?php
require_once("con.php");

$name=$_GET["name"];
$company=$_GET["company"];
$phone=$_GET["mobile"];
$email=$_GET["email"];
$password=$_GET["password"];
$role=$_GET["role"];
/// device info

$ip = $_GET["ip"];
$devicemodel = $_GET["devicemodel"];
$deviceid = $_GET["deviceid"];

date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$sqlmobile = "SELECT * FROM `AAuser` WHERE `mobile`='$phone'";
$resultmobile = mysqli_query($con, $sqlmobile);
$usermobile = mysqli_fetch_assoc($resultmobile);
$Umobile = $usermobile["mobile"];

$sqlemail = "SELECT * FROM `AAuser` WHERE `email`='$email'";
$resultemail = mysqli_query($con, $sqlemail);
$useremail = mysqli_fetch_assoc($resultemail);
$Uemail = $useremail["email"];

if($Umobile==$phone)
{
  echo 3;
}
else
{
if($Uemail==$email)
{
  echo 4;
}
else {
  $queryA="INSERT INTO `AAuser`(`name`,`Main`, `company`, `mobile`, `email`, `role`, `password`, `verified`, `image`, `date`, `primium`, `lastactive`, `ext2`, `ext3`, `ext4`,`project`,`permission`,`type`,`employee`) VALUES ('$name','$phone','$company','$phone','$email','','$password',0,0,'$date',0,'$datetime','active','','','','','main','')";
   if (mysqli_query($con, $queryA)){

     $sqlid = "SELECT * FROM `AAuser` WHERE `email`='$email'";
     $resultid = mysqli_query($con, $sqlid);
     $userid = mysqli_fetch_assoc($resultid);
     $Uid = $userid["id"];


     $queryB="INSERT INTO `AAdevices`(`user`,`Main`, `devicename`, `model`, `deviceid`, `verified`, `lastlogin`, `date`, `alert`, `ext1`, `ext2`, `ext3`) VALUES ('$Uid','$phone','$devicemodel','','$deviceid',1,'$datetime','$date','$Uid','$ip','','')";
     $result = mysqli_query($con, $queryB);
echo 1;
} else{
echo 2;
}
}

}


?>