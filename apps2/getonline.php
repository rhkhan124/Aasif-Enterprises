
<?php
require_once("con.php");


 $id =$_GET["id"];
 $user =$_GET["user"];
 $token =$_GET["token"];
 $mymonth =$_GET["month"];

 

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

$req12 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `addedby`='$encId' and `month`='$mymonth' GROUP BY `date`";
$run12 = mysqli_query($con, $req12);
while($rows1 =mysqli_fetch_assoc($run12))
{
$date2 =$rows1["date"];
$project =$rows1["project"];
$device =$rows1["device"];

$req17 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `addedby`='$encId' and `date`='$date2' and `project`='$project' and `month`='$mymonth' and `type`='start'";
$run17 = mysqli_query($con, $req17);
$result17 = mysqli_fetch_assoc($run17);

if(mysqli_num_rows($run17)>0)
{
$start = $result17["time"];
$accuracy = $result17["accuracy"];
}
else
{
$start = "00.00";
$accuracy = "0";
}
$req2 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `addedby`='$encId' and `date`='$date2' and `project`='$project' and `month`='$mymonth' and `type`='end'";
$run2 = mysqli_query($con, $req2);
$result2 = mysqli_fetch_assoc($run2);

if(mysqli_num_rows($run2)>0)
{
$end = $result2["time"];
}
else
{
$end = "";
}

   $req8 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$project'";
   $run8 = mysqli_query($con, $req8);
   $result8 = mysqli_fetch_assoc($run8);
   
   $mygnameB = $result8["name"];


      $myObj->project  = $mygnameB;
      $myObj->date  = $date2;
      $myObj->accuracy  = $accuracy;
      
      $myObj->start  = $start;
      $myObj->end  = $end;
      $myObj->device  = $device;
      $myJSON = json_encode($myObj);
      
      echo $myJSON."@";


}
}

/// encryption


?>