<?php
require_once("con.php");

 $filename =$_GET["filename"];
 $ftype = $_GET["type"];
 $position = $_GET["position"];
 $ref1 = $_GET["ref1"];
 $ref2 = $_GET["ref2"];
 $request = $_GET["req"];



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
$date=date('d-m-Y');
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

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `type`='folder' and `ref1`='$ref1' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{

$userid = $row1['addedby'];

$useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 
 
 
 
$sql8= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);



   $myObj->id  = $row1['id'];
   $myObj->filename  = $row1['filename'];
   $myObj->filecodename  = $row1['filecodename'];
   $myObj->type  = $row1['type'];
   $myObj->position  = $row1['position'];
   $myObj->ext  = $row1['ext1'];
   $myObj->date  = $row1['date'];
   $myObj->time  = $row1['time'];
   $myObj->user  = $row8['name'];
   $myJSON = json_encode($myObj);
   
   echo $myJSON."@";

}


$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `type`='file' and `ref1`='$ref1' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{

$userid = $row1['addedby'];

$useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 
 
 
 
$sql8= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);



   $myObj->id  = $row1['id'];
   $myObj->filename  = $row1['filename'];
   $myObj->filecodename  = $row1['filecodename'];
   $myObj->type  = $row1['type'];
   $myObj->position  = $row1['position'];
   $myObj->ext  = $row1['ext1'];
   $myObj->date  = $row1['date'];
   $myObj->time  = $row1['time'];
   $myObj->user  = $row8['name'];
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
if($permissionA[$x]==10)
{
$check =1;
}
}
if($check==1)
{

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `type`='folder' and `ref1`='$ref1' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{

$userid = $row1['addedby'];

$useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 
 
 
 
$sql8= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);



   $myObj->id  = $row1['id'];
   $myObj->filename  = $row1['filename'];
   $myObj->filecodename  = $row1['filecodename'];
   $myObj->type  = $row1['type'];
   $myObj->position  = $row1['position'];
   $myObj->ext  = $row1['ext1'];
   $myObj->date  = $row1['date'];
   $myObj->time  = $row1['time'];
   $myObj->user  = $row8['name'];
   $myJSON = json_encode($myObj);
   
   echo $myJSON."@";

}


$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `type`='file' and `ref1`='$ref1' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{

$userid = $row1['addedby'];

$useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 
 
 
 
$sql8= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);



   $myObj->id  = $row1['id'];
   $myObj->filename  = $row1['filename'];
   $myObj->filecodename  = $row1['filecodename'];
   $myObj->type  = $row1['type'];
   $myObj->position  = $row1['position'];
   $myObj->ext  = $row1['ext1'];
   $myObj->date  = $row1['date'];
   $myObj->time  = $row1['time'];
   $myObj->user  = $row8['name'];
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