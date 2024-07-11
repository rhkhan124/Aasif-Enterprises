<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empname =$_GET["name"];
$empnick =$_GET["nick"];
$empdesination =$_GET["desination"];
$empmobile =$_GET["mobile"];
$empemail =$_GET["email"];
$empdob =$_GET["dob"];
$empproject =$_GET["project"];

$empid =$_GET["empid"];
$empgroup =$_GET["group"];

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
$expire=date("Y-m-d", strtotime("+180 days"));

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


$empage = (date('Y') - date('Y',strtotime($empdob)));
    
$sql3= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `mobile`='$empmobile'";
$result3 = mysqli_query($con, $sql3);
$row3= mysqli_fetch_assoc($result3);
$fetchmobile =$row3['mobile'];

$sql4= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `email`='$empemail'";
$result4 = mysqli_query($con, $sql4);
$row4= mysqli_fetch_assoc($result4);
$fetchemail =$row4['email'];

$sql5 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `name`='$empname'";
$result5 = mysqli_query($con, $sql5);
$row5= mysqli_fetch_assoc($result5);
$fetchname =$row5['name'];

$sql6= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `dob`='$empdob'";
$result6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_assoc($result6);
$fetchdob =$row6['dob'];

if($empname==$fetchname && $empdob==$fetchdob)
{
echo 6; // for nickname and name exist !
}
else
{



$req2 = "INSERT INTO `AAemployees`(`name`, `nickname`, `desination`, `mobile`, `email`, `dob`, `age`, `project`, `Rdate`, `issue`, `expire`, `role`, `type`, `user`, `addedby`, `transfer`, `notification`, `ext1`, `ext2`, `ext3`) VALUES ('$empname','$empnick','$empdesination','$empmobile','$empemail','$empdob','$empage','$empproject','$date','$date','$expire','Restore','$empgroup','$encUser','$encId','','','$empid','','')";
$reqq2 = mysqli_query($con, $req2);

$sql7= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `mobile`='$empmobile' and `email`='$empemail'";
$result7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_assoc($result7);
echo $fetchid =$row7['id'];

$userphone = $empmobile."@".$fetchid;
$emppassword = substr($empmobile,6,10).date('Y',strtotime($empdob));

if($empgroup!="Group employee")
{
$queryA="INSERT INTO `AAuser`(`name`,`Main`, `company`, `mobile`, `email`, `role`, `password`, `verified`, `image`, `date`, `primium`, `lastactive`, `ext2`, `ext3`, `ext4`,`project`,`permission`,`type`,`employee`) VALUES ('$empname','$decUser','','$userphone','$userphone','Employee','$emppassword',0,0,'$date',0,'$datetime','active','','','$empproject','','','$fetchid')";
$adduser=mysqli_query($con, $queryA);
}


$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$empproject'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);
$fetchprojectname =$row8['name'];

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$fetchid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription ="Employee ( ".$empdesination." ) added";
  $Atitle = $empname." for the project ".$fetchprojectname;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="employee";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$focus;
  $Amainuser =$encUser;
 $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end
$sender ="";
if($decUser=="9892558100")
{
$sender="ASFENT";
}
else
{
$sender="MYMNGE";
}
$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	
	$numbers = urlencode($empmobile);
	$sender = urlencode($sender);
	$empname= $empname;
	$company = $company;
	$message = rawurlencode('Dear%2C%0D%0A%20'.$empname.'%20thank%20for%20registering%20from%20'.$company.'%20your%20user%20id%20is%20'.$userphone.'%20and%20password%20is%20'.$emppassword.'.%0D%0A%0D%0Aregards%0D%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($empgroup!="Group employee")
	{
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
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
if($permissionA[$x]==2)
{
$check =1;
}
}



$empage = (date('Y') - date('Y',strtotime($empdob)));
    
$sql3= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `mobile`='$empmobile'";
$result3 = mysqli_query($con, $sql3);
$row3= mysqli_fetch_assoc($result3);
$fetchmobile =$row3['mobile'];

$sql4= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `email`='$empemail'";
$result4 = mysqli_query($con, $sql4);
$row4= mysqli_fetch_assoc($result4);
$fetchemail =$row4['email'];

$sql5 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `name`='$empname'";
$result5 = mysqli_query($con, $sql5);
$row5= mysqli_fetch_assoc($result5);
$fetchname =$row5['name'];

$sql6= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `dob`='$empdob'";
$result6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_assoc($result6);
$fetchdob =$row6['dob'];

if($empname==$fetchname && $empdob==$fetchdob)
{
echo 6; // for nickname and name exist !
}
else
{


$userphone = $empmobile."@".$fetchid; ///substr(($fetchid.date('dmY')),0,10);
$emppassword = substr($empmobile,6,10).date('Y',strtotime($empdob));

$req2 = "INSERT INTO `AAemployees`(`name`, `nickname`, `desination`, `mobile`, `email`, `dob`, `age`, `project`, `Rdate`, `issue`, `expire`, `role`, `type`, `user`, `addedby`, `transfer`, `notification`, `ext1`, `ext2`, `ext3`) VALUES ('$empname','$empnick','$empdesination','$empmobile','$empemail','$empdob','$empage','$empproject','$date','$date','$expire','Restore','$empgroup','$encUser','$encId','','','$empid','','')";
$reqq2 = mysqli_query($con, $req2);

$sql7= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `mobile`='$empmobile' and `email`='$empemail'";
$result7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_assoc($result7);
echo $fetchid =$row7['id'];

if($empgroup!="Group employee")
{
$queryA="INSERT INTO `AAuser`(`name`,`Main`, `company`, `mobile`, `email`, `role`, `password`, `verified`, `image`, `date`, `primium`, `lastactive`, `ext2`, `ext3`, `ext4`,`project`,`permission`,`type`,`employee`) VALUES ('$empname','$decUser','','$userphone','$userphone','Employee','$emppassword',0,0,'$date',0,'$datetime','active','','','$empproject','','','$fetchid')";
$adduser=mysqli_query($con, $queryA);
}


$sql8= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$empproject'";
$result8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_assoc($result8);
$fetchprojectname =$row8['name'];

$alluser ="";
  $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
  $resultmobile2g = mysqli_query($con, $sqlmobile2g);
  while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
  {
  $alluser = $alluser.$rowe3dg['id'].",";
  }
  $sqlcom = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' ";
  $resultvb = mysqli_query($con, $sqlcom);
  $rowecom = mysqli_fetch_assoc($resultvb);
  $company =$rowecom["company"];
  
  $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$fetchid'";
  $resultfind = mysqli_query($con, $find);
  $rowfind = mysqli_fetch_assoc($resultfind);
  $focus =$rowfind["id"];
  
  $Adescription ="Employee ( ".$empdesination." ) added";
  $Atitle = $empname." for the project ".$fetchprojectname;
  $Aref1 ="1";
  $Aref2 ="1";
  $Aref3 ="";
  $Aref4 ="";
  $Aref5 ="";
  $Aref6 ="";
  $Aref7 ="";
  $Adate =$date;
  $Atime =$time;
  $Atype ="employee";
  $Alimitday ="30";
  $Aalert ="0";
  $Aaddedby =$decId;
  $Ausers =$alluser;
  $Anotif =$alluser;
  $Afocus =$focus;
  $Amainuser =$encUser;
  $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
  $alert = mysqli_query($con, $qalert);
  
  //notification area end
$sender ="";
if($decUser=="9892558100")
{
$sender="ASFENT";
}
else
{
$sender="MYMNGE";
}
$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	
	$numbers = urlencode($empmobile);
	$sender = urlencode($sender);
	$empname= $empname;
	$company = $company;
	$message = rawurlencode('Dear%2C%0D%0A%20'.$empname.'%20thank%20for%20registering%20from%20'.$company.'%20your%20user%20id%20is%20'.$userphone.'%20and%20password%20is%20'.$emppassword.'.%0D%0A%0D%0Aregards%0D%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	if($empgroup!="Group employee")
	{
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	}
	

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