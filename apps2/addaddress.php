<?php
require_once("con.php");


$empid =$_GET["empid"];
$father =$_GET["father"];
$type3 =$_GET["type"];
$number =$_GET["number"];
$paddress =$_GET["paddress"];
$laddress =$_GET["laddress"];
$econtact =$_GET["econtact"];
$ename =$_GET["ename"];
$note =$_GET["note"];





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

$sql1= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAaddress`(`name`, `father`, `type`, `number`, `paddress`, `laddress`, `ename`, `econtact`, `note`, `user`, `addedby`, `updateby`, `ext1`, `ext2`, `ext3`, `date`) VALUES ('$empid','$father','$type3','$number','$paddress','$laddress','$ename','$econtact','$note','$encUser','$encId','False','','','','$date')";
$result2 = mysqli_query($con, $sql2);
echo 5;

/// notification started

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$decId' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  $Adescription =" Address added";
  $Atitle ="Employee " .$empname." address updated done";
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
  
  //notification area end



}
else
{

$row1 =mysqli_fetch_assoc($result1);

$father2 =$row1["father"];
$type2 =$row1["type"];
$number2 =$row1["number"];
$paddress2 =$row1["paddress"];
$laddress2 =$row1["laddress"];
$ename2 =$row1["ename"];
$econtact2 =$row1["econtact"];
$note2 =$row1["note"];








$sql3= "UPDATE `AAaddress` SET `father` = '$father', `type` = '$type3', `number` = '$number', `paddress` = '$paddress', `laddress` = '$laddress', `ename` = '$ename', `econtact` = '$econtact', `note` = '$note', `updateby` = '$encId' WHERE `user`='$encUser' and `name`='$empid'";
$result3 = mysqli_query($con, $sql3);
echo 4;

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$decId' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  
  $Adescription =" Address updated";
  $Atitle ="Employee " .$focus." address updated done";
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
if($permissionA[$x]==13)
{
$check =1;
}
}


$sql1= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) == 0)
{

$sql2= "INSERT INTO `AAaddress`(`name`, `father`, `type`, `number`, `paddress`, `laddress`, `ename`, `econtact`, `note`, `user`, `addedby`, `updateby`, `ext1`, `ext2`, `ext3`, `date`) VALUES ('$empid','$father','$type3','$number','$paddress','$laddress','$ename','$econtact','$note','$encUser','$encId','False','','','','$date')";
$result2 = mysqli_query($con, $sql2);
echo 5;

/// notification started

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$decId' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  $Adescription =" Address added";
  $Atitle ="Employee " .$empname." address updated done";
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
  
  //notification area end



}
else
{

$row1 =mysqli_fetch_assoc($result1);

$father2 =$row1["father"];
$type2 =$row1["type"];
$number2 =$row1["number"];
$paddress2 =$row1["paddress"];
$laddress2 =$row1["laddress"];
$ename2 =$row1["ename"];
$econtact2 =$row1["econtact"];
$note2 =$row1["note"];





if($check==1)
{


$sql3= "UPDATE `AAaddress` SET `father` = '$father', `type` = '$type3', `number` = '$number', `paddress` = '$paddress', `laddress` = '$laddress', `ename` = '$ename', `econtact` = '$econtact', `note` = '$note', `updateby` = '$encId' WHERE `user`='$encUser' and `name`='$empid'";
$result3 = mysqli_query($con, $sql3);
echo 4;

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$decId' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  
  $Adescription =" Address updated";
  $Atitle ="Employee " .$focus." address updated done";
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
  
  //notification area end
}
else
{
echo 3;
}

}
































}
else
{
echo 2;
}
}
}

/// encryption


?>