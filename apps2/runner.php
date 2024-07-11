<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$wing =$_GET["wing"];
$bhk =$_GET["bhk"];
$flat =$_GET["flat"];


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


$req = "SELECT * FROM `spend` WHERE `role`='Restore'";
$run = mysqli_query($con, $req);
while ($result = mysqli_fetch_assoc($run))
{
$name = $result["name"];
$amount = $result["amount"];
$date2 = $result["ext2"];
$remark = $result["comment"];
$useremail = $result["useremail"];
$user = $result["user"];
$empdate ="";
$d = explode("/",$date2);

$empdate  =preg_replace('/\s+/', '',$d[0])."-".preg_replace('/\s+/', '',$d[1])."-".preg_replace('/\s+/', '',$d[2]);

$req2 = "SELECT * FROM `employees` WHERE `id`='$name' and `ext1`='self'";
$run2 = mysqli_query($con, $req2);
$result2 = mysqli_fetch_assoc($run2);
$name2 = $result2["name"];

$req3 = "SELECT * FROM `AAemployees` WHERE `name`='$name2'";
$run3 = mysqli_query($con, $req3);
$result3 = mysqli_fetch_assoc($run3);
$empid = $result3["id"];

$myuser = "";
$myuser2 ="";
if($user=="aasifenterprises09@gmail.com")
{

$myuser ="r0g5Sx047QSLiQ==";
$myuser2 ="pUE=";
$queryB="INSERT INTO `AAPaid` (`id`, `name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES
(NULL, '$empid', '$empdate', '$remark', '$amount', '$date2', '', 'Restore', '', '', '', '$myuser', '$myuser2', '', '', '', '')";
$result = mysqli_query($con, $queryB);
}}
