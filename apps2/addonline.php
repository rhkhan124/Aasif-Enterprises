
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$pid =$_GET["pid"];
$type2 =$_GET["type"];
$device =$_GET["device"];
$accuracy =$_GET["accuracy"];

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
$decId =openssl_decrypt ( $encId , $ciphering, $dec_key, $options, $dec_iv);
$decUser=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
$decToken=openssl_decrypt ( $encToken , $ciphering, $dec_key, $options, $dec_iv);


date_default_timezone_set('Asia/Kolkata');
$date=date('Y/m/d');
$time =date("h:i:s a");
$month =date("F", strtotime($date)); //
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
$name = $reqData["name"];
$mobile = $reqData["Main"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{




$req1 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `addedby`='$encId' and `project`='$pid' and `date`='$date' and `type`='$type2'";
$run1 = mysqli_query($con, $req1);
$result1 = mysqli_fetch_assoc($run1);

if(mysqli_num_rows($run1)>0)
{
echo 5;
}
else
{

$req2 = "INSERT INTO `AAonline` (`name`, `project`, `device`, `accuracy`, `date`, `time`, `type`, `month`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$decId', '$pid', '$device', '$accuracy', '$date', '$time', '$type2', '$month', '$encUser', '$encId', '', '', '')";
$run2 = mysqli_query($con, $req2);

$req8 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
   $run8 = mysqli_query($con, $req8);
   $result8 = mysqli_fetch_assoc($run8);
   
   $mygnameB = $result8["name"];

$sender ="";
if($decUser=="9892558100")
{
$sender ="ASFENT";
}
else
{
$sender="MYMNGE";
}
$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	$sms=$type2;
	$numbers = urlencode($mobile);
	$sender = urlencode($sender);
	$message = urlencode($name."%20arrived%20on%20time%20".$time."%20at%20".$mygnameB."%0A%0Aregards%0AmyManage%20team");
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($sms=="start")
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
if(8==8)
{
$check =1;
}
}
if($check==1)
{



$req1 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `addedby`='$encId' and `project`='$pid' and `date`='$date' and `type`='$type2'";
$run1 = mysqli_query($con, $req1);
$result1 = mysqli_fetch_assoc($run1);

if(mysqli_num_rows($run1)>0)
{
echo 5;
}
else
{

$req2 = "INSERT INTO `AAonline` (`name`, `project`, `device`, `accuracy`, `date`, `time`, `type`, `month`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$decId', '$pid', '$device', '$accuracy', '$date', '$time', '$type2', '$month', '$encUser', '$encId', '', '', '')";
$run2 = mysqli_query($con, $req2);

$req8 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
   $run8 = mysqli_query($con, $req8);
   $result8 = mysqli_fetch_assoc($run8);
   
   $mygnameB = $result8["name"];

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
	$sms=$type2;
	$numbers = urlencode($mobile);
	$sender = urlencode($sender);
	$message = urlencode($name."%20arrived%20on%20time%20".$time."%20at%20".$mygnameB."%0A%0Aregards%0AmyManage%20team");
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($sms=="start")
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