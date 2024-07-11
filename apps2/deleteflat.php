<?php
require_once("con.php");

 $wid =$_GET["wid"];
$fid =$_GET["fid"];


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

$req1 = "DELETE FROM `AAFlat` WHERE `user`='$encUser' and `id`='$fid' ";
 $run1 = mysqli_query($con, $req1);
 
 /*
$sql9= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `id`='$wid'";
 $result9 = mysqli_query($con, $sql9);
 $row9 = mysqli_fetch_assoc($result9);
 
 $project =$row9["project"];
 $wing =$row9["wing"];
 $bhk =$row9["bhk"];
 $flat =$row9["flat"];
 $work =$row9["work"];
 $emp =$row9["emp"];
 
 $sql8= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat'";
 $result8 = mysqli_query($con, $sql8);
 $row8 = mysqli_fetch_assoc($result8);
 
 $wid2 =$row8["id"];
 $project2 =$row8["project"];
 $wing2 =$row8["wing"];
 $bhk2 =$row8["bhk"];
 $flat2 =$row8["flat"];
 $work2 =$row8["work"];
 $emp2 =$row8["emp"];
 
 
 $req1 = "DELETE FROM `AAFlat` WHERE `user`='$encUser' and `id`='$fid' ";
 $run1 = mysqli_query($con, $req1);

$sql1c= "DELETE FROM `AAFlatwork` WHERE `user`='$encUser' and `id`='$wid2'";
$result1c = mysqli_query($con, $sql1c);

$myref = $project2.$wing2.$bhk2.$flat2.$work2;

$sql6= "DELETE FROM `AASalary` WHERE `find` = '$myref'";
$result6 = mysqli_query($con, $sql6);




$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work, AAemployees.name ename FROM AAproject, AAWing, AABhk, AAWorkitem, AAemployees WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$bhk' and AAWorkitem.id='$work' and AAemployees.id='$emp'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $mywork =$rowfind["work"];
  $empname =$rowfind["ename"];
  
  $Adescription =" ".$flat." deleted";
  $Atitle = $flat. " deleted from ".$wingname." ".$pname."<br>All data cleared";
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


*/




}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if(11==11)
{
$check =1;
}
}
if($check==1)
{

$req1 = "DELETE FROM `AAFlat` WHERE `user`='$encUser' and `id`='$fid' ";
 $run1 = mysqli_query($con, $req1);
 /*

$sql9= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `id`='$wid'";
 $result9 = mysqli_query($con, $sql9);
 $row9 = mysqli_fetch_assoc($result9);
 
 $project =$row9["project"];
 $wing =$row9["wing"];
 $bhk =$row9["bhk"];
 $flat =$row9["flat"];
 $work =$row9["work"];
 $emp =$row9["emp"];
 
 $sql8= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat'";
 $result8 = mysqli_query($con, $sql8);
while ( $row8 = mysqli_fetch_assoc($result8))
 {
 $wid2 =$row8["id"];
 $project2 =$row8["project"];
 $wing2 =$row8["wing"];
 $bhk2 =$row8["bhk"];
 $flat2 =$row8["flat"];
 $work2 =$row8["work"];
 $emp2 =$row8["emp"];
 
 
 $req1 = "DELETE FROM `AAFlat` WHERE `user`='$encUser' and `id`='$fid' ";
 $run1 = mysqli_query($con, $req1);

$sql1c= "DELETE FROM `AAFlatwork` WHERE `user`='$encUser' and `id`='$wid2'";
$result1c = mysqli_query($con, $sql1c);

$myref = $project2.$wing2.$bhk2.$flat2.$work2;

$sql6= "DELETE FROM `AASalary` WHERE `find` = '$myref'";
$result6 = mysqli_query($con, $sql6);

}


$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  $find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work, AAemployees.name ename FROM AAproject, AAWing, AABhk, AAWorkitem, AAemployees WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$bhk' and AAWorkitem.id='$work' and AAemployees.id='$emp'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $mywork =$rowfind["work"];
  $empname =$rowfind["ename"];
  
  $Adescription =" ".$flat." deleted";
  $Atitle = $flat. " deleted from ".$wingname." ".$pname."<br>All data cleared";
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










*/






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