
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$wing =$_GET["wing"];
$bhk =$_GET["bhk"];
$bhkid =$_GET["bhkid"];



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



$req1 = "SELECT * FROM `AABhk` WHERE `user`='$encUser' and `bhk`='$bhk' and `project`='$project' and `wing`='$wing'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{
  $queryB="INSERT INTO `AABhk` (`bhk`, `project`, `wing`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$bhk', '$project', '$wing', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
echo 5;

$find = "SELECT AAproject.name pname, AAWing.wing wing FROM AAproject, AAWing, AABhk WHERE AAproject.id='$project' and AAWing.id='$wing'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  
  
  $Adescription ="type added";
  $Atitle = "Project ".$pname." ".$wingname. "<br> name : ".$bhk."<br>added done";
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="project";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end


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



$req1 = "SELECT * FROM `AABhk` WHERE `user`='$encUser' and `bhk`='$bhk' and `project`='$project' and `wing`='$wing'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{
  $queryB="INSERT INTO `AABhk` (`bhk`, `project`, `wing`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$bhk', '$project', '$wing', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
echo 5;

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT AAproject.name pname, AAWing.wing wing FROM AAproject, AAWing, AABhk WHERE AAproject.id='$project' and AAWing.id='$wing'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  
  
  $Adescription ="type added";
  $Atitle = "Project ".$pname." ".$wingname. "<br> name : ".$bhk."<br>added done";
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="project";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end



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