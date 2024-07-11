<?php
require_once("con.php");

 $filename8 =$_GET["filename"];
 $ftype = $_GET["type"];
 $position = $_GET["position"];
 $ref1 = $_GET["ref1"];
 $ref2 = $_GET["ref2"];
 $reqid = $_GET["reqid"];



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

function all($encUser,$ref1,$ref2,$reqid,$con,$filename8)
{
$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$reqid' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{
 $myid1 =$row1["id"];
 $myname1 =$row1["filename"].",";
 $mycodename1 =$row1["filecodename"].".".$row1["ext1"];
 $mytype1 =$row1["type"];
 $myposition1 =$row1["position"];
 $myref11 =$row1["ref1"];
 $myref21 =$row1["ref2"];
 $mydate1 =$row1["date"];
 $mytime1 =$row1["time"];
 $myuser1 =$row1["user"];
 $myextn1 =$row1["ext1"];
 if($mytype1=="folder")
 {
 $sql2= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid1' and `ref2`='$ref2'";
 $result2 = mysqli_query($con, $sql2);
 while($row2 = mysqli_fetch_assoc($result2))
 {
 $myid2 =$row2["id"];
 $myname2 =$row2["filename"]."@";
 $mycodename2 =$row2["filecodename"].".".$row2["ext1"];
 $mytype2 =$row2["type"];
 $myposition2 =$row2["position"];
 $myref12 =$row2["ref1"];
 $myref22 =$row2["ref2"];
 $mydate2 =$row2["date"];
 $mytime2 =$row2["time"];
 $myuser2 =$row2["user"];
 $myextn2 =$row2["ext1"];
 if($mytype2=="folder")
 {
 $sql3= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid2' and `ref2`='$ref2'";
 $result3 = mysqli_query($con, $sql3);
 while($row3 = mysqli_fetch_assoc($result3))
 {
 $myid3 =$row3["id"];
 $myname3 =$row3["filename"]."@";
 $mycodename3 =$row2["filecodename"].".".$row2["ext1"];
 $mytype3 =$row3["type"];
 $myposition3 =$row3["position"];
 $myref13 =$row3["ref1"];
 $myref23 =$row3["ref2"];
 $mydate3 =$row3["date"];
 $mytime3 =$row3["time"];
 $myuser3 =$row3["user"];
 $myextn3 =$row3["ext1"];
 if($mytype3=="folder")
 {
 $sql4= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid3' and `ref2`='$ref2'";
 $result4 = mysqli_query($con, $sql4);
 while($row4 = mysqli_fetch_assoc($result4))
 {
 $myid4 =$row4["id"];
 $myname4 =$row4["filename"]."@";
 $mycodename4 =$row4["filecodename"].".".$row4["ext1"];
 $mytype4 =$row4["type"];
 $myposition4 =$row4["position"];
 $myref14 =$row4["ref1"];
 $myref24 =$row4["ref2"];
 $mydate4 =$row4["date"];
 $mytime4 =$row4["time"];
 $myuser4 =$row4["user"];
 $myextn4 =$row4["ext1"];
if($mytype4=="folder")
 {
$sql5= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid4' and `ref2`='$ref2'";
 $result5 = mysqli_query($con, $sql5);
 while($row5 = mysqli_fetch_assoc($result5))
 {
 $myid5 =$row5["id"];
 $myname5 =$row5["filename"]."@";
 $mycodename5 =$row5["filecodename"].".".$row5["ext1"];
 $mytype5 =$row5["type"];
 $myposition5 =$row5["position"];
 $myref15 =$row5["ref1"];
 $myref25 =$row5["ref2"];
 $mydate5 =$row5["date"];
 $mytime5 =$row5["time"];
 $myuser5 =$row5["user"];
$myextn5 =$row5["ext1"];
$sql11= "DELETE FROM `AAfolder` WHERE `id`='$myid5'";
 $result11 = mysqli_query($con, $sql11);
 unlink("folder/$mycodename5");
 }
 }
 $sql10= "DELETE FROM `AAfolder` WHERE `id`='$myid4'";
 $result10 = mysqli_query($con, $sql10);
 unlink("folder/$mycodename4");
 }
 }
 $sql9= "DELETE FROM `AAfolder` WHERE `id`='$myid3'";
 $result9 = mysqli_query($con, $sql9);
 unlink("folder/$mycodename3");
 }
 }
 $sql8= "DELETE FROM `AAfolder` WHERE `id`='$myid2'";
 $result8 = mysqli_query($con, $sql8);
 unlink("folder/$mycodename2");
 }
 }
 $sql7= "DELETE FROM `AAfolder` WHERE `id`='$myid1'";
 $result7 = mysqli_query($con, $sql7);
 unlink("folder/$mycodename1");
}

$sql6= "DELETE FROM `AAfolder` WHERE `id`='$reqid'";
$result6 = mysqli_query($con, $sql6);
unlink("folder/$filename8");
}
all($encUser,$ref1,$ref2,$reqid,$con,$filename8);












}
else
{
if ($active=="active")
{
$check=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==11)
{
$check =1;
}
}
if($check==1)
{


function all($encUser,$ref1,$ref2,$reqid,$con,$filename8)
{
$sql1= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$reqid' and `ref2`='$ref2'";
$result1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{
 $myid1 =$row1["id"];
 $myname1 =$row1["filename"].",";
 $mycodename1 =$row1["filecodename"].".".$row1["ext1"];
 $mytype1 =$row1["type"];
 $myposition1 =$row1["position"];
 $myref11 =$row1["ref1"];
 $myref21 =$row1["ref2"];
 $mydate1 =$row1["date"];
 $mytime1 =$row1["time"];
 $myuser1 =$row1["user"];
 $myextn1 =$row1["ext1"];
 if($mytype1=="folder")
 {
 $sql2= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid1' and `ref2`='$ref2'";
 $result2 = mysqli_query($con, $sql2);
 while($row2 = mysqli_fetch_assoc($result2))
 {
 $myid2 =$row2["id"];
 $myname2 =$row2["filename"]."@";
 $mycodename2 =$row2["filecodename"].".".$row2["ext1"];
 $mytype2 =$row2["type"];
 $myposition2 =$row2["position"];
 $myref12 =$row2["ref1"];
 $myref22 =$row2["ref2"];
 $mydate2 =$row2["date"];
 $mytime2 =$row2["time"];
 $myuser2 =$row2["user"];
 $myextn2 =$row2["ext1"];
 if($mytype2=="folder")
 {
 $sql3= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid2' and `ref2`='$ref2'";
 $result3 = mysqli_query($con, $sql3);
 while($row3 = mysqli_fetch_assoc($result3))
 {
 $myid3 =$row3["id"];
 $myname3 =$row3["filename"]."@";
 $mycodename3 =$row2["filecodename"].".".$row2["ext1"];
 $mytype3 =$row3["type"];
 $myposition3 =$row3["position"];
 $myref13 =$row3["ref1"];
 $myref23 =$row3["ref2"];
 $mydate3 =$row3["date"];
 $mytime3 =$row3["time"];
 $myuser3 =$row3["user"];
 $myextn3 =$row3["ext1"];
 if($mytype3=="folder")
 {
 $sql4= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid3' and `ref2`='$ref2'";
 $result4 = mysqli_query($con, $sql4);
 while($row4 = mysqli_fetch_assoc($result4))
 {
 $myid4 =$row4["id"];
 $myname4 =$row4["filename"]."@";
 $mycodename4 =$row4["filecodename"].".".$row4["ext1"];
 $mytype4 =$row4["type"];
 $myposition4 =$row4["position"];
 $myref14 =$row4["ref1"];
 $myref24 =$row4["ref2"];
 $mydate4 =$row4["date"];
 $mytime4 =$row4["time"];
 $myuser4 =$row4["user"];
 $myextn4 =$row4["ext1"];
if($mytype4=="folder")
 {
$sql5= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ref1`='$myid4' and `ref2`='$ref2'";
 $result5 = mysqli_query($con, $sql5);
 while($row5 = mysqli_fetch_assoc($result5))
 {
 $myid5 =$row5["id"];
 $myname5 =$row5["filename"]."@";
 $mycodename5 =$row5["filecodename"].".".$row5["ext1"];
 $mytype5 =$row5["type"];
 $myposition5 =$row5["position"];
 $myref15 =$row5["ref1"];
 $myref25 =$row5["ref2"];
 $mydate5 =$row5["date"];
 $mytime5 =$row5["time"];
 $myuser5 =$row5["user"];
$myextn5 =$row5["ext1"];
$sql11= "DELETE FROM `AAfolder` WHERE `id`='$myid5'";
 $result11 = mysqli_query($con, $sql11);
 unlink("folder/$mycodename5");
 }
 }
 $sql10= "DELETE FROM `AAfolder` WHERE `id`='$myid4'";
 $result10 = mysqli_query($con, $sql10);
 unlink("folder/$mycodename4");
 }
 }
 $sql9= "DELETE FROM `AAfolder` WHERE `id`='$myid3'";
 $result9 = mysqli_query($con, $sql9);
 unlink("folder/$mycodename3");
 }
 }
 $sql8= "DELETE FROM `AAfolder` WHERE `id`='$myid2'";
 $result8 = mysqli_query($con, $sql8);
 unlink("folder/$mycodename2");
 }
 }
 $sql7= "DELETE FROM `AAfolder` WHERE `id`='$myid1'";
 $result7 = mysqli_query($con, $sql7);
 unlink("folder/$mycodename1");
}

$sql6= "DELETE FROM `AAfolder` WHERE `id`='$reqid'";
$result6 = mysqli_query($con, $sql6);
unlink("folder/$filename8");
}
all($encUser,$ref1,$ref2,$reqid,$con,$filename8);






























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