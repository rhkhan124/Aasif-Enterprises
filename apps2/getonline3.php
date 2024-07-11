<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><title></title>
</head>
<style type="text/css">

.Cinput{
height:40px;
width:100%;
}
.Cbutton
{
height:40px;
width:40px;
}
input{
width:100%;
height:40px;
border:none;
outline:none;
background:none;
font-weight:bold;
font-family:times;
padding-left:10px;
}
 body{background:#E6E6E6;}.mycontainer{background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;}.myinput{border:none;background:#E6E6E6;outline:none;box-shadow:inset 5px 5px 5px #808080, inset -5px -5px 5px #ffffff;}.mytext{text-shadow: 2px 2px 2px #808080, -2px -2px 2px #ffffff;}.mytext2{text-shadow: 1px 1px 1px #808080, -1px -1px 1px #ffffff;}.mybutton{border:none;box-shadow:5px 5px 5px #808080, -5px -5px 5px #ffffff;outline:none;background:#E6E6E6; }.mybutton:hover{box-shadow:1px 1px 5px #808080,  -1px -1px 5px #ffffff;}.FAA{color:#000000;}.FB{color:#009dd1;}.FC{color:#ff0000;} .F5{font-size:5px;}  .F6{font-size:6px;}  .F7{font-size:7px;}  .F8{font-size:8px;}  .F9{font-size:9px;}  .F10{font-size:10px;}  .F11{font-size:11px;}  .F12{font-size:12px;}  .F13{font-size:13px;}  .F14{font-size:14px;}  .F15{font-size:15px;}  .F16{font-size:16px;}  .F17{font-size:17px;}  .F18{font-size:18px;}  .F19{font-size:19px;}  .F20{font-size:20px;}  .F21{font-size:21px;}  .F22{font-size:22px;}  .F23{font-size:23px;}  .F24{font-size:24px;}  .F25{font-size:25px;}  .F26{font-size:26px;}  .F27{font-size:27px;}  .F28{font-size:28px;}  .F29{font-size:29px;}  .F30{font-size:30px;}  .F31{font-size:31px;}  .F32{font-size:32px;}  .F33{font-size:33px;}  .F34{font-size:34px;}  .F35{font-size:35px;}  .F36{font-size:36px;}  .F37{font-size:37px;}  .F38{font-size:38px;}  .F39{font-size:39px;}  .F40{font-size:40px;}  .F{font-size:px;} 

</style>
<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
<div class="fullbody" style="font-weight:bold;font-family:times;"  id="accordionExample">

<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$mymonth =$_GET["month"];
$gname =$_GET["name"];
$url =$_GET["url"];

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
$req12="";
if($mymonth=="today")
{
$req12 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `date`='$date' GROUP BY `name`";
}
else
{
$req12 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `name`='$gname' and `month`='$mymonth' GROUP BY `date`";
}

$run12 = mysqli_query($con, $req12);
while($rows1 =mysqli_fetch_assoc($run12))
{
$date2 =$rows1["date"];
$project =$rows1["project"];
$device =$rows1["device"];
$pname =$rows1["name"];
$mymonth2 =$rows1["month"];

$req17 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `name`='$pname' and `date`='$date2' and `project`='$project' and `month`='$mymonth2' and `type`='start'";
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
$req2 = "SELECT * FROM `AAonline` WHERE `user`='$encUser' and `name`='$pname' and `date`='$date2' and `project`='$project' and `month`='$mymonth2' and `type`='end'";
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

$req134 = "SELECT * FROM `AAuser` WHERE `id`='$pname'";
$run134 = mysqli_query($con, $req134);
$result134 = mysqli_fetch_assoc($run134);
$uname =$result134["name"];

      
      
     echo ' <div style="background-color:#f896ff;width:94%;margin:3%;" class="mycontainer" >
      <table style="text-align:center;width:100%;" >
      <tr style="height:30px;" >
      <td colspan="4" >'.$uname.'</td>
      </tr>
      <tr style="height:30px;" >
      <td colspan="2" >'.$mygnameB.'</td><td colspan="2" >'.$date2.'</td>
      </tr>
      <tr style="height:30px;">
      <td>Start</td><td>'.$start.'</td><td>End </td><td>'.$end.'</td>
      </tr>
      <tr style="height:30px;">
      <td>Distance</td><td>'.$accuracy.' mtr</td><td>Device</td><td>'.$device.'</td>
      </tr>
      </table>
      </div>';


}



}

/// encryption


?>













<script>


//document.getElementById("g").src=url+"allpayment4.php?id="+id+"&user="+User+"&token="+token+"&url="+url;


</script>
</div>
</body>
</html>