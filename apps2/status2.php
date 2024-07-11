
<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$empid =$_GET["empid"];

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



    $req1xabf = "SELECT SUM(amount) as data1 FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' and `ext1`='true'";
    $reqRxabf = mysqli_query($con, $req1xabf);
    $resutAabf =mysqli_fetch_assoc($reqRxabf);
    
    $data1 = $resutAabf["data1"];
    
    $req1xabfd = "SELECT SUM(amount) as data2 FROM `AASalary` WHERE `user`='$encUser' and `name`='$empid' and `ext1`='true'";
    $reqRxabfd = mysqli_query($con, $req1xabfd);
    $resutAabfd =mysqli_fetch_assoc($reqRxabfd);
    
    $data2 = $resutAabfd["data2"];
    $data3 = $data2-$data1;
    
    $req1xabfp = "SELECT SUM(amount) as data4 FROM `AAPaid` WHERE `user`='$encUser' and `ex2`='$empid'";
    $reqRxabfp = mysqli_query($con, $req1xabfp);
    $resutAabfp =mysqli_fetch_assoc($reqRxabfp);
    
    $data4 = $resutAabfp["data4"];

    $req2 = "SELECT SUM(amount) as data5 FROM `AASalary` WHERE `user`='$encUser' and `ex2`='$empid'";
    $run2 = mysqli_query($con, $req2);
    $result2 =mysqli_fetch_assoc($run2);
    
    $data5 = $result2["data5"];
    $data6 = $data5-$data4;
    
    $data7 = $data3-$data6;
    if(strlen($data1)==0)
    {
    $data1="00";
    }
    if(strlen($data2)==0)
    {
    $data2="00";
    }
    if(strlen($data3)==0)
    {
    $data3="00";
    }
    if(strlen($data4)==0)
    {
    $data4="00";
    }
    if(strlen($data5)==0)
    {
    $data5="00";
    }
    if(strlen($data6)==0)
    {
    $data6="00";
    }
    if(strlen($data7)==0)
    {
    $data7="00";
    }

  $myObj->data1  = $data1;
  $myObj->data2  = $data2;
  $myObj->data3  = $data3;
  $myObj->data4  = $data4;
  $myObj->data5  = $data5;
  $myObj->data6  = $data6;
  $myObj->data7  = $data7;
  $myJSON = json_encode($myObj);
  
  echo $myJSON;








}

/// encryption


?>





