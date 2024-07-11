<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["pid"];
$group =$_GET["wing"];
$emp =$_GET["emp"];
$company =$_GET["company"];




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
echo "*".$company."*\n\n";
$totalm =0;
$totalh=0;
$group2 = explode(",",$group);
for ($x = 0; $x <= count($group2); $x++) {
$gr = $group2[$x];
$mywing ="";
$wname ="";
$flat2 ="";
$remark2 ="";
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$gr' and `date`='$date' group by flat, work, remark";
$run1 = mysqli_query($con, $req1);
while ($result1 =mysqli_fetch_assoc($run1))
{
$wid = $result1["work"];
$flat = $result1["flat"];
$remark = $result1["remark"];



$req2 = "SELECT * FROM `AAWing` WHERE `user`='$encUser' and `project`='$project' and `id`='$gr'";
$run2 = mysqli_query($con, $req2);
$result2 = mysqli_fetch_assoc($run2);
if($mywing!=$result2["wing"])
{
echo $mywing = "*".$result2["wing"]."*\n";
$mywing = $result2["wing"];
}
$req3 = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$wid'";
$run3 = mysqli_query($con, $req3);
$result3 = mysqli_fetch_assoc($run3);

if($wname!=$result3["name"])
{
echo $wname = $result3["name"]."\n";
$wname = $result3["name"];
}

$req4 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$gr' and `date`='$date' and `flat`='$flat' and `work`='$wid' and `remark`='$remark' group by `ext1` DESC";
$run4 = mysqli_query($con, $req4);
while ( $result4 = mysqli_fetch_assoc($run4))
{
echo $ext1 = $result4["ext1"];
$req3 = "SELECT SUM(no) AS att FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$gr' and `date`='$date' and `flat`='$flat' and `work`='$wid' and `remark`='$remark' and `ext1`='$ext1'";
$run3 = mysqli_query($con, $req3);
$result3 = mysqli_fetch_assoc($run3);

if($result4["ext1"]=="Mason")
{
$totalm = $totalm+$result3["att"];
}
if($result4["ext1"]=="Helper")
{
$totalh = $totalh+$result3["att"];
}


echo $no ="(".$result3["att"].")\n";
}
if($flat2!=$result1["flat"])
{
echo "work in progress ".$result1["flat"]." ";
$flat2 = $result1["flat"];
}
if($remark2!=$result1["remark"])
{
echo $result1["remark"]."\n";
$remark2 = $result1["remark"];
}

}






}
if(($totalm+$totalh)!=0)
{
echo "\nTotal Mason = ". $totalm;
echo "\nTotal helper = ". $totalh;
echo "\nTotal Manpower = ". (+$totalm+$totalh);
}
}
/// encryption


?>