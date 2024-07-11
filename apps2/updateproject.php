
<?php
require_once("con.php");
$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$pname =$_GET["pname"];
$pmobile =$_GET["pmobile"];
$pemail =$_GET["pemail"];
$paddress =$_GET["paddress"];
$location =$_GET["location"];
$accuracy =$_GET["accuracy"];
$wing =$_GET["wing"];

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

///// start query from her


  $queryB="UPDATE `AAproject` SET `name` = '$pname', `address` = '$paddress', `location` = '$location', `accuracy` = '$accuracy' WHERE `AAproject`.`id` = '$project'";
  $result = mysqli_query($con, $queryB);
echo 5;


$req1z = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
$reqRz = mysqli_query($con, $req1z);
$resultx =mysqli_fetch_assoc($reqRz);
$pidx = $resultx["id"];

$wingA = explode("@",$wing);
for ($x = 0; $x <= count($wingA); $x++) {
 $allwing = json_decode($wingA[$x],true);
 if(count($allwing)!=0)
 {
$mywing =$allwing["wing"];
$wid =$allwing["wid"];
$p =$allwing["p"];
if($p=="true")
{
  $queryByd="UPDATE `AAWing` SET `wing` = '$mywing' WHERE `AAWing`.`id` ='$wid'";
  $resultyd = mysqli_query($con, $queryByd);
}
else
{
if($mywing!="")
{
$req1y = "SELECT * FROM `AAWing` WHERE `user`='$encUser' and `wing`='$mywing' and `project`='$pidx'";
$reqRy = mysqli_query($con, $req1y);
if (mysqli_num_rows($reqRy ) > 0)
{
$xy =0;
}
else
{
  $queryBy="INSERT INTO `AAWing` (`wing`, `project`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$mywing', '$pidx', 'Restore', '$encUser', '$encId', '', '', '')";
  $resulty = mysqli_query($con, $queryBy);
}
}
  $queryByg="DELETE FROM `AAWing` WHERE `wing`=''";
  $resultyg = mysqli_query($con, $queryByg);
}
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
if(0==1)
{
$check =1;
}
}
if($check==1)
{























}
else
{
echo 2; // permission not granted
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