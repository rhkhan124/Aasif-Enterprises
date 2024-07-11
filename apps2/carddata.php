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
<div class="fullbody" id="accordionExample">

<?php
require_once("con.php");

$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$empid =$_GET["empid"];
$mainB =$_GET["main"];
$text =$_GET["text"];
$mydate =$_GET["date"];
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
$date=date('Y-m-d');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));

$projectList ="";


/*$projectList = explode(","$projectArray);
for ($x = 0; $x <= count($projectList); $x++) {


}
*/
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$mainB'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$empname =$row1['name'];


$sql2= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$empname2 =$row2['name'];

$sql3= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$address =$row3['paddress'];

$req4 = "SELECT * FROM `AApersalary` WHERE `user`='$encUser' and `name`='$empid' and `type`='Per day'";
$result4 = mysqli_query($con, $req4);
$row4 = mysqli_fetch_assoc($result4);
$rate =$row4['amount'];

echo '<table class="F12" style="background-color:#78dfe6;width:94%;margin:3%;font-family:times;font-weight:bold;" border="1" >
<tr style="height:25px;" >
<td colspan="4" style="border:none;padding-left:10px;"  >Name of the factory : '.$empname.'</td>
</tr>
<tr style="height:25px;">
<td colspan="4" style="border:none;padding-left:10px;" >Address : '.$address.'</td>
</tr>
<tr style="height:25px;">
<td colspan="4" style="border:none;padding-left:10px;">Name of the worker : '.$empname2.'</td>
</tr>
<tr style="height:25px;">
<td colspan="2" style="border:none;padding-left:10px;" >Per day pay : '.$rate.'/-</td>
<td colspan="2" style="border:none;text-align:right;padding-right:10px;">Month : '.$text.'</td>
</tr>
<tr style="text-align:center;">
<td>Date</td>
<td>Present</td>
<td>Advance</td>
<td>Remark</td>
</tr>';

   $d=strtotime($mydate);
   $empdate  = date("Y-m", $d); 
$present =0;
$money =0;
for ($x = 1; $x <= 31; $x++) {
$newdate =$empdate."-".$x;

$req5 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `allemp`='$empid' and `date`='$newdate'";
$result5 = mysqli_query($con, $req5);
$row5 = mysqli_fetch_assoc($result5);
$no =$row5['no'];
$present = +$present+$no;

$sql6= "SELECT SUM(amount) AS amt FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' and `date`='$newdate' and `ext1`='true'";
$result6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_assoc($result6);
$amt =$row6['amt'];
$money = $money+$amt;
$p ="";
if($no==0.5)
{
$p = "1/2";
}
else if($no==1)
{
$p = "P";
}
else if($no==1.5)
{
$p = "P 1/2";
}
else if($no==2)
{
$p = "P+P";
}
else
{
$p = "";
}
echo '<tr>
<td style="text-align:center;width:20%;" >'.$x.'</td>
<td style="padding-left:10px;width:25%;">'.$p.'</td>
<td style="text-align:center;width:25%;">'.$amt.'</td>
<td style="text-align:center;width:30%;">
<select class="mybutton F12" style="width:100%;display:none;">
<option>Half Day</option>
<option>Full Day</option>
<option>One & Half Day</option>
<option>Double Day</option>
</select>
</td>
</tr>';

}
echo '<tr style="height:25px;">
<td colspan="3" style="padding-left:10px;" >Total Present day</td>
<td style="text-align:right;padding-right:10px;">'.$present.'</td>
</tr>';
echo '<tr style="height:25px;">
<td colspan="3" style="padding-left:10px;" >Total Advance</td>
<td style="text-align:right;padding-right:10px;">'.$money.'</td>
</tr>'; 
echo '<tr style="height:25px;">
<td colspan="3" style="padding-left:10px;" >Total salary</td>
<td style="text-align:right;padding-right:10px;">'.($present*$rate).'</td>
</tr>';
echo '<tr style="height:25px;">
<td colspan="3" style="padding-left:10px;" >Total payble amount</td>
<td style="text-align:right;padding-right:10px;">'.(($present*$rate)-$money).'</td>
</tr>';

echo '</table>';



?>






</div>
</body>
</html>