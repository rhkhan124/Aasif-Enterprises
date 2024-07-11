<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$cordinate =$_GET["location"];


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


function distance($lat1, $lon1, $lat2, $lon2) 
{
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  return (round(($miles * 1.609344*1000),0));
}

$locarray2 = explode(",",$cordinate);
$lat2 =trim($locarray2[0]);
$lon2 =trim($locarray2[1]);

$dis =0;

 
 





$sql10= "SELECT * FROM `AAproject` WHERE `user`='$encUser'";
$result10 = mysqli_query($con, $sql10);
while ($row10 = mysqli_fetch_assoc($result10))
{
$location =$row10['location'];
$locarray = explode(",",$location);
$lat1 =trim($locarray[0]);
$lon1 =trim($locarray[1]);
$projectid =$row10['id'];

 $dis = distance($lat1, $lon1, $lat2, $lon2);
 $myObj3->dis  = $dis; 
 $myObj3->pid = $row10['id'];
 
 $json[] = array("pid"=>$row10['id'], "distance"=>$dis);
}
$json2=json_encode($json);

   $jsonArray = json_decode($json2, true);
   usort($jsonArray, function($a, $b){return $a['distance'] - $b['distance'];});
   $arr= json_encode($jsonArray);
   $arr2 = json_decode($arr, true);
   foreach($arr2 as $item) {
   
   $prid =$item["pid"];
   $distance2=$item["distance"];
   
  
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='Restore' and `project`='$prid' ORDER BY name ASC";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
$pid =$row1['project'];
$sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_assoc($result9);
$empid =$row1['id'];
$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' ORDER BY `date` DESC";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);

$lastdate = $row8['date'];

$days = (strtotime($date) - strtotime($lastdate)) / (60 * 60 * 24);
   if($days>=0 && $days <= 10)
   {
   $days =$days*10;
   $days =100-$days;
   }
   else
   {
   $days =0;
   }

   $projectn =$row9['name'];
   $myObj->id  = $row1['id'];
   $myObj->name  = $row1['name'];

   $myObj->project  = $projectn;
   $myObj->nick  = $row1['nickname'];
   $d=strtotime($row8['date']);
   $myObj->date  = date("d/m/Y", $d); 
   $myObj->amount = $row8['amount'];
   $myObj->day = $days;
   
   $myJSON = json_encode($myObj);
   echo $myJSON."@";
   
   
   

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



function distance($lat1, $lon1, $lat2, $lon2) 
{
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  return (round(($miles * 1.609344*1000),0));
}

$locarray2 = explode(",",$cordinate);
$lat2 =trim($locarray2[0]);
$lon2 =trim($locarray2[1]);

$dis =0;

 
 





$sql10= "SELECT * FROM `AAproject` WHERE `user`='$encUser'";
$result10 = mysqli_query($con, $sql10);
while ($row10 = mysqli_fetch_assoc($result10))
{
$location =$row10['location'];
$locarray = explode(",",$location);
$lat1 =trim($locarray[0]);
$lon1 =trim($locarray[1]);
$projectid =$row10['id'];

 $dis = distance($lat1, $lon1, $lat2, $lon2);
 $myObj3->dis  = $dis; 
 $myObj3->pid = $row10['id'];
 
 $json[] = array("pid"=>$row10['id'], "distance"=>$dis);
}
$json2=json_encode($json);

   $jsonArray = json_decode($json2, true);
   usort($jsonArray, function($a, $b){return $a['distance'] - $b['distance'];});
   $arr= json_encode($jsonArray);
   $arr2 = json_decode($arr, true);
   foreach($arr2 as $item) {
   
   $prid =$item["pid"];
   $distance2=$item["distance"];
   
  
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='Restore' and `project`='$prid' ORDER BY name ASC";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
$pid =$row1['project'];
$sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_assoc($result9);
$empid =$row1['id'];
$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' ORDER BY `date` DESC";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);

$lastdate = $row8['date'];

$days = (strtotime($date) - strtotime($lastdate)) / (60 * 60 * 24);
   if($days>=0 && $days <= 10)
   {
   $days =$days*10;
   $days =100-$days;
   }
   else
   {
   $days =0;
   }

   $projectn =$row9['name'];
   $myObj->id  = $row1['id'];
   $myObj->name  = $row1['name'];

   $myObj->project  = $projectn;
   $myObj->nick  = $row1['nickname'];
   $d=strtotime($row8['date']);
   $myObj->date  = date("d/m/Y", $d); 
   $myObj->amount = $row8['amount'];
   $myObj->day = $days;
   
   $myJSON = json_encode($myObj);
   echo $myJSON."@";
   
   
   

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