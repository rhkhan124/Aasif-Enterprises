<?php
require_once("con.php");

$user =$_GET["user"];
$password =$_GET["password"];

/// device info

$ip = $_GET["ip"];
$devicemodel = $_GET["devicemodel"];
$deviceid = $_GET["deviceid"];

date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$sqlmobile = "SELECT * FROM `AAuser` WHERE `mobile`='$user' AND `password`='$password'";
$resultmobile = mysqli_query($con, $sqlmobile);
$usermobile = mysqli_fetch_assoc($resultmobile);
$Umobile = $usermobile["mobile"];
$Password = $usermobile["password"];
$userID = $usermobile["Main"];

$Bemail = $usermobile["email"];
$Bcompany = $usermobile["company"];
$Bname = $usermobile["name"];
$Blastactive = $usermobile["lastactive"];
$Brole = $usermobile["role"];
$Bmain = $usermobile["id"];


/// encryption
$token_stringA = $Password;
$token_stringB = $Bmain;
$token_stringC = $userID;
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "9923377552";

$BtokenA = openssl_encrypt($token_stringA, $ciphering, $encryption_key, $options, $encryption_iv);
$BtokenB = openssl_encrypt($token_stringB, $ciphering, $encryption_key, $options, $encryption_iv);
$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);

///$decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

///// end encryption
$deviceC =0;



$sqlemail = "SELECT * FROM `AAuser` WHERE `email`='$user' AND `password`='$password'";
$resultemail = mysqli_query($con, $sqlemail);
$useremail = mysqli_fetch_assoc($resultemail);
$Uemail = $useremail["email"];
$Password2 = $useremail["password"];
$userID2 = $useremail["Main"];
$Bmain2 = $useremail["id"];

$token_stringA2 = $Password2;
$token_stringB2= $Bmain2;
$token_stringC2 = $userID2;
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "9923377552";

$BtokenA2 = openssl_encrypt($token_stringA2, $ciphering, $encryption_key, $options, $encryption_iv);
$BtokenB2 = openssl_encrypt($token_stringB2, $ciphering, $encryption_key, $options, $encryption_iv);
$BtokenC2 = openssl_encrypt($token_stringC2, $ciphering, $encryption_key, $options, $encryption_iv);

if($Umobile==$user && $Password==$password)
{

  $sqladd = "SELECT * FROM `AAdevices` WHERE `user`='$userID' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
  $resultadd = mysqli_query($con, $sqladd);
  $useradd = mysqli_fetch_assoc($resultadd);
  $Udevicename = $useradd["devicename"];
  $Udeviceid = $useradd["deviceid"];

if($Udevicename==$devicemodel && $Udeviceid==$deviceid)
{
  $queryB="UPDATE `AAdevices` SET `devicename` = '$devicemodel', `deviceid` = '$deviceid', `lastlogin` = '$datetime', `ext1` = '$ip' WHERE `AAdevices`.`user` = '$Bmain2' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
  $result = mysqli_query($con, $queryB);
  $deviceC =1;
}
else {
  $queryB="INSERT INTO `AAdevices`(`user`, `devicename`, `model`, `deviceid`, `verified`, `lastlogin`, `date`, `alert`, `ext1`, `ext2`, `ext3`) VALUES ('$userID','$devicemodel','','$deviceid',0,'$datetime','$date','$userID','$ip','','')";
  $result = mysqli_query($con, $queryB);
  $deviceC =0;
  // $queryC="UPDATE `AAdevices` SET `lastlogin` = '$datetime', `ext1` = '$ip' WHERE `AAdevices`.`user` = '$userID' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
  // $resultC = mysqli_query($con, $queryC);
}
if(strlen($Umobile)==0)
{
  $response = 0;
}
else {
  $response = 4;
}

$sqlcom = "SELECT * FROM `AAuser` WHERE `Main` ='$userID'";
$resultcom = mysqli_query($con, $sqlcom);
$usercom = mysqli_fetch_assoc($resultcom);
$mycompany = $usercom["company"];


$myObj->user = $BtokenC;
$myObj->token  = $BtokenA;
$myObj->id  = $BtokenB;
$myObj->uid  = $usermobile["id"];
$myObj->name  = $usermobile["name"];
$myObj->mobile  = $usermobile["mobile"];
$myObj->email  = $usermobile["email"];
$myObj->role  = $usermobile["role"];
$myObj->company  = $mycompany;
$myObj->lastactive  = $usermobile["lastactive"];
$myObj->response  =   $response;
$myObj->device  = $deviceC;
$myObj->project  =   $usermobile["project"];
$myObj->empid  = $usermobile["employee"];
$myJSON = json_encode($myObj);
echo $myJSON;
}
else {
  if($Uemail==$user && $Password2==$password)
  {
    $sqladd = "SELECT * FROM `AAdevices` WHERE `user`='$userID2' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
    $resultadd = mysqli_query($con, $sqladd);
    $useradd = mysqli_fetch_assoc($resultadd);
    $Udevicename = $useradd["devicename"];
    $Udeviceid = $useradd["deviceid"];

  if($Udevicename==$devicemodel && $Udeviceid==$deviceid)
  {
    $queryB="UPDATE `AAdevices` SET `devicename` = '$devicemodel', `deviceid` = '$deviceid', `lastlogin` = '$datetime', `ext1` = '$ip' WHERE `AAdevices`.`user` = '$Bmain2' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
    $result = mysqli_query($con, $queryB);
    $deviceC =1;
  }
  else {
    $queryB="INSERT INTO `AAdevices`(`user`, `devicename`, `model`, `deviceid`, `verified`, `lastlogin`, `date`, `alert`, `ext1`, `ext2`, `ext3`) VALUES ('$userID2','$devicemodel','','$deviceid',0,'$datetime','$date','$userID2','$ip','','')";
    $result = mysqli_query($con, $queryB);
    $deviceC =0;
    // $queryC="UPDATE `AAdevices` SET `lastlogin` = '$datetime', `ext1` = '$ip' WHERE `AAdevices`.`user` = '$userID2' AND `devicename`='$devicemodel' AND `deviceid`='$deviceid'";
    // $resultC = mysqli_query($con, $queryC);
  }
  if(strlen($Uemail)==0)
  {
    $response = 0;
  }
  else {
    $response = 4;
  }
  
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main` ='$userID2'";
  $resultcom = mysqli_query($con, $sqlcom);
  $usercom = mysqli_fetch_assoc($resultcom);
  $mycompany = $usercom["company"];
  
  
  $myObj->user = $BtokenC2;
  $myObj->token  = $BtokenA2;
  $myObj->id  = $BtokenB2;
  $myObj->uid  = $useremail["id"];
  $myObj->name  = $useremail["name"];
  $myObj->mobile  = $useremail["mobile"];
  $myObj->email  = $useremail["email"];
  $myObj->role  = $useremail["role"];
  $myObj->company  = $mycompany;
  $myObj->lastactive  = $useremail["lastactive"];
  $myObj->response  =   $response ;
  $myObj->device  = $deviceC;
  $myObj->project  =   $useremail["project"];
  $myObj->empid  = $useremail["employee"];
  $myJSON = json_encode($myObj);
  echo $myJSON;
  }
  else {
    $myObj->id = '';
    $myObj->token  = '';
    $myObj->user  = '';
    $myObj->uid  = '';
    $myObj->name  = '';
    $myObj->mobile  = '';
    $myObj->email  = '';
    $myObj->role  = '';
    $myObj->company  = '';
    $myObj->lastactive  = '';
    $myObj->response  = 0;
    $myObj->device  = '';
    $myObj->project  =   "";
    $myObj->empid  = "";
    $myJSON = json_encode($myObj);
    echo $myJSON;
  }
}




?>