<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["project"];
$wing =$_GET["wing"];
$flat =$_GET["flat"];
$work =$_GET["work"];
$emp =$_GET["emp"];
$group =$_GET["group"];
$date2 =$_GET["date"];
$remark =$_GET["remark"];
$type =$_GET["type"];




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
$time =date("h:i:s A");
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
$group2 = explode(",",$group);
for ($x = 0; $x <= count($group2); $x++) {
$gr = $group2[$x];
if($gr>0)
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$emp' and `allemp`='$gr' and `date`='$date2'";
$run1 = mysqli_query($con, $req1);
if(mysqli_num_rows($run1)>0)
{

$myemp = mysqli_fetch_assoc($run1);
$myid = $myemp["allemp"];

$req3 = "SELECT * FROM `AAemployees` WHERE `id`='$myid'";
$run3 = mysqli_query($con, $req3);
$empresult3 = mysqli_fetch_assoc($run3);
$empname3 = $empresult3["name"];
echo "Already present ".$empname3."\n";
}
else
{
$req3a = "SELECT * FROM `AAemployees` WHERE `id`='$gr'";
$run3a = mysqli_query($con, $req3a);
$empresult3a = mysqli_fetch_assoc($run3a);
$empname3a = $empresult3a["desination"];

$req2 = "INSERT INTO `AAreport` (`project`, `wing`, `flat`, `work`, `emp`, `allemp`, `date`, `time`, `remark`, `no`, `type`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$flat', '$work', '$emp', '$gr', '$date2', '$time', '$remark', '1', '$type', '$encUser', '$encId', '$empname3a', '', '')";
$run2 = mysqli_query($con, $req2);
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
if(30==30)
{
$check =1;
}
}


$group2 = explode(",",$group);
for ($x = 0; $x <= count($group2); $x++) {
$gr = $group2[$x];
if($gr>0)
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$emp' and `allemp`='$gr' and `date`='$date2'";
$run1 = mysqli_query($con, $req1);
if(mysqli_num_rows($run1)>0)
{

$myemp = mysqli_fetch_assoc($run1);
$myid = $myemp["allemp"];

$req3 = "SELECT * FROM `AAemployees` WHERE `id`='$myid'";
$run3 = mysqli_query($con, $req3);
$empresult3 = mysqli_fetch_assoc($run3);
$empname3 = $empresult3["name"];
echo "Already present ".$empname3."\n";
}
else
{
$req3a = "SELECT * FROM `AAemployees` WHERE `id`='$gr'";
$run3a = mysqli_query($con, $req3a);
$empresult3a = mysqli_fetch_assoc($run3a);
$empname3a = $empresult3a["desination"];

$req2 = "INSERT INTO `AAreport` (`project`, `wing`, `flat`, `work`, `emp`, `allemp`, `date`, `time`, `remark`, `no`, `type`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$flat', '$work', '$emp', '$gr', '$date2', '$time', '$remark', '1', '$type', '$encUser', '$encId', '$empname3a', '', '')";
$run2 = mysqli_query($con, $req2);
}
}
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