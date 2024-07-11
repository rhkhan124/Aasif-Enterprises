<?php
require_once("con.php");

$uid =$_GET["uid"];
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


//notification area start
 
 
 $alluser ="";
 $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
 $resultmobile2 = mysqli_query($con, $sqlmobile2);
 while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
 {
 $alluser = $alluser.$rowe3d['id'].",";
 }
 
 $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' ORDER BY `id` DESC limit 75";
 $resultfind = mysqli_query($con, $find);
 while($rowfind = mysqli_fetch_array($resultfind))
 {
  $description =$rowfind["description"];
  $title =$rowfind["title"];
  $rowid =$rowfind["id"];
  $rowdate =$rowfind["date"];
  $rowtime =$rowfind["time"];
  $rowuser =$rowfind["addedby"];
  
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$rowuser'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  $rowe3d = mysqli_fetch_assoc($resultmobile2);
  $uname = $rowe3d['name'];
  
  
 $ref1="false";
 $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `id`='$rowid'";
 $resultref1 = mysqli_query($con, $qref1);
 while($rowref1 = mysqli_fetch_assoc($resultref1))
 {
 $ref1user =$rowref1["notif"];
 $ref1array = explode(",",$ref1user);
 for ($x = 0; $x <= count($ref1array); $x++) 
 {
 if($ref1array[$x]==$uid)
 {
 $ref1 ="true";
 }
 }
 }
 if($ref1=="true")
 {
 $ref1="true";
 }
 else
 {
 $ref1="false";
 }
 
 $myObj->color = $ref1;
 $myObj->time = $rowdate."_".$rowtime;
 $myObj->description  = $uname." ".$description;
 $myObj->title  = $title;
 $myJSON = json_encode($myObj);
 
 echo $myJSON."#";
 
 
 
 }
 

 $ref1g="false";
 $qref1g = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' limit 200";
 $resultref1g = mysqli_query($con, $qref1g);
 while($rowref1g = mysqli_fetch_assoc($resultref1g))
 {
 $ref1userg =$rowref1g["notif"];
 $ref1id =$rowref1g["id"];
 $userarray ="";
 $ref1arrayg = explode(",",$ref1userg);
 for ($x = 0; $x <= count($ref1arrayg); $x++) 
 {
 if($ref1arrayg[$x]>3)
 {
 if($ref1arrayg[$x]==$uid)
 {
 $ref1g ="true";
 }
 else
 {
 $userarray =$userarray.$ref1arrayg[$x].",";
 }
 }
 }
 $findupdate = "UPDATE `AAalert` SET `notif`='$userarray' WHERE `id`='$ref1id' ";
 $resultfindu = mysqli_query($con, $findupdate);
 
 }
 
 
 
 
 
 
 
 
 //notification area end

























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


$alluser ="";
 $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
 $resultmobile2 = mysqli_query($con, $sqlmobile2);
 while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
 {
 $alluser = $alluser.$rowe3d['id'].",";
 }
 
 $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' order by `id` DESC limit 75";
 $resultfind = mysqli_query($con, $find);
 while($rowfind = mysqli_fetch_array($resultfind))
 {
  $description =$rowfind["description"];
  $title =$rowfind["title"];
  $rowid =$rowfind["id"];
  $rowdate =$rowfind["date"];
  $rowtime =$rowfind["time"];
  $rowuser =$rowfind["addedby"];
  
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$rowuser'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  $rowe3d = mysqli_fetch_assoc($resultmobile2);
  $uname = $rowe3d['name'];
  
  
 $ref1="false";
 $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `id`='$rowid'";
 $resultref1 = mysqli_query($con, $qref1);
 while($rowref1 = mysqli_fetch_assoc($resultref1))
 {
 $ref1user =$rowref1["notif"];
 $ref1array = explode(",",$ref1user);
 for ($x = 0; $x <= count($ref1array); $x++) 
 {
 if($ref1array[$x]==$uid)
 {
 $ref1 ="true";
 }
 }
 }
 if($ref1=="true")
 {
 $ref1="true";
 }
 else
 {
 $ref1="false";
 }
 
 $myObj->color = $ref1;
 $myObj->time = $rowdate."_".$rowtime;
 $myObj->description  = $uname." ".$description;
 $myObj->title  = $title;
 $myJSON = json_encode($myObj);
 
 echo $myJSON."#";
 
 
 
 }
 


$ref1g="false";
 $qref1g = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' limit 200";
 $resultref1g = mysqli_query($con, $qref1g);
 while($rowref1g = mysqli_fetch_assoc($resultref1g))
 {
 $ref1userg =$rowref1g["notif"];
 $ref1id =$rowref1g["id"];
 $userarray ="";
 $ref1arrayg = explode(",",$ref1userg);
 for ($x = 0; $x <= count($ref1arrayg); $x++) 
 {
 if($ref1arrayg[$x]>3)
 {
 if($ref1arrayg[$x]==$uid)
 {
 $ref1g ="true";
 }
 else
 {
 $userarray =$userarray.$ref1arrayg[$x].",";
 }
 }
 }
 $findupdate = "UPDATE `AAalert` SET `notif`='$userarray' WHERE `id`='$ref1id' ";
 $resultfindu = mysqli_query($con, $findupdate);
 
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