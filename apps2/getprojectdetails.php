<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["project"];





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
$time =date("h:i:s A");
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
$req1 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$project'";
$run1 = mysqli_query($con, $req1);
$myemp = mysqli_fetch_assoc($run1);
$pid = $myemp["id"];
$pname = $myemp["name"];
$paddress = $myemp["address"];
$plocation = $myemp["location"];
$pacuracy = $myemp["accuracy"];

      $myObj->id  = $pid;
      $myObj->name  = $pname;
      $myObj->address  = $paddress;
      $myObj->location  = $plocation;
      $myObj->accuracy  = $pacuracy;
      $myObj->gwork  = "false";

    echo  $myJSON = json_encode($myObj)."@";

$req3 = "SELECT * FROM `AAWing` WHERE `project`='$pid'";
$run3 = mysqli_query($con, $req3);
while ($empresult3 = mysqli_fetch_assoc($run3))
{
$wingid = $empresult3["id"];
$wingname = $empresult3["wing"];

      $myObj->id  = $wingid;
      $myObj->name  = $wingname;
      $myObj->address  = "";
      $myObj->location  ="";
      $myObj->accuracy  ="";
      $myObj->gwork  = "false";

    echo  $myJSON = json_encode($myObj)."@";

       

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
if($permissionA[$x]==31)
{
$check =1;
}
}
$gwork ="false";
if($check==1)
{
$gwork ="false";
}
else
{
$gwork ="true";
}

$req1 = "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$project'";
$run1 = mysqli_query($con, $req1);
$myemp = mysqli_fetch_assoc($run1);
$pid = $myemp["id"];
$pname = $myemp["name"];
$paddress = $myemp["address"];
$plocation = $myemp["location"];
$pacuracy = $myemp["accuracy"];

      $myObj->id  = $pid;
      $myObj->name  = $pname;
      $myObj->address  = $paddress;
      $myObj->location  = $plocation;
      $myObj->accuracy  = $pacuracy;
      $myObj->gwork  = $gwork;

    echo  $myJSON = json_encode($myObj)."@";

$req3 = "SELECT * FROM `AAWing` WHERE `project`='$pid'";
$run3 = mysqli_query($con, $req3);
while ($empresult3 = mysqli_fetch_assoc($run3))
{
$wingid = $empresult3["id"];
$wingname = $empresult3["wing"];

      $myObj->id  = $wingid;
      $myObj->name  = $wingname;
      $myObj->address  = "";
      $myObj->location  ="";
      $myObj->accuracy  ="";
      $myObj->gwork  = $gwork;

    echo  $myJSON = json_encode($myObj)."@";

       

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