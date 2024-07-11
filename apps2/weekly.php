
<?php
require_once("con.php");

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
$date=date('Y-m-d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";

$sqle2lg = "SELECT * FROM `Dates`";
$resulte2lg = mysqli_query($con, $sqle2lg);
    while($rowe2lg = mysqli_fetch_assoc($resulte2lg)) {
    
	$Tdate = $rowe2lg["dates"] ;
		
	}


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



$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' AND `type`!='grp' AND `datetime` between '$Tdate' AND '$date' ORDER BY `name` DESC";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

 $userid =$row8['addedby'];
 $useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 $sql10= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
 $result10 = mysqli_query($con, $sql10);
 $row10 = mysqli_fetch_assoc($result10);
 
 $uname =$row10['name'];
 
 
 
   $x = $row8['id'];
   $empname  = $row1['name'];
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $ptime = $row8['time'];
   $d2 =strtotime($row8['datetime']);
   $empdatetime2  = date("d/m/Y", $d2); 
  $myObj->id  = $x;
  $myObj->name  = $empname;
  $myObj->empid  = $empid;
  $myObj->date1  = $empdate;
  $myObj->date2  = $empdatef;
  $myObj->amount  = $empamount;
  $myObj->remark  = $empremarks;
  $myObj->datetime  = $empdatetime2;
  $myObj->user  = $uname;
  $myObj->time  = $ptime;
  $myJSON = json_encode($myObj);
  
  echo $myJSON."@";
   
   
}












}
else
{
if ($active=="active")
{
$check1=0;
$check2=0;
$check3=0;
$check4=0;
$check5=0;
$check6=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==19)
{
$check1 =1; //update paid
}
if($permissionA[$x]==20)
{
$check2 =1; //update salary
}
if($permissionA[$x]==21)
{
$check3 =1; //delete paid
}
if($permissionA[$x]==22)
{
$check4 =1; //delete salary
}
if($permissionA[$x]==6)
{
$check5 =1; //delete salary
}
if($permissionA[$x]==7)
{
$check6 =1; //delete salary
}
}
$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' AND `type`!='grp' AND `datetime` between '$Tdate' AND '$date' ORDER BY `name` DESC";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

 $userid =$row8['addedby'];
 $useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 $sql10= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
 $result10 = mysqli_query($con, $sql10);
 $row10 = mysqli_fetch_assoc($result10);
 
 $uname =$row10['name'];
 
 
 
   $x = $row8['id'];
   $empname  = $row1['name'];
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $ptime = $row8['time'];
   $d2 =strtotime($row8['datetime']);
   $empdatetime2  = date("d/m/Y", $d2); 
  $myObj->id  = $x;
  $myObj->name  = $empname;
  $myObj->empid  = $empid;
  $myObj->date1  = $empdate;
  $myObj->date2  = $empdatef;
  $myObj->amount  = $empamount;
  $myObj->remark  = $empremarks;
  $myObj->datetime  = $empdatetime2;
  $myObj->user  = $uname;
  $myObj->time  = $ptime;
  $myJSON = json_encode($myObj);
  
  echo $myJSON."@";
   
   
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



  








