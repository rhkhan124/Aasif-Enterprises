
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empid =$_GET["empid"];
$empdate =$_GET["date"];
$empremarks =$_GET["remarks"];
$empamount =$_GET["amount"];
$empcheck =$_GET["check"];
$sms =$_GET["sms"];

$newdate =explode("/",$empdate);
$empdate =$newdate[2]."-".$newdate[1]."-".$newdate[0];

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
$uname = $reqData["name"];
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{

$sql3= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' and `amount`='$empamount' and `datetime`='$date'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$myamount =$row3['amount'];
$myremark =$row3['remarks'];
$mydate =$row3['datetime'];

if($myamount==$empamount && $date==$mydate && $empcheck !=1)
{
echo $myremark;
}
else
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];
$empmobile =$row1['mobile'];
$empname =$row1['name'];

$sql2= "INSERT INTO `AAPaid` (`id`, `name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES (NULL, '$empid', '$empdate', '$empremarks', '$empamount', '$date', '$time', 'Restore', '$pid', '', '', '$encUser', '$encId', '', '', '', '')";
$result2 = mysqli_query($con, $sql2);
echo 4;

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription =" paid money added";
  $Atitle = $empname." paid out ".$empamount." rupees by date ".$empdate." for the ".$empremarks;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="employee";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$focus;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);


$req1w = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
$reqRw = mysqli_query($con, $req1w);
$reqDataw = mysqli_fetch_assoc($reqRw);
$company = $reqDataw["company"];


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
	$sender = urlencode('ASFENT');
	$message = rawurlencode('Dear%20employee%2C%0A%20'.$uname.'%20paid%20out%20you%20'.$empamount.'%20rupees%20from%20'.$company.'%0A%0Aregards%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($sms=="true")
	{
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	}
	// Process your response here
	
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
if($permissionA[$x]==15)
{
$check =1;
}
}
if($check==1)
{


$sql3= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' and `amount`='$empamount' and `datetime`='$date'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$myamount =$row3['amount'];
$myremark =$row3['remarks'];
$mydate =$row3['datetime'];

if($myamount==$empamount && $date==$mydate && $empcheck !=1)
{
echo $myremark;
}
else
{

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$pid =$row1['project'];
$empmobile =$row1['mobile'];
$empname =$row1['name'];

$sql2= "INSERT INTO `AAPaid` (`id`, `name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES (NULL, '$empid', '$empdate', '$empremarks', '$empamount', '$date', '$time', 'Restore', '$pid', '', '', '$encUser', '$encId', '', '', '', '')";
$result2 = mysqli_query($con, $sql2);
echo 4;

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription =" paid money added";
  $Atitle = $empname." paid out ".$empamount." rupees by date ".$empdate." for the ".$empremarks;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="employee";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$focus;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);


$req1w = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
$reqRw = mysqli_query($con, $req1w);
$reqDataw = mysqli_fetch_assoc($reqRw);
$company = $reqDataw["company"];


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
	$sender = urlencode('ASFENT');
	$message = rawurlencode('Dear%20employee%2C%0A%20'.$uname.'%20paid%20out%20you%20'.$empamount.'%20rupees%20from%20'.$company.'%0A%0Aregards%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($sms=="true")
	{
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	}
	// Process your response here
	
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