<?php
require_once("con.php");

$uid =$_GET["uid"];
$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

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

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='$role2'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
 $pid =$row1['project'];
 $empid =$row1['id'];
$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);




$pname=$row8['name'];
$myfocus="false";


$find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `type`='employee' and `ref2`='1' and `focus`='$empid'";
 $resultfind = mysqli_query($con, $find);
 $rowfind = mysqli_fetch_array($resultfind);
  $focus =$rowfind["focus"];

  $ref1="false";
  $ref1user2 ='';
  $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' and `ref3`!='1' and `type`='employee' and `focus`='$empid'";
  $resultref1 = mysqli_query($con, $qref1);
  while($rowref1 = mysqli_fetch_assoc($resultref1))
  {
  $ref1user =$rowref1["users"];
  $ref1array = explode(",",$ref1user);
  for ($x = 0; $x <= count($ref1array); $x++)
  {
  if($ref1array[$x]==$uid)
  {
  $ref1 ="true";
  }
  else
  {
  if($ref1array[$x]>3)
  {
  $ref1user2 = $ref1user2.$ref1array[$x].",";
  }
  }
  }
  if($ref1=="true")
  {
  $sql9= "UPDATE `AAalert` SET `users`='$ref1user2', `ref1`='', `ref2`=''WHERE `mainuser`='$encUser' and `ref3`!='1' and `type`='employee' and `focus`='$empid'";
  $result9 = mysqli_query($con, $sql9);
  }
  }


  if($empid==$focus)
  {
  if($ref1=="true")
  {
  $myfocus="true";
  }
  }

   $myObj->id  = $row1['id'];
   $myObj->name  = $row1['name'];
   $myObj->project  = $pname;
   $myObj->nick  = $row1['nickname'];
   $myObj->focus  = $myfocus;
   $myJSON = json_encode($myObj);

   echo $myJSON."@";



}


$ref1="false";
  $ref1user2 ='';
  $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' and `ref3`!='1' and `type`='employee'";
  $resultref1 = mysqli_query($con, $qref1);
  while($rowref1 = mysqli_fetch_assoc($resultref1))
  {
  $ref1user =$rowref1["users"];
  $ref1array = explode(",",$ref1user);
  for ($x = 0; $x <= count($ref1array); $x++)
  {
  if($ref1array[$x]==$uid)
  {
  $ref1 ="true";
  }
  else
  {
  if($ref1array[$x]>3)
  {
  $ref1user2 = $ref1user2.$ref1array[$x].",";
  }
  }
  }
  $sql9= "UPDATE `AAalert` SET `users`='$ref1user2', `ref1`='', `ref2`=''WHERE `mainuser`='$encUser' and `ref3`!='1' and `type`='employee'";
  $result9 = mysqli_query($con, $sql9);
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
if(5==5)
{
$check =1;
}
}
if($check==1)
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='$role2'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
 $pid =$row1['project'];
 $empid =$row1['id'];
$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);




$pname=$row8['name'];
$myfocus="false";


$find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `type`='employee' and `ref2`='1' and `focus`='$empid'";
 $resultfind = mysqli_query($con, $find);
 $rowfind = mysqli_fetch_array($resultfind);
  $focus =$rowfind["focus"];

  $ref1="false";
  $ref1user2 ='';
  $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' and `ref3`!='1' and `type`='employee' and `focus`='$empid'";
  $resultref1 = mysqli_query($con, $qref1);
  while($rowref1 = mysqli_fetch_assoc($resultref1))
  {
  $ref1user =$rowref1["users"];
  $ref1array = explode(",",$ref1user);
  for ($x = 0; $x <= count($ref1array); $x++)
  {
  if($ref1array[$x]==$uid)
  {
  $ref1 ="true";
  }
  else
  {
  if($ref1array[$x]>3)
  {
  $ref1user2 = $ref1user2.$ref1array[$x].",";
  }
  }
  }
  if($ref1=="true")
  {
  $sql9= "UPDATE `AAalert` SET `users`='$ref1user2', `ref1`='', `ref2`=''WHERE `mainuser`='$encUser' and `ref3`!='1' and `type`='employee' and `focus`='$empid'";
  $result9 = mysqli_query($con, $sql9);
  }
  }


  if($empid==$focus)
  {
  if($ref1=="true")
  {
  $myfocus="true";
  }
  }

   $myObj->id  = $row1['id'];
   $myObj->name  = $row1['name'];
   $myObj->project  = $pname;
   $myObj->nick  = $row1['nickname'];
   $myObj->focus  = $myfocus;
   $myJSON = json_encode($myObj);

   echo $myJSON."@";



}


$ref1="false";
  $ref1user2 ='';
  $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' and `ref3`!='1' and `type`='employee'";
  $resultref1 = mysqli_query($con, $qref1);
  while($rowref1 = mysqli_fetch_assoc($resultref1))
  {
  $ref1user =$rowref1["users"];
  $ref1array = explode(",",$ref1user);
  for ($x = 0; $x <= count($ref1array); $x++)
  {
  if($ref1array[$x]==$uid)
  {
  $ref1 ="true";
  }
  else
  {
  if($ref1array[$x]>3)
  {
  $ref1user2 = $ref1user2.$ref1array[$x].",";
  }
  }
  }
  $sql9= "UPDATE `AAalert` SET `users`='$ref1user2', `ref1`='', `ref2`=''WHERE `mainuser`='$encUser' and `ref3`!='1' and `type`='employee'";
  $result9 = mysqli_query($con, $sql9);
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