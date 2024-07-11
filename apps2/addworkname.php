
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$wing =$_GET["wing"];
$wname =$_GET["wname"];
$wsqft =$_GET["wsqft"];
$wrate =$_GET["wrate"];
$wbhk =$_GET["bhk"];
$itemdata =$_GET["data"];



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

$req1 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$wname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{
  $queryB="INSERT INTO `AAWorkname` (`workname`, `sqft`, `rate`, `project`, `wing`, `bhk`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$wname', '$wsqft', '$wrate', '$project', '$wing', '$wbhk', 'Restore', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
echo 5;

$myitem = explode("@",$itemdata);
for ($x = 0; $x <= count($myitem); $x++) {
 $item = json_decode($myitem[$x],true);
 if(count($myitem)!=0)
 {
 $itemname2 =$item["item"];
 if(2==2)
 {
 $itemname =$item["item"];
$quantity =$item["quantity"];
$unit =$item["unit"];

$req1y = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$wname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk'";
$reqRy = mysqli_query($con, $req1y);
$resultyy =mysqli_fetch_assoc($reqRy);

$wid =$resultyy["id"];

$req1 = "SELECT * FROM `AAitem` WHERE `user`='$encUser' and `itemname`='$itemname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk' and `ext1`='$wid'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
$gx =0;
}
else
{


  $queryB="INSERT INTO `AAitem` (`itemname`, `qty`, `unit`, `project`, `wing`, `bhk`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$itemname', '$quantity', '$unit', '$project', '$wing', '$wbhk', 'Restore', '$encUser', '$encId', '$wid', '', '');";
  $result = mysqli_query($con, $queryB);
  
  $queryBm="DELETE FROM `AAitem` WHERE `itemname`=''";
  $resultm = mysqli_query($con, $queryBm);
  
}
}}}

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work FROM AAproject, AAWing, AABhk, AAWorkitem WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$wbhk' and AAWorkitem.id='$wname'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $workname =$rowfind["work"];
  
  $Adescription ="work added";
  $Atitle = "Project ".$pname." ".$wingname." ".$bhkname. "<br> name : ".$workname."<br>Sqft : ".$wsqft."<br>Rate : ".$wrate."<br>work added done";
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
if($permissionA[$x]==23)
{
$check =1;
}
}
if($check==1)
{

$req1 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$wname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
echo 4; // already exit record
}
else
{
  $queryB="INSERT INTO `AAWorkname` (`workname`, `sqft`, `rate`, `project`, `wing`, `bhk`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$wname', '$wsqft', '$wrate', '$project', '$wing', '$wbhk', 'Restore', '$encUser', '$encId', '', '', '');";
  $result = mysqli_query($con, $queryB);
echo 5;

$myitem = explode("@",$itemdata);
for ($x = 0; $x <= count($myitem); $x++) {
 $item = json_decode($myitem[$x],true);
 if(count($myitem)!=0)
 {
 $itemname2 =$item["item"];
 if(2==2)
 {
 $itemname =$item["item"];
$quantity =$item["quantity"];
$unit =$item["unit"];

$req1y = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$wname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk'";
$reqRy = mysqli_query($con, $req1y);
$resultyy =mysqli_fetch_assoc($reqRy);

$wid =$resultyy["id"];

$req1 = "SELECT * FROM `AAitem` WHERE `user`='$encUser' and `itemname`='$itemname' and `project`='$project' and `wing`='$wing' and `bhk`='$wbhk' and `ext1`='$wid'";
$reqR = mysqli_query($con, $req1);
if (mysqli_num_rows($reqR ) > 0)
{
$gx =0;
}
else
{


  $queryB="INSERT INTO `AAitem` (`itemname`, `qty`, `unit`, `project`, `wing`, `bhk`, `role`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$itemname', '$quantity', '$unit', '$project', '$wing', '$wbhk', 'Restore', '$encUser', '$encId', '$wid', '', '');";
  $result = mysqli_query($con, $queryB);
  
  $queryBm="DELETE FROM `AAitem` WHERE `itemname`=''";
  $resultm = mysqli_query($con, $queryBm);
  
}
}}}

$find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work FROM AAproject, AAWing, AABhk, AAWorkitem WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$wbhk' and AAWorkitem.id='$wname'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $workname =$rowfind["work"];
  
  $Adescription ="work added";
  $Atitle = "Project ".$pname." ".$wingname." ".$bhkname. "<br> name : ".$workname."<br>Sqft : ".$wsqft."<br>Rate : ".$wrate."<br>work added done";
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