<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["project"];
$wing =$_GET["wing"];
$flat =$_GET["flat"];
$work =$_GET["work"];




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
if($type=="main")
{


   $req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `work`='$work' GROUP BY `date`, `emp`, `remark` ORDER BY `date` DESC";
   $run1 = mysqli_query($con, $req1);
   while( $result1 = mysqli_fetch_assoc($run1))
   {
   $tid = $result1["id"];
   $empid = $result1["emp"];
   $date2 = $result1["date"];
   $remark = $result1["remark"];
   $workid = $result1["work"];
   $wingid = $result1["wing"];
   $projectid = $result1["project"];
   $flat = $result1["flat"];
   $time2 = $result1["time"];
   
   
   echo '<table border="1" class="mycontainer F10" style="width:96%;margin:2%;"><tr>
   <td colspan="2">date</td>
   <td style="text-align:center;" >'.$date2.' '.$time2.'</td>
   </tr>';
   
   
   $req5 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2' and `remark`='$remark' and `work`='$workid' and `flat`='$flat'";
   $run5 = mysqli_query($con, $req5);
   while($result5 = mysqli_fetch_assoc($run5))
   {
   
   $mygemp = $result5["allemp"];
   $rid = $result5["id"];
   $no = $result5["no"];
   
   $req4 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$mygemp'";
   $run4 = mysqli_query($con, $req4);
   $result4 = mysqli_fetch_assoc($run4);
   
   $mygname = $result4["name"];
   $mason = $result5["ext1"];
   echo '<tr>
   <td>'.$mygname.'</td><td style="text-align:center;">'.$no.'</td>
   <td style="text-align:center;">'.$mason.'</td></tr>';
   }
   
   echo '<tr>
   <td colspan="3">'.$remark.'</td>
   </tr></table>';
   
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
if(30==30)
{
$check =1;
}
}

$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `work`='$work' GROUP BY `date`, `emp`, `remark` ORDER BY `date` DESC";
   $run1 = mysqli_query($con, $req1);
   while( $result1 = mysqli_fetch_assoc($run1))
   {
   $tid = $result1["id"];
   $empid = $result1["emp"];
   $date2 = $result1["date"];
   $remark = $result1["remark"];
   $workid = $result1["work"];
   $wingid = $result1["wing"];
   $projectid = $result1["project"];
   $flat = $result1["flat"];
   $time2 = $result1["time"];
   
   
   echo '<table border="1" class="mycontainer F10" style="width:96%;margin:2%;"><tr>
   <td colspan="2">date</td>
   <td style="text-align:center;" >'.$date2.' '.$time2.'</td>
   </tr>';
   
   
   $req5 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2' and `remark`='$remark' and `work`='$workid' and `flat`='$flat'";
   $run5 = mysqli_query($con, $req5);
   while($result5 = mysqli_fetch_assoc($run5))
   {
   
   $mygemp = $result5["allemp"];
   $rid = $result5["id"];
   $no = $result5["no"];
   
   $req4 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$mygemp'";
   $run4 = mysqli_query($con, $req4);
   $result4 = mysqli_fetch_assoc($run4);
   
   $mygname = $result4["name"];
   $mason = $result5["ext1"];
   echo '<tr>
   <td>'.$mygname.'</td><td style="text-align:center;">'.$no.'</td>
   <td style="text-align:center;">'.$mason.'</td></tr>';
   }
   
   echo '<tr>
   <td colspan="3">'.$remark.'</td>
   </tr></table>';
   
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

