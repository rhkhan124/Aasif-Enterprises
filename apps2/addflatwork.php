
<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project = $_GET["project"];
$wing = $_GET["wing"];
$flatworkid = $_GET["flatworkid"];
$bhk = $_GET["bhk"];
$flat = $_GET["flat"];
$work = $_GET["work"];
$sqft = $_GET["sqft"];
$rate = $_GET["rate"];
$name = $_GET["name"];
$hold = $_GET["hold"];
$payment = $_GET["payment"];
$remark = $_GET["remark"];


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
$date2=date('d/m/Y');
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
$amount = 0;
if($payment=="true")
{
$amount = ($sqft*$rate)/100*(100-$hold);
}
else
{
$amount = 0;
}

$sql9= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
 $result9 = mysqli_query($con, $sql9);
 if(mysqli_num_rows($result9)>0)
{
$req7 = "UPDATE `AAFlatwork` SET `emp` = '$name', `sqft` = '$sqft', `remark` = '$remark', `rate` = '$rate', `hold` = '$hold', `amount` = '$amount', `status` = '$payment', `date` = '$date', `addedby` = '$encId' WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
$run7 = mysqli_query($con, $req7);
}
else
{
$req1 = "INSERT INTO `AAFlatwork` (`project`, `wing`, `bhk`, `flat`, `work`, `emp`, `sqft`, `remark`, `rate`, `hold`, `amount`, `status`, `lock`, `date`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$bhk', '$flat', '$work', '$name', '$sqft', '$remark', '$rate', '$hold', '$amount', '$payment', 'Unlock', '$date', '$encUser', '$encId', '$date', '', '');";
$run1 = mysqli_query($con, $req1);
}

$find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work, AAemployees.name employee FROM AAproject, AAWing, AABhk, AAWorkitem, AAemployees WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$bhk' and AAWorkitem.id='$work' and AAemployees.id='$name'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $workname =$rowfind["work"];
  $empname =$rowfind["employee"];
  
  $sql8= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
  $result8 = mysqli_query($con, $sql8);
  $row8 = mysqli_fetch_assoc($result8);
  $newid =$row8['id'];
  
echo $responce ='{"name":"'.$empname.'","date":"'.$date2.'","id":"'.$newid.'"}';
     $myref = $project.$wing.$bhk.$flat.$work;
     $myremark = $flat." ".$bhkname." ".$wingname." ".$pname." for the work ".$workname;

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  
  
  $Adescription ="work updated";
  $Atitle =$empname. " work updated for the <br>".$workname." ".$flat." ".$wingname." ".$pname;
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
  


$sql3= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `find`='$myref'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$salaryref =$row3['find'];

if($myref==$salaryref)
{
if($payment=="true")
{
$sql5= "UPDATE `AASalary` SET `name`='$name', `date` = '$date', `remarks` = '$myremark', `amount` = '$amount' WHERE `find` = '$myref'";
$result5 = mysqli_query($con, $sql5);
}
else
{
$sql6= "DELETE FROM `AASalary` WHERE `find` = '$myref'";
$result6 = mysqli_query($con, $sql6);
}
}
else
{
if($payment=="true")
{
$sql2= "INSERT INTO `AASalary` (`name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES ('$name', '$date', '$myremark', '$amount', '$date', '$time', 'Restore', '$project', '$myref', '', '$encUser', '$encId', '', '', '', '')";
$result2 = mysqli_query($con, $sql2);
}
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

$amount = 0;
if($payment=="true")
{
$amount = ($sqft*$rate)/100*(100-$hold);
}
else
{
$amount = 0;
}

$sql9= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
 $result9 = mysqli_query($con, $sql9);
 if(mysqli_num_rows($result9)>0)
{
$req7 = "UPDATE `AAFlatwork` SET `emp` = '$name', `sqft` = '$sqft', `remark` = '$remark', `rate` = '$rate', `hold` = '$hold', `amount` = '$amount', `status` = '$payment', `date` = '$date', `addedby` = '$encId', `ext3`='1' WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
$run7 = mysqli_query($con, $req7);
}
else
{
$req1 = "INSERT INTO `AAFlatwork` (`project`, `wing`, `bhk`, `flat`, `work`, `emp`, `sqft`, `remark`, `rate`, `hold`, `amount`, `status`, `lock`, `date`, `user`, `addedby`, `ext1`, `ext2`, `ext3`) VALUES ('$project', '$wing', '$bhk', '$flat', '$work', '$name', '$sqft', '$remark', '$rate', '$hold', '$amount', '$payment', 'Unlock', '$date', '$encUser', '$encId', '$date', '', '1');";
$run1 = mysqli_query($con, $req1);
}

$find = "SELECT AAproject.name pname, AAWing.wing wing, AABhk.bhk bhk, AAWorkitem.name work, AAemployees.name employee FROM AAproject, AAWing, AABhk, AAWorkitem, AAemployees WHERE AAproject.id='$project' and AAWing.id='$wing' and AABhk.id='$bhk' and AAWorkitem.id='$work' and AAemployees.id='$name'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $pname =$rowfind["pname"];
  $wingname =$rowfind["wing"];
  $bhkname =$rowfind["bhk"];
  $workname =$rowfind["work"];
  $empname =$rowfind["employee"];
  
  $sql8= "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `flat`='$flat' and `work`='$work'";
  $result8 = mysqli_query($con, $sql8);
  $row8 = mysqli_fetch_assoc($result8);
  $newid =$row8['id'];
  
echo $responce ='{"name":"'.$empname.'","date":"'.$date2.'","id":"'.$newid.'"}';
     $myref = $project.$wing.$bhk.$flat.$work;
     $myremark = $flat." ".$bhkname." ".$wingname." ".$pname." for the work ".$workname;

$alluser ="";
  $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2 = mysqli_query($con, $sqlmobile2);
  while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
  {
  $alluser = $alluser.$rowe3d['id'].",";
  }
  
  
  
  $Adescription =" work updated";
  $Atitle =$empname. " work updated for the <br>".$workname." ".$flat." ".$wingname." ".$pname;
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
  


$sql3= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `find`='$myref'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$salaryref =$row3['find'];

if($myref==$salaryref)
{
if($payment=="true")
{
$sql5= "UPDATE `AASalary` SET `name`='$name', `date` = '$date', `remarks` = '$myremark', `amount` = '$amount' WHERE `find` = '$myref'";
$result5 = mysqli_query($con, $sql5);
}
else
{
$sql6= "DELETE FROM `AASalary` WHERE `find` = '$myref'";
$result6 = mysqli_query($con, $sql6);
}
}
else
{
if($payment=="true")
{
$sql2= "INSERT INTO `AASalary` (`name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES ('$name', '$date', '$myremark', '$amount', '$date', '$time', 'Restore', '$project', '$myref', '', '$encUser', '$encId', '', '', '', '')";
$result2 = mysqli_query($con, $sql2);
}
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