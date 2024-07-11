<?php
require_once("con.php");

$uid =$_GET["uid"];
$name =$_GET["name"];
$phone =$_GET["mobile"];
$email =$_GET["email"];

$prephone =$_GET["premobile"];
$preemail =$_GET["preemail"];

$role2 =$_GET["role"];

/// device info




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
$decId=openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);    // userid
$decUser=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv); ///main
$decToken=openssl_decrypt ( $encToken , $ciphering, $dec_key, $options, $dec_iv);


date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";





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



date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$sqlmobile = "SELECT * FROM `AAuser` WHERE `mobile`='$phone'";
$resultmobile = mysqli_query($con, $sqlmobile);
$usermobile = mysqli_fetch_assoc($resultmobile);
$Umobile = $usermobile["mobile"];

$sqlemail = "SELECT * FROM `AAuser` WHERE `email`='$email'";
$resultemail = mysqli_query($con, $sqlemail);
$useremail = mysqli_fetch_assoc($resultemail);
$Uemail = $useremail["email"];

//curent user information

$sqlinfo = "SELECT * FROM `AAuser` WHERE `id`='$uid'";
$resultinfo = mysqli_query($con, $sqlinfo);
$userinfo = mysqli_fetch_assoc($resultinfo);
$role5 = $userinfo["role"];


$mycheck1 =0;
$mycheck2 =0;
if($role5=="Employee")
{
$role2 ="Employee";
}

if($Umobile==$phone)
{
if($Umobile==$prephone)
{
$mycheck1 =1;
}
else
{
$mycheck1 =0;
echo 4;
}
}
else
{
$mycheck1 =1;
}

if($Uemail==$email)
{
if($Uemail==$preemail)
{
$mycheck2 =1;
}
else
{
$mycheck2=0;
echo 5;
}
}
else
{
$mycheck2=1;
}


if($mycheck1==1 && $mycheck2==1)
{
$queryA="UPDATE `AAuser` SET `name` = '$name', `mobile` = '$phone', `email` = '$email', `role` = '$role2' WHERE `AAuser`.`id` = '$uid'";
   if (mysqli_query($con, $queryA)){
   
   
   
   //notification area start
   
   
   $alluser ="";
   $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' `id`!='$decId'";
   $resultmobile2 = mysqli_query($con, $sqlmobile2);
   while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
   {
   $alluser = $alluser.$rowe3d['id'].",";
   }
   
   $find = "SELECT * FROM `AAuser` WHERE `id`='$uid'";
   $resultfind = mysqli_query($con, $find);
   $rowfind = mysqli_fetch_assoc($resultfind);
   $focus =$rowfind["id"];
   
   $Adescription ="updated user";
   $Atitle = "name $name and desination $role and mobile no $phone and email $email";
   $Aref1 ="1";
   $Aref2 ="1";
   $Aref3 ="";
   $Aref4 ="";
   $Aref5 ="";
   $Aref6 ="";
   $Aref7 ="";
   $Adate =$date;
   $Atime =$time;
   $Atype ="user";
   $Alimitday ="60";
   $Aalert ="1";
   $Aaddedby =$decId;
   $Ausers =$alluser;
   $Anotif =$alluser;
   $Afocus =$uid;
   $Amainuser =$encUser;
   $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
   $alert = mysqli_query($con, $qalert);
   
   //notification area end
   
echo 6;
} else{
echo 7;
}
}



  




/*
$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {
}

*/

























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==5)
{
$check =1;
}
}
if($check==1)
{







































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