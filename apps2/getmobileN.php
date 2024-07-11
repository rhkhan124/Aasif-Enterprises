
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empid =$_GET["empid"];

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


$decId=openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);
$decUser =openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
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
$uname = $reqData["name"];
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];
$empmobile =$row1['mobile'];
$empname =$row1['name'];



$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$decID =$row1['id'];
$empmobile =$row1['mobile'];
$empname =$row1['name'];

$sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid'";
$result15 = mysqli_query($con, $sql15);
$row15 =mysqli_fetch_assoc($result15);
$totalPaid = $row15["paid"];

$encID = openssl_encrypt($decID, $ciphering, $dec_key, $options, $dec_iv);
   $myObj->mobile  = $empmobile;
   
   
   $myObj->empid  = $encID;
   $myObj->paid  = $totalPaid;
   $myJSON = json_encode($myObj);

   echo $myJSON;


}

/// encryption


?>