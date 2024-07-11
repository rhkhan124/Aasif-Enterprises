<?php
require_once("con.php");

$uid =$_GET["uid"];
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



$sql1b= "SELECT * FROM `AAemployees` WHERE `user`='$encUser'";
   $result1b = mysqli_query($con, $sql1b);
   while ($row1b = mysqli_fetch_assoc($result1b))
   {
   $data1 ="";
   $data2 ="";
   $emptype =$row1b["type"];
   if($emptype =="Group employee")
   {
   $data1 ="grp";
   $data2 =$row1b["ext1"];
   
   }
   else
   {
   $data1 ="";
   $data2 ="";
   }
   $myemp =$row1b["id"];
   $pid=$row1b["project"];
   $req1 = "SELECT * FROM `AApersalary` WHERE `user`='$encUser' and `name`='$myemp' and `type`='Per day'";
   $reqR = mysqli_query($con, $req1);
   if (mysqli_num_rows($reqR ) > 0)
   {
   $row1bm = mysqli_fetch_assoc($reqR);
   $rate =$row1bm["amount"];
   
   $req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$myemp' group by month(date), year(date)";
   $run1 = mysqli_query($con, $req1);
   while( $responce =mysqli_fetch_array($run1))
   {
   $mydate = $responce["date"];
   
   $req2 = "SELECT SUM(no) AS att FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$myemp' and MONTH(date) = MONTH('$mydate') and YEAR(date) = YEAR('$mydate')";
   $run2 = mysqli_query($con, $req2);
   $responce2 =mysqli_fetch_array($run2);
   $total = $responce2["att"];
   $yrdata= strtotime($mydate);
   $mytext1 = date('F-Y', $yrdata);
   $amount = $rate*$total;
   $text2 = $mytext1." salary rate ".$rate." * ".$total. " days = ".$amount;
   
   $sql3y= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `name`='$myemp' and `find`='$mytext1'";
   $result3y = mysqli_query($con, $sql3y);
   if(mysqli_num_rows($result3y) > 0 )
   {
   $sql3h= "UPDATE `AASalary` SET `date` = '$date', `remarks` = '$text2', `amount` = '$amount', `updatedby` = '' WHERE `name` = '$myemp' and `find`='$mytext1'";
   $result3h = mysqli_query($con, $sql3h);
   
   }
   else
   {
  
   $sql2g= "INSERT INTO `AASalary` (`name`, `date`, `remarks`, `amount`, `datetime`, `time`, `role`, `project`, `find`, `type`, `user`, `addedby`, `updatedby`, `ext1`, `ex2`, `ext3`) VALUES ('$myemp', '$date', '$text2', '$amount', '$date', '$time', 'Restore', '$pid', '$mytext1', '$data1', '$encUser', '$encId', '', 'true', '$data2', '')";
   $result2g = mysqli_query($con, $sql2g);
   }
   
   
   
   
   }
   }
   
   
   
   }











if($type=="main")
{


//notification area start
 
 
 $alluser ="";
 $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
 $resultmobile2 = mysqli_query($con, $sqlmobile2);
 while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
 {
 $alluser = $alluser.$rowe3d['id'].",";
 }
 $qtype ="";
 $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' group by `type`";
 $resultfind = mysqli_query($con, $find);
 while($rowfind = mysqli_fetch_array($resultfind))
 {
  $qtype =$qtype.$rowfind["type"].",";
 
 }
 
 $ref1="false";
 $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref1`='1'";
 $resultref1 = mysqli_query($con, $qref1);
 while($rowref1 = mysqli_fetch_assoc($resultref1))
 {
 $ref1user =$rowref1["users"];
 $ref1array = explode(",",$ref1user);
 for ($x = 0; $x <= count($ref1array); $x++) 
 {
 if($ref1array[$x]==$uid)
 {
 $ref1 ="true";
 }
 }
 }
 if($ref1=="true")
 {
 $ref1="true";
 }
 else
 {
 $ref1="false";
 }
 
 
 $ref2="false";
 $qref2 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1'";
 $resultref2 = mysqli_query($con, $qref2);
 while($rowref2 = mysqli_fetch_assoc($resultref2))
 {
 $ref2user =$rowref2["users"];
 $ref2array = explode(",",$ref2user);
 for ($x = 0; $x <= count($ref2array); $x++) 
 {
 if($ref2array[$x]==$uid)
 {
 $ref2 ="true";
 }
 }
 }
 if($ref2=="true")
 {
 $ref2="true";
 }
 else
 {
 $ref2="false";
 }
 
 $ref1g="false";
 $qref1g = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' limit 200";
 $resultref1g = mysqli_query($con, $qref1g);
 while($rowref1g = mysqli_fetch_assoc($resultref1g))
 {
 $ref1userg =$rowref1g["notif"];
 $ref1id =$rowref1g["id"];
 $userarray ="";
 $ref1arrayg = explode(",",$ref1userg);
 for ($x = 0; $x <= count($ref1arrayg); $x++) 
 {
 if($ref1arrayg[$x]>3)
 {
 if($ref1arrayg[$x]==$uid)
 {
 $ref1g ="true";
 }
 }
 }
 }
 
 
 
 $myObj->ref1  = $ref1;
 $myObj->ref2  = $ref2;
 $myObj->ref3  = "";
 $myObj->ref4  = "";
 $myObj->ref5  = "";
 $myObj->ref6  = "";
 $myObj->ref7  = "";
 $myObj->noti  = $ref1g;
 $myObj->type  = $qtype;
 $myJSON = json_encode($myObj);
 
 echo $myJSON;
 
 
 
 
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
if(5==5)
{
$check =1;
}
}
if($check==1)
{
$alluser ="";
 $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser'";
 $resultmobile2 = mysqli_query($con, $sqlmobile2);
 while($rowe3d = mysqli_fetch_assoc($resultmobile2)) 
 {
 $alluser = $alluser.$rowe3d['id'].",";
 }
 $qtype ="";
 $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1' group by `type`";
 $resultfind = mysqli_query($con, $find);
 while($rowfind = mysqli_fetch_array($resultfind))
 {
  $qtype =$qtype.$rowfind["type"].",";
 
 }
 
 $ref1="false";
 $qref1 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref1`='1'";
 $resultref1 = mysqli_query($con, $qref1);
 while($rowref1 = mysqli_fetch_assoc($resultref1))
 {
 $ref1user =$rowref1["users"];
 $ref1array = explode(",",$ref1user);
 for ($x = 0; $x <= count($ref1array); $x++) 
 {
 if($ref1array[$x]==$uid)
 {
 $ref1 ="true";
 }
 }
 }
 if($ref1=="true")
 {
 $ref1="true";
 }
 else
 {
 $ref1="false";
 }
 
 
 $ref2="false";
 $qref2 = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `ref2`='1'";
 $resultref2 = mysqli_query($con, $qref2);
 while($rowref2 = mysqli_fetch_assoc($resultref2))
 {
 $ref2user =$rowref2["users"];
 $ref2array = explode(",",$ref2user);
 for ($x = 0; $x <= count($ref2array); $x++) 
 {
 if($ref2array[$x]==$uid)
 {
 $ref2 ="true";
 }
 }
 }
 if($ref2=="true")
 {
 $ref2="true";
 }
 else
 {
 $ref2="false";
 }
 
 $ref1g="false";
 $qref1g = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' limit 200";
 $resultref1g = mysqli_query($con, $qref1g);
 while($rowref1g = mysqli_fetch_assoc($resultref1g))
 {
 $ref1userg =$rowref1g["notif"];
 $ref1id =$rowref1g["id"];
 $userarray ="";
 $ref1arrayg = explode(",",$ref1userg);
 for ($x = 0; $x <= count($ref1arrayg); $x++) 
 {
 if($ref1arrayg[$x]>3)
 {
 if($ref1arrayg[$x]==$uid)
 {
 $ref1g ="true";
 }
 }
 }
 }
 
 
 
 $myObj->ref1  = $ref1;
 $myObj->ref2  = $ref2;
 $myObj->ref3  = "";
 $myObj->ref4  = "";
 $myObj->ref5  = "";
 $myObj->ref6  = "";
 $myObj->ref7  = "";
 $myObj->noti  = $ref1g;
 $myObj->type  = $qtype;
 $myJSON = json_encode($myObj);
 
 echo $myJSON;
 
 
 
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