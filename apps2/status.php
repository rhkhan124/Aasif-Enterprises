
<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$sqle2lg = "SELECT * FROM `Dates`";
$resulte2lg = mysqli_query($con, $sqle2lg);
    while($rowe2lg = mysqli_fetch_assoc($resulte2lg)) {
    
	$Tdate = $rowe2lg["dates"] ;
		
	}



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
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{


    $req1xabf = "SELECT SUM(amount) as monthly FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' and MONTH(datetime) = MONTH(NOW()) AND YEAR(datetime) = YEAR(NOW()) ";
    $reqRxabf = mysqli_query($con, $req1xabf);
    $resutAabf =mysqli_fetch_assoc($reqRxabf);
    
    $allstockag = $resutAabf["monthly"];
    
    $req1xabfd = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' ";
    $reqRxabfd = mysqli_query($con, $req1xabfd);
    $resutAabfd =mysqli_fetch_assoc($reqRxabfd);
    
    $allstockagd = $resutAabfd["paid"];
    
    $req1xabfp = "SELECT SUM(amount) as ss FROM `AASalary` WHERE `user`='$encUser'  and `type`!='grp' ";
    $reqRxabfp = mysqli_query($con, $req1xabfp);
    $resutAabfp =mysqli_fetch_assoc($reqRxabfp);
    
    $allstockagp = $resutAabfp["ss"];

    $req2 = "SELECT SUM(amount) as weekly FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' AND `datetime` between '$Tdate' AND '$date'";
    $run2 = mysqli_query($con, $req2);
    $result2 =mysqli_fetch_assoc($run2);
    
    $weekly = $result2["weekly"];
    
    $req3 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' AND `role`='Restore'";
    $run3 = mysqli_query($con, $req3);
    $result3 =mysqli_num_rows($run3);
    
    $req4 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' AND `role`='1'";
    $run4 = mysqli_query($con, $req4);
    $result4 =mysqli_num_rows($run4);

  $myObj->paid  = $allstockagd;
  $myObj->salary  = $allstockagp;
  $myObj->monthly  = $allstockag;
  $myObj->employee  = $result3;
  $myObj->weekly  = $weekly;
  $myObj->project  = $result4;
  $myJSON = json_encode($myObj);
  
  echo $myJSON;







}
else
{
if ($active=="active")
{
$check1=0;
$check2=0;
$check3=0;
$check4=0;
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
}
$req1xabf = "SELECT SUM(amount) as monthly FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' and MONTH(datetime) = MONTH(NOW()) AND YEAR(datetime) = YEAR(NOW()) ";
    $reqRxabf = mysqli_query($con, $req1xabf);
    $resutAabf =mysqli_fetch_assoc($reqRxabf);
    
    $allstockag = $resutAabf["monthly"];
    
    $req1xabfd = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' ";
    $reqRxabfd = mysqli_query($con, $req1xabfd);
    $resutAabfd =mysqli_fetch_assoc($reqRxabfd);
    
    $allstockagd = $resutAabfd["paid"];
    
    $req1xabfp = "SELECT SUM(amount) as ss FROM `AASalary` WHERE `user`='$encUser'  and `type`!='grp' ";
    $reqRxabfp = mysqli_query($con, $req1xabfp);
    $resutAabfp =mysqli_fetch_assoc($reqRxabfp);
    
    $allstockagp = $resutAabfp["ss"];

    $req2 = "SELECT SUM(amount) as weekly FROM `AAPaid` WHERE `user`='$encUser' and `type`!='grp' AND `datetime` between '$Tdate' AND '$date'";
    $run2 = mysqli_query($con, $req2);
    $result2 =mysqli_fetch_assoc($run2);
    
    $weekly = $result2["weekly"];
    
    $req3 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' AND `role`='Restore'";
    $run3 = mysqli_query($con, $req3);
    $result3 =mysqli_num_rows($run3);
    
    $req4 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' AND `role`='1'";
    $run4 = mysqli_query($con, $req4);
    $result4 =mysqli_num_rows($run4);

  $myObj->paid  = $allstockagd;
  $myObj->salary  = $allstockagp;
  $myObj->monthly  = $allstockag;
  $myObj->employee  = $result3;
  $myObj->weekly  = $weekly;
  $myObj->project  = $result4;
  $myJSON = json_encode($myObj);
  
  echo $myJSON;















}
else
{
echo 3; //Temporary blocked
}
}
}

/// encryption


?>




