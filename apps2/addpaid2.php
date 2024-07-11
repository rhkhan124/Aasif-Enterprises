
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$mainB =$_GET["main"];
$empid =$_GET["empid"];
$empdate =$_GET["date"];
$empremarks =$_GET["remarks"];
$empamount =$_GET["amount"];
$empcheck =$_GET["check"];
$sms =$_GET["sms"];
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



$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];
$empmobile =$row1['mobile'];
$empname =$row1['name'];

$sql2= "INSERT INTO `AAPaid` (`id`, `name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES (NULL, '$empid', '$empdate', '$empremarks', '$empamount', '$date', '$time', 'Restore', '$pid', '', 'grp', '$encUser', '$encId', '', 'true', '$mainB', '')";
$result2 = mysqli_query($con, $sql2);

echo 4;

/// encryption


?>