
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$data =$_GET["data"];
$emp =$_GET["emp"];
$remark =$_GET["remark"];


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

$part = date('hi');

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

$alertdata ="";

$tokennumber = $emp.$project.$part;

$myitem = explode("@",$data);
for ($x = 0; $x <= count($myitem); $x++) {
 $item = json_decode($myitem[$x],true);
 
 $itemx =$item["item"];
$qty =$item["quantity"];
$unit =$item["unit"];


$req1xa = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$itemx'";
$reqRxa = mysqli_query($con, $req1xa);
$resutAa =mysqli_fetch_assoc($reqRxa);

$allstocka = $resutAa["allstock"];

$req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$itemx'";
$reqRxda = mysqli_query($con, $req1xda);
$resultBa = mysqli_fetch_assoc($reqRxda);
$allissuea = $resultBa["allissue"];

$dataB = $allstocka-$allissuea;

if($qty>$dataB)
{

  $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$itemx'";
  $resultfind2 = mysqli_query($con, $find2);
  $rowfind2 = mysqli_fetch_assoc($resultfind2);
  $itemname2 =$rowfind2["item"];
  
  echo $itemname2." can not be issue. please refresh and recheck stock \n";
 
 }
 else
 {
 $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$itemx'";
 $resultfind2 = mysqli_query($con, $find2);
 $rowfind2 = mysqli_fetch_assoc($resultfind2);
 $itemname2 =$rowfind2["item"];
  $alertdata =$alertdata.($itemname2." ".$qty." ".$unit."<br>");

$req1x = "INSERT INTO `AAissue` (`item`, `qty`, `unit`, `project`, `wing`, `flat`, `emp`, `date`, `verified`, `token`, `remark`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$itemx', '$qty', '$unit', '$project', '', '', '$emp', '$date', 'Not Verified', '$tokennumber', '$remark', '$encUser', '$encId', '', '', '')";
$reqRx = mysqli_query($con, $req1x);
}}
$req1xd = "DELETE FROM `AAissue` WHERE `qty`=''";
$reqRxd = mysqli_query($con, $req1xd);

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }

  $find = "SELECT AAproject.name pname, AAemployees.name empname FROM AAproject, AAemployees WHERE AAproject.id='$project' and AAemployees.id='$emp'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $empname =$rowfind["empname"];
  
  
  $Adescription ="issued material for ".$empname;
  $Atitle = "Project ".$pname."<br>".$alertdata;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="inventory";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area

























}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==29)
{
$check =1;
}
}
if($check==1)
{


$alertdata ="";

$tokennumber = $emp.$project.$part;

$myitem = explode("@",$data);
for ($x = 0; $x <= count($myitem); $x++) {
 $item = json_decode($myitem[$x],true);
 
 $itemx =$item["item"];
$qty =$item["quantity"];
$unit =$item["unit"];


$req1xa = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$itemx'";
$reqRxa = mysqli_query($con, $req1xa);
$resutAa =mysqli_fetch_assoc($reqRxa);

$allstocka = $resutAa["allstock"];

$req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$itemx'";
$reqRxda = mysqli_query($con, $req1xda);
$resultBa = mysqli_fetch_assoc($reqRxda);
$allissuea = $resultBa["allissue"];

$dataB = $allstocka-$allissuea;

if($qty>$dataB)
{

  $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$itemx'";
  $resultfind2 = mysqli_query($con, $find2);
  $rowfind2 = mysqli_fetch_assoc($resultfind2);
  $itemname2 =$rowfind2["item"];
  
  echo $itemname2." can not be issue. please refresh and recheck stock \n";
 
 }
 else
 {
 $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$itemx'";
 $resultfind2 = mysqli_query($con, $find2);
 $rowfind2 = mysqli_fetch_assoc($resultfind2);
 $itemname2 =$rowfind2["item"];
  $alertdata =$alertdata.($itemname2." ".$qty." ".$unit."<br>");

$req1x = "INSERT INTO `AAissue` (`item`, `qty`, `unit`, `project`, `wing`, `flat`, `emp`, `date`, `verified`, `token`, `remark`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$itemx', '$qty', '$unit', '$project', '', '', '$emp', '$date', 'Not Verified', '$tokennumber', '$remark', '$encUser', '$encId', '', '', '')";
$reqRx = mysqli_query($con, $req1x);
}}
$req1xd = "DELETE FROM `AAissue` WHERE `qty`=''";
$reqRxd = mysqli_query($con, $req1xd);

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }

  $find = "SELECT AAproject.name pname, AAemployees.name empname FROM AAproject, AAemployees WHERE AAproject.id='$project' and AAemployees.id='$emp'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $empname =$rowfind["empname"];
  
  
  $Adescription ="issued material for ".$empname;
  $Atitle = "Project ".$pname."<br>".$alertdata;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="inventory";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus ="";
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area

























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