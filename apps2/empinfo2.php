<?php
require_once("con.php");

$empid =$_GET["empid"];
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
$month=date('m');
$year=date('Y');

$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";


/*$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {


}
*/




$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
 $pid =$row1['project'];
 $userid =$row1['addedby'];
 
 $useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 
 
 
 
$sql8= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);

$sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_assoc($result9);

$empid =$row1['id'];

$sql10= "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `employee`='$empid'";
$result10 = mysqli_query($con, $sql10);
$row10 = mysqli_fetch_assoc($result10);


$sql12= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
$result12 = mysqli_query($con, $sql12);
$row12 =mysqli_fetch_assoc($result12);

$sql13= "SELECT * FROM `AAaccount` WHERE `user`='$encUser' and `empid`='$empid'";
$result13 = mysqli_query($con, $sql13);
$row13 =mysqli_fetch_assoc($result13);

$sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid' and `ext1`='true'";
$result15 = mysqli_query($con, $sql15);
$row15 =mysqli_fetch_assoc($result15);
$totalPaid = $row15["paid"];

$sql16 = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid' and `ext1`='true'";
$result16 = mysqli_query($con, $sql16);
$row16 =mysqli_fetch_assoc($result16);
$totalSalary = $row16["salary"];

$emptype =$row1['type'];
$monthAtt ="";
$totalAtt ="";
if($emptype!="Main")
{
$sql17 = "SELECT SUM(no) as att FROM `AAreport` WHERE `allemp`='$empid' and MONTH(date)='$month' and YEAR(date)='$year'";
$result17 = mysqli_query($con, $sql17);
$row17 =mysqli_fetch_assoc($result17);
$monthAtt = $row17["att"];

$sql18 = "SELECT SUM(no) as att FROM `AAreport` WHERE `allemp`='$empid'";
$result18 = mysqli_query($con, $sql18);
$row18 =mysqli_fetch_assoc($result18);
$totalAtt = $row18["att"];
}
else
{
$sql17 = "SELECT SUM(no) as att FROM `AAreport` WHERE `emp`='$empid' and MONTH(date)='$month' and YEAR(date)='$year'";
$result17 = mysqli_query($con, $sql17);
$row17 =mysqli_fetch_assoc($result17);
$monthAtt = $row17["att"];

$sql18 = "SELECT SUM(no) as att FROM `AAreport` WHERE `emp`='$empid'";
$result18 = mysqli_query($con, $sql18);
$row18 =mysqli_fetch_assoc($result18);
$totalAtt = $row18["att"];
}



$myJSON4 ="";

$sql14= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `ext1`='$empid' order by `role` ASC";
$result14 = mysqli_query($con, $sql14);
while ($row14 = mysqli_fetch_assoc($result14))
{
 $groupid =$row14['id'];
 $groupname =$row14['name'];
 $myObj2->groupid  = $groupid;
 $myObj2->groupname  = $groupname;
 $myObj2->role  =$row14['role'];
   
   
   
   
   $myJSON2 = json_encode($myObj2);
   $myJSON4 = $myJSON4.$myJSON2.'#';
 }

$aname =$row13['name'];
$abank =$row13['bank'];
$aaccount =$row13['account'];
$aifsc =$row13['ifsc'];
$atype =$row13['type'];
$abranch =$row13['branch'];
$aupi =$row13['upi'];




$empname =$row1['name'];
$empnick =$row1['nickname'];
$empdesination =$row1['desination'];
$empmobile =$row1['mobile'];
$empemail =$row1['email'];
$empproject=$row9['name'];
$empdob =$row1['dob'];
$empage =$row1['age'];
$emprdate =$row1['Rdate'];
$empissue =$row1['issue'];
$empexpire =$row1['expire'];
$emptype =$row1['type'];
$empaddeby =$row8['name'];


$father2 =$row12["father"];
$type2 =$row12["type"];
$number2 =$row12["number"];
$paddress2 =$row12["paddress"];
$laddress2 =$row12["laddress"];
$ename2 =$row12["ename"];
$econtact2 =$row12["econtact"];
$note2 =$row12["note"];
$doc =$row12["ext1"];

   $myObj->aname  = $aname;
   $myObj->abank  = $abank;
   $myObj->aaccount  = $aaccount;
   $myObj->aifsc  = $aifsc;
   $myObj->atype  = $atype;
   $myObj->abranch  = $abranch;
   $myObj->aupi  = $aupi;




   $myObj->father  = $father2;
   $myObj->type2  = $type2;
   $myObj->number  = $number2;
   $myObj->paddress  = $paddress2;
   $myObj->laddress  = $laddress2;
   $myObj->ename  = $ename2;
   $myObj->econtact  = $econtact2;
   $myObj->note  = $note2;
   $myObj->doc = $doc;

   $myObj->id  = $empid;
   $myObj->role  = $row1['role'];
   $myObj->name  = $empname;
   $myObj->group  = $myJSON4;
   $myObj->nick  = $empnick;
   $myObj->desination  = $empdesination;
   $myObj->mobile  = $empmobile;
   $myObj->email  = $empemail;
   $myObj->project  = $empproject;
   $myObj->dob  = $empdob;
   $myObj->age  = $empage;
   $myObj->registration  = $emprdate;
   $myObj->issue  = $empissue;
   $myObj->expire  = $empexpire;
   $myObj->type  = $emptype;
   $myObj->user  = $empaddeby;
   
   $myObj->attmonth  = $monthAtt;
   $myObj->atttotal  = $totalAtt;
   
   $myObj->paid  = $totalPaid;
   $myObj->salary  = $totalSalary;
   $myObj->available  = ($totalSalary-$totalPaid);
   
   $myObj->username  = $row10["mobile"];
   $myObj->userpass  = $row10["password"];
   $myObj->gpaid  = "false";
   $myObj->gsalary  = "false";
   
   $req1t = "SELECT * FROM `AApersalary` WHERE `user`='$encUser' and `name`='$empid'";
   $reqRt = mysqli_query($con, $req1t);
   if (mysqli_num_rows($reqRt ) > 0)
   {
   $salarydata = mysqli_fetch_assoc($reqRt);
   
   $myObj->rate  = $salarydata["amount"];
   $myObj->type3  = $salarydata["type"];
   
   }
   else
   {
   $myObj->rate  = "0.00";
   $myObj->type3  = "Not Set";
   }
   $myJSON = json_encode($myObj);
   
   echo $myJSON;
}



























?>