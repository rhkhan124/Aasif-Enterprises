<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$emp =$_GET["emp"];
$role2 =$_GET["role"];



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
$expire=date("Y-m-d", strtotime("+180 days"));

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



$empage = (date('Y') - date('Y',strtotime($empdob)));
    

$req2 = "UPDATE `AAemployees` SET `role` = '$role2' WHERE `AAemployees`.`id` = '$emp'";
$reqq2 = mysqli_query($con, $req2);


$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$emp'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  
  $Adescription ="employee trash";
  $Atitle = $empname. " has been moved into trash";
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="employee";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$focus;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end



























}

/// encryption


?>