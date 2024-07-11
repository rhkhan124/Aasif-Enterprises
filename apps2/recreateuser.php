<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];


$empid =$_GET["empid"];

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
if($type=="main")
{



$sql7= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_assoc($result7);
$fetchid =$row7['id'];
$empmobile =$row7['mobile'];
$empdob =$row7['dob'];
$empname =$row7['name'];
$empproject =$row7['project'];

$userphone = $empmobile."@".$fetchid; ///substr(($fetchid.date('dmY')),0,10);
$emppassword = substr($empmobile,6,10).date('Y',strtotime($empdob));

$queryAB="DELETE FROM `AAuser` WHERE `AAuser`.`employee` = $empid";
$adduserB=mysqli_query($con, $queryAB);


$queryA="INSERT INTO `AAuser`(`name`,`Main`, `company`, `mobile`, `email`, `role`, `password`, `verified`, `image`, `date`, `primium`, `lastactive`, `ext2`, `ext3`, `ext4`,`project`,`permission`,`type`,`employee`) VALUES ('$empname','$decUser','','$userphone','$userphone','Employee','$emppassword',0,0,'$date',0,'$datetime','active','','','$empproject','','','$fetchid')";
$adduser=mysqli_query($con, $queryA);

$sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];


$sender ="";
if($decUser=="9892558100")
{
$sender="ASFENT";
}
else
{
$sender="MYMNGE";
}
$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	
	$numbers = urlencode($empmobile);
	$sender = urlencode($sender);
	$empname= $empname;
	$company = $company;
	$message = rawurlencode('Dear%2C%0D%0A%20'.$empname.'%20thank%20for%20registering%20from%20'.$company.'%20your%20user%20id%20is%20'.$userphone.'%20and%20password%20is%20'.$emppassword.'.%0D%0A%0D%0Aregards%0D%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	
	


























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==2)
{
$check =1;
}
}
if($check==1)
{


$sql7= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_assoc($result7);
$fetchid =$row7['id'];
$empmobile =$row7['mobile'];
$empdob =$row7['dob'];
$empname =$row7['name'];
$empproject =$row7['project'];

$userphone = $empmobile."@".$fetchid; ///substr(($fetchid.date('dmY')),0,10);
$emppassword = substr($empmobile,6,10).date('Y',strtotime($empdob));

$queryAB="DELETE FROM `AAuser` WHERE `AAuser`.`employee` = $empid";
$adduserB=mysqli_query($con, $queryAB);


$queryA="INSERT INTO `AAuser`(`name`,`Main`, `company`, `mobile`, `email`, `role`, `password`, `verified`, `image`, `date`, `primium`, `lastactive`, `ext2`, `ext3`, `ext4`,`project`,`permission`,`type`,`employee`) VALUES ('$empname','$decUser','','$userphone','$userphone','Employee','$emppassword',0,0,'$date',0,'$datetime','active','','','$empproject','','','$fetchid')";
$adduser=mysqli_query($con, $queryA);

$sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];


$sender ="";
if($decUser=="9892558100")
{
$sender="ASFENT";
}
else
{
$sender="MYMNGE";
}
$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	
	$numbers = urlencode($empmobile);
	$sender = urlencode($sender);
	$empname= $empname;
	$company = $company;
	$message = rawurlencode('Dear%2C%0D%0A%20'.$empname.'%20thank%20for%20registering%20from%20'.$company.'%20your%20user%20id%20is%20'.$userphone.'%20and%20password%20is%20'.$emppassword.'.%0D%0A%0D%0Aregards%0D%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	
	





























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