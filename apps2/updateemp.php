<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empid =$_GET["empid"];
$empname =$_GET["name"];
$empnick =$_GET["nick"];
$empdesination =$_GET["desination"];
$empmobile =$_GET["mobile"];
$empemail =$_GET["email"];
$oldempmobile =$_GET["oldmobile"];
$oldempemail =$_GET["oldemail"];
$empdob =$_GET["dob"];
$empproject =$_GET["project"];

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


$empage = (date('Y') - date('Y',strtotime($empdob)));
    
$sql3= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result3 = mysqli_query($con, $sql3);
$row3= mysqli_fetch_assoc($result3);
$fetchmobile =$row3['mobile'];
$fetchemail =$row3['email'];



if($oldempmobile==$fetchmobile)
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
else if($empmobile==$fetchmobile)
{
echo 5;
}
else
{
if($oldempemail==$fetchemail)
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
else if($empemail==$fetchemail)
{
echo 4;
}
else
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
}


$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$empproject'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);
$fetchprojectname =$row8['name'];

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  
  $Adescription ="employee profile updated";
  $Atitle = $empname. " profile has been updated";
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
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==12)
{
$check =1;
}
}
if($role=="Employee")
{
$check =1;
}

if($check==1)
{


$empage = (date('Y') - date('Y',strtotime($empdob)));
    
$sql3= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result3 = mysqli_query($con, $sql3);
$row3= mysqli_fetch_assoc($result3);
$fetchmobile =$row3['mobile'];
$fetchemail =$row3['email'];



if($oldempmobile==$fetchmobile)
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
else if($empmobile==$fetchmobile)
{
echo 5;
}
else
{
if($oldempemail==$fetchemail)
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
else if($empemail==$fetchemail)
{
echo 4;
}
else
{
$req2 = "UPDATE `AAemployees` SET `name` = '$empname', `nickname` = '$empnick', `desination` = '$empdesination', `mobile` = '$empmobile', `email` = '$empemail', `dob` = '$empdob', `age` = '$empage', `project` = '$empproject' WHERE `AAemployees`.`id` = '$empid'";
$reqq2 = mysqli_query($con, $req2);
}
}


$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$empproject'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);
$fetchprojectname =$row8['name'];

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  $empname =$rowfind["name"];
  
  $Adescription ="employee profile updated";
  $Atitle = $empname. " profile has been updated";
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