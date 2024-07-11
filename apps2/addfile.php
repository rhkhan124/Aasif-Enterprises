<?php
require_once("con.php");

 $fileid =$_GET["fid"];



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


$sql1c= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ext2`='$fileid' and `type`='file'";
$result1c = mysqli_query($con, $sql1c);
while ( $resultlink =mysqli_fetch_assoc($result1c))
{
$fileid =$resultlink["id"];
$filenamep =$resultlink["filename"];
$filelink = $resultlink["filecodename"].".".$resultlink["ext1"];
echo '<tr id="frow'.$fileid.'"><td><p class="F12" id="filename'.$fileid.'" onclick="showfile2('.$fileid.');" ext="'.$resultlink["ext1"].'" link="'.$filelink.'" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;color:blue;">'.$filenamep.'</p></td><td><i id="ff'.$fileid.'" rfname="'.$filenamep.'" onclick="fdelete('.$fileid.')" rf="'.$reflink.'" class="F12 fa fa-trash" style="color:red;"></i></td></tr>';
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
if(11==11)
{
$check =1;
}
}
if($check==1)
{



$sql1c= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ext2`='$fileid' and `type`='file'";
$result1c = mysqli_query($con, $sql1c);
while ( $resultlink =mysqli_fetch_assoc($result1c))
{
$fileid =$resultlink["id"];
$filenamep =$resultlink["filename"];
$filelink = $resultlink["filecodename"].".".$resultlink["ext1"];
echo '<tr id="frow'.$fileid.'"><td><p class="F12" id="filename'.$fileid.'" onclick="showfile2('.$fileid.');" ext="'.$resultlink["ext1"].'" link="'.$filelink.'" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;color:blue;">'.$filenamep.'</p></td><td><i id="ff'.$fileid.'" rfname="'.$filenamep.'" onclick="fdelete('.$fileid.')" rf="'.$reflink.'" class="F12 fa fa-trash" style="color:red;"></i></td></tr>';
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