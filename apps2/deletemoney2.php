
<?php
require_once("con.php");


 $id =$_GET["id"];
 $user =$_GET["user"];
 $token =$_GET["token"];

 $empid =$_GET["empid"];
 $empdate =$_GET["date2"];
 $empremarks =$_GET["remark2"];
 $empamount =$_GET["amount2"];
 $empuid =$_GET["uid"];
 $myreq =$_GET["req"];
 
 

//$newdate =explode("/",$empdate);
//$empdate =$newdate[2]."-".$newdate[1]."-".$newdate[0];

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
$uname = $reqData["name"];
$active = $reqData["ext2"];
$type = $reqData["role"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="Employee")
{

if($myreq=="AAPaid")
{
$myreq ="AAPaid";
}
else
{
$myreq ="AASalary";
}


$sql3= "DELETE FROM `$myreq` WHERE `id` = '$empuid'";
$result3 = mysqli_query($con, $sql3);
echo 4;






}

}

/// encryption


?>