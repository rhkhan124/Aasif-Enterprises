
<?php
require_once("con.php");

 $name =$_GET["filename"];
 $ftype = $_GET["type"];
 $position = $_GET["position"];
 $ref1 = $_GET["ref1"];
 $ref2 = $_GET["ref2"];
 $ref3 = $_GET["ref3"];
 $request = $_GET["req"];
$ext2 = $_GET["ext2"];


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
$codename ="";
$projectList ="";
if($ref3==1)
{

$codename = pathinfo($name, PATHINFO_FILENAME);
 $sql9= "DELETE FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$ref2' and `filename`='$name'";
 $result9 = mysqli_query($con, $sql9);
unlink("folder/$codename");
}
else
{
$codename = $ref2.date('dmY').date('hi');
}
/*$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {


}
*/






$req1 = "SELECT * FROM `AAuser` WHERE `id`='$decId' and `Main`='$decUser'";
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


$location ="folder";
$fileName = $_FILES["myfile2"]["name"]; // The file name
$fileTmpLoc = $_FILES["myfile2"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["myfile2"]["type"];
$myfiletype = pathinfo($fileName, PATHINFO_EXTENSION); // The type of file it is
$fileSize = $_FILES["myfile2"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["myfile2"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
echo "ERROR: Please browse for a file before clicking the upload button."; exit(); } 
if(move_uploaded_file($fileTmpLoc, "$location/$codename.$myfiletype"))
{ 


$filename =$name;

$ftype = $ftype;
$position = $position;

$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;
$extn = $myfiletype;

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$empid' and `type`='$ftype' and `filename`='$filename'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '$ext2', '')";
$result2 = mysqli_query($con, $sql2);
}
else
{
$filename =$filename."(1)";
$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '$ext2', '')";
$result2 = mysqli_query($con, $sql2);
}


} 
else { echo "move_uploaded_file function failed"; 
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

$location ="folder";
$fileName = $_FILES["myfile2"]["name"]; // The file name
$fileTmpLoc = $_FILES["myfile2"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["myfile2"]["type"];
$myfiletype = pathinfo($fileName, PATHINFO_EXTENSION); // The type of file it is
$fileSize = $_FILES["myfile2"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["myfile2"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
echo "ERROR: Please browse for a file before clicking the upload button."; exit(); } 
if(move_uploaded_file($fileTmpLoc, "$location/$codename.$myfiletype"))
{ 


$filename =$name;

$ftype = $ftype;
$position = $position;

$date = $date;
$time = $time;
$encUser = $encUser;
$encId = $encId;
$extn = $myfiletype;

$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref2`='$empid' and `type`='$ftype' and `filename`='$filename'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '', '')";
$result2 = mysqli_query($con, $sql2);
}
else
{
$filename =$filename."(1)";
$sql2= "INSERT INTO `AAfolder` (`filename`, `filecodename`, `type`, `position`, `ref1`, `ref2`, `date`, `time`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$filename', '$codename', '$ftype', '$position', '$ref1', '$ref2', '$date', '$time', '$encUser', '$encId', '$extn', '', '')";
$result2 = mysqli_query($con, $sql2);
}


} 
else { echo "move_uploaded_file function failed"; 
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