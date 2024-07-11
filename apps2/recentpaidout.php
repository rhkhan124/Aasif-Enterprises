<?php
require_once("con.php");

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
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{





$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' ORDER BY `id` DESC Limit 50";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

    $check ="";
   $myObj->id  = $row8['id'];
   $myObj->name  = $row1['name'];
   $d=strtotime($row8['date']);
   if($row8['datetime']==$date)
   {
   $check ="true";
   }
   else
   {
   $check ="false";
   }
   
   $myObj->date  = date("d/m/Y", $d); 
   $myObj->amount = $row8['amount'];
   $myObj->check = $check;
   
   $myJSON = json_encode($myObj);
   echo $myJSON."@";
   
   
   

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
if($permissionA[$x]==16)
{
$check =1;
}
}
if($check==1)
{

$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' ORDER BY `id` DESC LIMIT 50";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

    $check ="";
   $myObj->id  = $row8['id'];
   $myObj->name  = $row1['name'];
   $d=strtotime($row8['date']);
   if($row8['datetime']==$date)
   {
   $check ="true";
   }
   else
   {
   $check ="false";
   }
   
   $myObj->date  = date("d/m/Y", $d); 
   $myObj->amount = $row8['amount'];
   $myObj->check = $check;
   
   $myJSON = json_encode($myObj);
   echo $myJSON."@";
   
   
   

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