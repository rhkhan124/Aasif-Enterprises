
<?php
require_once("con.php");


 $id =$_GET["id"];
 $user =$_GET["user"];
 $token =$_GET["token"];

 $empid =$_GET["empid"];
 $empdate =$_GET["date2"];
 $empremarks =$_GET["remark2"];
 $empamount =$_GET["amount2"];
 $empuid =$_GET["uid"];
 $myreq =$_GET["req"];
 
 

//$newdate =explode("/",$empdate);
//$empdate =$newdate[2]."-".$newdate[1]."-".$newdate[0];

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

if($myreq=="AAPaid")
{
$myreq ="AAPaid";
}
else
{
$myreq ="AASalary";
}


$sql3= "DELETE FROM `$myreq` WHERE `id` = '$empuid'";
$result3 = mysqli_query($con, $sql3);
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
  $focus =$rowfind["name"];
  $myreq2 ="";
  if($myreq=="AAPaid")
  {
  $myreq2 ="Paid out";
  }
  else
  {
  $myreq2 ="Salary";
  }
  //$newdate =explode("-",$empdate);
  //$empdate =$newdate[2]."/".$newdate[1]."/".$newdate[0];
  
  
    $Adescription ='<p style="color:red;">'.$myreq2.' deleted ref id -'.$empuid.'</p>';
    $Atitle = "<b>".$focus."</b> ".$myreq2. " deleted done <br> Date : ".$empdate." Amount : ".$empamount." Remarks : ".$empremarks;
    $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="money";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$empuid;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);











}
else
{
if ($active=="active")
{
$check=0;
$check2=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==21)
{
$check =1;
}
if($permissionA[$x]==22)
{
$check2 =1;
}
}
if($check==1)
{
if($myreq=="AAPaid")
{
$myreq ="AAPaid";

$sql3= "DELETE FROM `$myreq` WHERE `id` = '$empuid'";
$result3 = mysqli_query($con, $sql3);
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
  $focus =$rowfind["name"];
  $myreq2 ="";
  if($myreq=="AAPaid")
  {
  $myreq2 ="Paid out";
  }
  else
  {
  $myreq2 ="Salary";
  }
  //$newdate =explode("-",$empdate);
  //$empdate =$newdate[2]."/".$newdate[1]."/".$newdate[0];
  
  
    $Adescription ='<p style="color:red;">'.$myreq2.' deleted ref id -'.$empuid.'</p>';
    $Atitle = "<b>".$focus."</b> ".$myreq2. " deleted done <br> Date : ".$empdate." Amount : ".$empamount." Remarks : ".$empremarks;
    $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="money";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$empuid;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);




}


}
else
{
echo 2;
}

if($check2==1)
{

if($myreq=="AAPaid")
{
$myreq ="AAPaid";
}
else
{
$myreq ="AASalary";
$sql3= "DELETE FROM `$myreq` WHERE `id` = '$empuid'";
$result3 = mysqli_query($con, $sql3);
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
  $focus =$rowfind["name"];
  $myreq2 ="";
  if($myreq=="AAPaid")
  {
  $myreq2 ="Paid out";
  }
  else
  {
  $myreq2 ="Salary";
  }
  //$newdate =explode("-",$empdate);
  //$empdate =$newdate[2]."/".$newdate[1]."/".$newdate[0];
  
  
    $Adescription ='<p style="color:red;">'.$myreq2.' deleted ref id -'.$empuid.'</p>';
  $Atitle = "<b>".$focus."</b> ".$myreq2. " deleted done <br> Date : ".$empdate." Amount : ".$empamount." Remarks : ".$empremarks;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="money";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$empuid;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);



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