
<?php
require_once("con.php");
$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$pname =$_GET["pname"];
$pmobile =$_GET["pmobile"];
$pemail =$_GET["pemail"];
$paddress =$_GET["paddress"];
$location =$_GET["location"];
$accuracy =$_GET["accuracy"];
$wing =$_GET["wing"];

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

///// start query from her

$req1 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{

  $queryB="INSERT INTO `AAproject`(`id`, `name`, `phone`, `email`, `address`, `state`, `city`, `zip`, `user`, `addedby`, `notification`, `role`, `ext1`, `ext2`, `ext3`, `location`, `accuracy`) VALUES ('', '$pname','$pmobile','$pemail','$paddress','','','','$encUser','$encId','','1','','','','$location','$accuracy')";
  $result = mysqli_query($con, $queryB);
echo 5;


$req1z = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
$reqRz = mysqli_query($con, $req1z);
$resultx =mysqli_fetch_assoc($reqRz);
$pidx = $resultx["id"];

$wingA = explode("@",$wing);
for ($x = 0; $x <= count($wingA); $x++) {
 $allwing = json_decode($wingA[$x],true);
 if(count($allwing)!=0)
 {
$mywing =$allwing["wing"];
if(count($mywing)!=0)
{
$req1y = "SELECT * FROM `AAWing` WHERE `user`='$encUser' and `wing`='$mywing' and `project`='$pidx'";
$reqRy = mysqli_query($con, $req1y);
if (mysqli_num_rows($reqRy ) > 0)
{
$xy =0;
}
else
{
  $queryBy="INSERT INTO `AAWing` (`wing`, `project`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$mywing', '$pidx', 'Restore', '$encUser', '$encId', '', '', '')";
  $resulty = mysqli_query($con, $queryBy);
}
}
}
}
}



  
  //notification area start
  
  
  $alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription ="project added";
  $Atitle = $pname;
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
  $Afocus =$focus;
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end










}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==1)
{
$check =1;
}
}
if($check==1)
{


$req1 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{

  $queryB="INSERT INTO `AAproject`(`id`, `name`, `phone`, `email`, `address`, `state`, `city`, `zip`, `user`, `addedby`, `notification`, `role`, `ext1`, `ext2`, `ext3`, `location`, `accuracy`) VALUES ('', '$pname','$pmobile','$pemail','$paddress','','','','$encUser','$encId','','1','','','','$location','$accuracy')";
  $result = mysqli_query($con, $queryB);
echo 5;
}


$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `name`='$pname'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription ="project added";
  $Atitle = $pname;
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
  $Afocus =$focus;
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end

























}
else
{
echo 2; // permission not granted
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