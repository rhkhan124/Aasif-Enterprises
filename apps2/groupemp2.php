<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$emp =$_GET["emp"];


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

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `id`='$emp'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{

   $emp2 = $row1['id'];
   $req12 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$emp2' and `date`='$date'";
   $run12 = mysqli_query($con, $req12);
   
   $dis2 ="";
   if(mysqli_num_rows($run12)>0)
   {
   $dis2 ="disabled";
   }
   else
   {
   $dis2 =" ";
   }
   
   
   $myObj->id  = $row1['id'];
   $myObj->name  = $row1['name'];
   $myObj->dis  = $dis2;
   $myJSON = json_encode($myObj);
   
   echo $myJSON."@";
   
   $sql1b= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Group employee' and `ext1`='$emp2'";
   $result1b = mysqli_query($con, $sql1b);
   while ($row1b = mysqli_fetch_assoc($result1b))
   {
   $emp = $row1b['id'];
   $req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$emp' and `date`='$date'";
   $run1 = mysqli_query($con, $req1);
   
   $dis ="";
   if(mysqli_num_rows($run1)>0)
   {
   $dis ="disabled";
   }
   else
   {
   $dis =" ";
   }
  
   
   $myObj->id  = $row1b['id'];
   $myObj->name  = $row1b['name'];
   $myObj->dis  = $dis;
   $myJSON = json_encode($myObj);
   
   echo $myJSON."@";
   
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
if(5==5)
{
$check =1;
}
}
if($check==1)
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `id`='$emp'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{

   $emp2 = $row1['id'];
   $req12 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$emp2' and `date`='$date'";
   $run12 = mysqli_query($con, $req12);
   
   $dis2 ="";
   if(mysqli_num_rows($run12)>0)
   {
   $dis2 ="disabled";
   }
   else
   {
   $dis2 =" ";
   }
   
   
   
   
   $sql1b= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Group employee' and `ext1`='$emp2'";
   $result1b = mysqli_query($con, $sql1b);
   while ($row1b = mysqli_fetch_assoc($result1b))
   {
   $emp = $row1b['id'];
   $req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$emp' and `date`='$date'";
   $run1 = mysqli_query($con, $req1);
   
   $dis ="";
   if(mysqli_num_rows($run1)>0)
   {
   $dis ="disabled";
   }
   else
   {
   $dis =" ";
   }
  
   
   $myObj->id  = $row1b['id'];
   $myObj->name  = $row1b['name'];
   $myObj->dis  = $dis;
   $myJSON = json_encode($myObj);
   
   echo $myJSON."@";
   
   }

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