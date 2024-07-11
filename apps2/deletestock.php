<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$data =$_GET["data"];


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

$alertdata ="";

$myitem = explode(",",$data);
for ($x = 0; $x <= count($myitem); $x++) {
 $idx =$myitem[$x];
 
$req1x = "SELECT * FROM `AAstock` WHERE `user`='$encUser' and `id`='$idx'";
$reqRx = mysqli_query($con, $req1x);
while ($item =mysqli_fetch_assoc($reqRx ))
{

$projectid = $item["project"];
$dealer = $item["dealer"];
$date2 = $item["date"];
$challan = $item["challan"];

$itemx = $item["item"];
$qtyx = $item["qty"];
$unitx = $item["unit"];
$amountx = $item["amount"];

$find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$projectid' and AAitemname.id='$itemx'";
  $resultfind2 = mysqli_query($con, $find2);
  $rowfind2 = mysqli_fetch_assoc($resultfind2);
  $itemname2 =$rowfind2["item"];
  $pname =$rowfind2["pname"];
$alertdata =$alertdata.($itemname2." ".$qtyx." ".$unitx." amount  ".$amountx."<br>");
  
  $queryBm="DELETE FROM `AAstock` WHERE `id`='$idx'";
  $resultm = mysqli_query($con, $queryBm);
}
}



$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }

  
  $Adescription =$pname.' stock item <strong style="color:red;">deleted</strong>';
  $Atitle = "Prty name ".$dealer."<br>Challan ".$challan."<br>Date ".$date2."<br>".$alertdata;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="project";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area

























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==28)
{
$check =1;
}
}
if($check==1)
{

$alertdata ="";

$myitem = explode(",",$data);
for ($x = 0; $x <= count($myitem); $x++) {
 $idx =$myitem[$x];
 
$req1x = "SELECT * FROM `AAstock` WHERE `user`='$encUser' and `id`='$idx'";
$reqRx = mysqli_query($con, $req1x);
while ($item =mysqli_fetch_assoc($reqRx ))
{

$projectid = $item["project"];
$dealer = $item["dealer"];
$date2 = $item["date"];
$challan = $item["challan"];

$itemx = $item["item"];
$qtyx = $item["qty"];
$unitx = $item["unit"];
$amountx = $item["amount"];

$find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$projectid' and AAitemname.id='$itemx'";
  $resultfind2 = mysqli_query($con, $find2);
  $rowfind2 = mysqli_fetch_assoc($resultfind2);
  $itemname2 =$rowfind2["item"];
  $pname =$rowfind2["pname"];
$alertdata =$alertdata.($itemname2." ".$qtyx." ".$unitx." amount  ".$amountx."<br>");
  
  $queryBm="DELETE FROM `AAstock` WHERE `id`='$idx'";
  $resultm = mysqli_query($con, $queryBm);
}
}



$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }

  
  $Adescription =$pname.' stock item <strong style="color:red;">deleted</strong>';
  $Atitle = "Prty name ".$dealer."<br>Challan ".$challan."<br>Date ".$date2."<br>".$alertdata;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="project";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area
























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