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
.box{
width:94%;
margin:3%;
}
.r{
text-align:right;
}
.l{
text-align:left;
}
.c{
text-align:center;
}
tr{
height:15px;
}

.switch {
 position: relative;
 display: inline-block;
 width: 50px;
 height: 15px;
}

.switch input { 
 opacity: 0;
 width: 0;
 height: 0;
}

.slider {
 position: absolute;
 cursor: pointer;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 background-color: #ccc;
 -webkit-transition: .4s;
 transition: .4s;
}

.slider:before {
 position: absolute;
 content: "";
 height: 10px;
 width: 10px;
 left: 5px;
 bottom: 3px;
 background-color: white;
 -webkit-transition: .4s;
 transition: .4s;
}

input:checked + .slider {
 background-color: #2196F3;
}

input:focus + .slider {
 box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
 -webkit-transform: translateX(26px);
 -ms-transform: translateX(26px);
 transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
 border-radius: 20px;
}

.slider.round:before {
 border-radius: 50%;
}

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;

}

.upload-btn-wrapper input[type=file] {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}

.dropdown2 {
  position: relative;
  display: inline-block;
}
</style>
<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
<script type="text/javascript">

function prog(z)
{
window.top.postMessage('{"id":1,"data1":'+z+',"data2":"","data3":"","data4":""}','*');
}
</script>




<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];

$project =$_GET["project"];
$wing =$_GET["wing"];
$work =$_GET["work"];
$search =$_GET["search"];
$url =$_GET["url"];
$done =$_GET["done"];
$ref2 =$_GET["ref2"];



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
if($type=="main")
{
$req1X = "SELECT * FROM `AAWing` WHERE `id`='$wing'";
$reqRX = mysqli_query($con, $req1X);
$projectX = mysqli_fetch_assoc($reqRX);
$wingnameX =$projectX["wing"];



$x =0;
$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat` LIKE '%$search%' ";
$run1 = mysqli_query($con, $req1);
while($result1 = mysqli_fetch_assoc($run1))
{
$x = $x+1;
}


$y=0;
$percentage2 =0;

$req2 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat` LIKE '%$search%' ORDER BY `flat` +0 ASC";
$run2 = mysqli_query($con, $req2);
while( $result2 = mysqli_fetch_assoc($run2))
{
$y = $y+1;

$flatid =$result2["id"];
$flatno =$result2["flat"];
$bhkid =$result2["bhk"];

$req3 = "SELECT * FROM `AABhk` WHERE `id`='$bhkid'";
$run3 = mysqli_query($con, $req3);
$result3 = mysqli_fetch_assoc($run3);
$bhkname =$result3["bhk"];

$display ="";

$req4 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$work' and `project`='$project' and `wing`='$wing' and `bhk`='$bhkid'";
$run4 = mysqli_query($con, $req4);
if(mysqli_num_rows($run4)>0)
{

$display ="block";
}
else
{
$display ="none";
}
$result4 = mysqli_fetch_assoc($run4);
$worknameid =$result4["workname"];
$sqft =$result4["sqft"];
$rate =$result4["rate"];

$req5 = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$worknameid'";
$run5 = mysqli_query($con, $req5);
$result5= mysqli_fetch_assoc($run5);
$workname = $result5["name"];


$percentage = floor(round( (($y / $x) * 100), 1 ));
if($percentage!=$percentage2)
{
echo '<script type="text/javascript">prog('.$percentage.');</script>';
}
$percentage2 =$percentage;

$zname2 = "";
$zdate = "";
$zremark = "";
$zpayment = "";
$zlock = "";
$zaddedby = "";
$color ="";
$zhold1 = "No record";
$zhold2 = "";
$check ="";
$group2 ="";
$mydis ="";
$mydis2 ="";
$myunlock ="";


$req7 = "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhkid' and `flat`='$flatno' and `work`='$work'";
$run7 = mysqli_query($con, $req7);
if(mysqli_num_rows($run7)>0)
{
$result7 = mysqli_fetch_assoc($run7);
$zid = $result7["id"];
$zname = $result7["emp"];
$zdate = $result7["date"];
$zremark = $result7["remark"];
$zpayment = $result7["status"];
$zhold = $result7["hold"];
$zhold1 = (100-$zhold)."% Done ";
$zhold2 = ($zhold*-1)."% Hold";
$zmylock = $result7["ext1"];
$zmytext = $result7["ext2"];


$zlock ="";
$days = (strtotime($date) - strtotime($zmylock)) / (60 * 60 * 24);
$zlock='<strong style="color:green">Open</strong>';


$zaddedby = $result7["addedby"];
$group2 ="";
$zuserid =openssl_decrypt ( $zaddedby , $ciphering, $dec_key, $options, $dec_iv);

$req9 = "SELECT AAuser.name uname, AAemployees.name ename FROM AAuser, AAemployees WHERE AAuser.id='$zuserid' and AAemployees.id='$zname'";
$run9 = mysqli_query($con, $req9);
$result9 = mysqli_fetch_assoc($run9);
$zaddedby2 ="Updated by_".$result9["uname"];
$zname2 =$result9["ename"];
$color ="#a0fad4";
if($zpayment=="true")
{
$zpayment ="Done";
$check ="checked";
$color1 ="";
}
else
{
$zpayment ="Not Done";
$check ="";
$color1 ="red";
}

if($done==1)
{
$display ="block";
}
else if($done==2)
{
$display ="block";
}
else if($done==3)
{
$display ="none";
}
}
else
{
if($done==1)
{
$display ="block";
}
else if($done==2)
{
$display ="none";
}
else if($done==3)
{
$display ="block";
}

$zname2 = "No record";
$zdate = "00/00/0000";
$zremark = "";
$zpayment = "Not Done";
$zlock = '<strong style="color:green"> Open</strong>';
$mydis ="block";
$mydis2 ="none";
$zaddedby = "";
$color ="";
$zhold1 = "No record";
$zhold2 = "";
$check ="checked";
}
$input ="";
$select="";
$mytext="";
if($sqft==1)
{
$input ="block";
$select="none";
$mytext="Work amount";
}
else
{
$input ="none";
$select="block";
$mytext="Hold work";
}

$count =0;

   $req5b = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' GROUP BY `date`";
   $run5b = mysqli_query($con, $req5b);
   while($result5b = mysqli_fetch_assoc($run5b))
   {
   $count = $count+1;
   
   }
   
   $req5b1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' ORDER BY `date` ASC";
   $run5b1 = mysqli_query($con, $req5b1);
   $result5b1 = mysqli_fetch_assoc($run5b1);
   
   $start =$result5b1["date"];
   $d1=strtotime($start);
   $start = date("d-m-Y", $d1); 
   
   if($start=="01-01-1970")
   {
   $start = "00-00-0000";
   }
   else
   {
   $start =$start;
   }
   
   $req5b2 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' ORDER BY `date` DESC";
   $run5b2 = mysqli_query($con, $req5b2);
   $result5b2 = mysqli_fetch_assoc($run5b2);
   
   $end =$result5b2["date"];
   $d2=strtotime($end);
   $end = date("d-m-Y", $d2); 
   
   if($end=="01-01-1970")
   {
   $end = "00-00-0000";
   }
   else
   {
   $end =$end;
   }
   
   $req5b4 = "SELECT SUM(no) as mason FROM `AAreport` WHERE `user`='$encUser' and `ext1`='Mason' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno'";
   $run5b4 = mysqli_query($con, $req5b4);
   $result5b4 = mysqli_fetch_assoc($run5b4);
   $mason = $result5b4["mason"];
   
   $req5b5 = "SELECT SUM(no) as helper FROM `AAreport` WHERE `user`='$encUser' and `ext1`='Helper' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno'";
   $run5b5 = mysqli_query($con, $req5b5);
   $result5b5 = mysqli_fetch_assoc($run5b5);
   $helper = $result5b5["helper"];
   
   
   
   
   $req5b2c = "SELECT emp, SUM(no) as count FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' GROUP BY `emp` ORDER BY `count` DESC";
   $run5b2c = mysqli_query($con, $req5b2c);
   $result5b2c = mysqli_fetch_assoc($run5b2c);
   
   $group2 =$result5b2c["emp"];
   

echo '<input type="hidden" value="'.$zid.'" id="flatworkid'.$flatid.'">';
echo '<input type="hidden" value="'.$flatno.'" id="flat'.$flatid.'">';
echo '<input type="hidden" value="'.$bhkid.'" id="bhk'.$flatid.'">';
echo '<input type="hidden" value="'.$worknameid.'" id="work'.$flatid.'">';
echo '<input type="hidden" value="'.$sqft.'" id="sqft'.$flatid.'">';


echo '<div id="rowA'.$flatid.'" class="mycontainer" style="width:100%;margin-top:3%;background-color:'.$color.';display:'.$display.';">'
.'<p class="F18" style="text-align:center;font-weight:bold;font-family:times;padding-top:2%;" >'.$flatno.'<i style="float:right;padding-right:20px;color:red;" onclick="deleteflat('.$flatid.');" class="fa fa-trash F20"></i></p>'
.'<div class="myinput" style="" >'
.'</div>'
.'</div>'
.'<div class="mycontainer box" id="rowB'.$flatid.'" style="background-color:'.$color.';display:'.$display.';">'
.'<table style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr>'
.'<td class="F12 " >'.$workname.'</td>'
.'</tr>'
.'</table>'
.'<hr class="" style="margin:2px;" color="black" size="2%"/>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;margin-top:10px;" >'
.'<tr>'
.'<td class="l" style="width:15%;padding-left:2%;">No</td>'
.'<td class="l">'.$flatno.'</td>'
.'<td class="l" style="width:15%;padding-right:2%;" >Type</td>'
.'<td class="r" style="width:15%;padding-right:2%;">'.$bhkname.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Done by</td>'
.'<td class="l F12" id="empname'.$flatid.'" >'.$zname2.'</td>'
.'<td class="l" style="width:15%;padding-right:2%;" >Date</td>'
.'<td class="r" style="width:20%;padding-right:2%;" id="date'.$flatid.'">'.$zdate.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Status</td>'
.'<td class="l"><strong id="holdA'.$flatid.'" >'.$zhold1. '</strong><strong style="color:red;" id="holdB'.$flatid.'">'.$zhold2.'</strong></td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Payment</td>'
.'<td class="r" style="width:20%;padding-right:2%;color:'.$color1.';" id="status'.$flatid.'">'.$zpayment.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Work Period</td>'
.'<td class="l">'.$count.' days  <small onclick="getatt('.$flatid.')" data-toggle="modal" data-target="#exampleModalCenter" style="margin-left:7px;" class="F8 mybutton"><i class="fa F15 fa-info"></i> info</small></td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Lock Status</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$zlock.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Total Mason </td>'
.'<td class="l">'.$mason.'</td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Total Helper</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$helper.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Started</td>'
.'<td class="l">'.$start.'</td>'
.'<td class="l" style="width:20%;padding-right:2%;" >End</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$end.'</td>'
.'</tr>'
.'</table>'
.'<hr class="" style="margin:4px;" color="black" size="2%"/>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;margin-top:8px;" >'
.'<tr>'
.'<td class="l" style="width:40%;padding-left:2%;">Update Employee</td>'
.'<td class="c" style="width:60%;padding-right:2%;">'
.'<select class="mycontainer" style="hieght:10px;width:100%;outline:none;" id="name'.$flatid.'">';

$p ="";
$req6 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='Restore' and `project`='$project'";
$run6 = mysqli_query($con, $req6);
while ($result6= mysqli_fetch_assoc($run6))
{
$empname = $result6["name"];
$empid = $result6["id"];
$p =$p+1;
if($p==1 && $zname=="")
{
$zname = $empid;
}
else
{
$zname = $zname;
}
echo '<option value="'.$empid.'">'.$empname.'</option>';
}
if($group2>0)
{
echo '<script>document.getElementById("name'.$flatid.'").value = "'.$group2.'";</script>';
}
else
{
echo '<script>document.getElementById("name'.$flatid.'").value = "'.$zname.'";</script>';
}
  
echo '</select>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr>'
.'<td class="l" style="width:40%;padding-left:2%;">'.$mytext.'</td>'
.'<td class="r" style="width:60%;padding-right:2%;height:20px;">'
.'<input type="number" value="'.$rate.'" id="rate'.$flatid.'" class="myinput" style="height:20px;width:40%;outline:none;background-color:white;display:'.$input.';">'
.'<select class="mycontainer F12" style="hieght:10px;width:40%;outline:none;display:'.$select.'" id="hold'.$flatid.'">';
for ($z = 0; $z <= 51; $z++) {
if($z==15)
{
echo '<option value="'.$z.'" selected>'.$z.'%</option>';
}else{
 echo '<option value="'.$z.'">'.$z.'%</option>';
}}
  echo '<script>document.getElementById("hold'.$flatid.'").value = "'.$zhold.'";</script>';
  if($sqft==1)
  {
  echo '<script>document.getElementById("hold'.$flatid.'").value = "0";</script>';
  }
echo '</select>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr>'
.'<td class="l" style="width:40%;padding-left:2%;">Payment credit to employee A/C</td>'
.'<td class="r" style="width:60%;padding-right:2%;">'
.'<label class="switch">'
.'<input type="checkbox" id="payment'.$flatid.'" '.$check.'>'
.'<span class="slider round"></span></label></td>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<p class="F12" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;">Attachments<div class="upload-btn-wrapper F10 mybutton" style="float:right;font-weight:bold;font-family:times;margin-right:6px;height:15px;width:100px;">'
.'<button   style="height:100%;width:100%;" > '
.'<input type="file" style="" class="myfileZ" onclick="getref('.$flatid.');" refA="'.$workname.'" refB="'.$project.$wing.$flatno.$worknameid.'" name="myfile'.$flatid.'" id="myfile'.$flatid.'"> Upload file'
.'</button>'
.'</div>'
.'</p><table border="1" style="width:70%;" id="g'.$flatno.'">';
$reflink =$project.$wing.$flatno.$worknameid;
$sql1c= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ext2`='$reflink' and `type`='file'";
$result1c = mysqli_query($con, $sql1c);
while ( $resultlink =mysqli_fetch_assoc($result1c))
{
$fileid =$resultlink["id"];
$filenamep =$resultlink["filename"];
$filelink = $resultlink["filecodename"].".".$resultlink["ext1"];
echo '<tr id="frow'.$fileid.'"><td><p class="F12" id="filename'.$fileid.'" onclick="showfile2('.$fileid.');" ext="'.$resultlink["ext1"].'" link="'.$filelink.'" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;color:blue;">'.$filenamep.'</p></td><td><i id="ff'.$fileid.'" rfname="'.$filenamep.'" onclick="fdelete('.$fileid.')" rf="'.$reflink.'" class="F12 fa fa-trash" style="color:red;"></i></td></tr>';
}
echo '</table><br>'
.'<p class="F9" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;text-align:center;"><strong style="" >Issued materials</strong></p>'
.'<div class="myinput" style="width:94%;margin-left:3%;overflow:scroll;height:60px;" >'
.'<table border="1" class="F9" style="width:96%;margin:2%;">';
      
      $flatnoxx =$result2["flat"];
      $req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flatnoxx' and `ext1`='$work'";
      $reqRbb = mysqli_query($con, $req1bb);
      while ( $resultbb =mysqli_fetch_assoc($reqRbb))
      {
      $zid = $resultbb["id"];
      $zname = $resultbb["emp"];
      $zitem = $resultbb["item"];
      $zqty = $resultbb["qty"];
      $zunit = $resultbb["unit"];
      
      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];

      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];

echo '<tr>'
.'<td>'.$workname.'</td>'
.'<td class="c" >'.$zqty." ".$zunit.'</td>'
.'<td class="r"  >Recieved by '.$worknamem.'</td>'
.'</tr>';
}


echo '</table>'
.'</div>'
.'<p class="F9" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;" >Remark of the work <strong style="float:right;color:red;" >'.$zaddedby2.'</strong></p>'
.'<textarea class="F9" style="margin-left:2%;height:50px;resize:none;outline:none;width:96%;font-weight:bold;font-family:times;" id="remark'.$flatid.'">'.$zremark.'</textarea>'
.'<table class="F9 c" style="width:96%;margin-left:2%;" >'
.'<tr>'
.'<td style="width:33%;"><button class="mybutton" style="width:80%;" onclick="cleardata('.$flatid.');">Clear all data</button></td>'
.'<td style="width:34%;"><button class="mybutton" style="width:80%;" onclick="update('.$flatid.')" >Update work</button></td>'
.'<td style="width:33%;"><button class="mybutton" style="width:80%;display:none;" id="kk'.$flatid.'" onclick="request('.$flatid.')">'.$myunlock.'</button></td>'
.'</tr>'
.'</table>'
.'</div>'
.'</div>';
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
if(5==5)
{
$check =1;
}
}
if($check==1)
{


$req1X = "SELECT * FROM `AAWing` WHERE `id`='$wing'";
$reqRX = mysqli_query($con, $req1X);
$projectX = mysqli_fetch_assoc($reqRX);
$wingnameX =$projectX["wing"];



$x =0;
$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat` LIKE '%$search%' ";
$run1 = mysqli_query($con, $req1);
while($result1 = mysqli_fetch_assoc($run1))
{
$x = $x+1;
}


$y=0;
$percentage2 =0;

$req2 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat` LIKE '%$search%' ORDER BY `flat` +0 ASC";
$run2 = mysqli_query($con, $req2);
while( $result2 = mysqli_fetch_assoc($run2))
{
$y = $y+1;

$flatid =$result2["id"];
$flatno =$result2["flat"];
$bhkid =$result2["bhk"];

$req3 = "SELECT * FROM `AABhk` WHERE `id`='$bhkid'";
$run3 = mysqli_query($con, $req3);
$result3 = mysqli_fetch_assoc($run3);
$bhkname =$result3["bhk"];

$display ="";

$req4 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `workname`='$work' and `project`='$project' and `wing`='$wing' and `bhk`='$bhkid'";
$run4 = mysqli_query($con, $req4);
if(mysqli_num_rows($run4)>0)
{

$display ="block";
}
else
{
$display ="none";
}
$result4 = mysqli_fetch_assoc($run4);
$worknameid =$result4["workname"];
$sqft =$result4["sqft"];
$rate =$result4["rate"];

$req5 = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$worknameid'";
$run5 = mysqli_query($con, $req5);
$result5= mysqli_fetch_assoc($run5);
$workname = $result5["name"];


$percentage = floor(round( (($y / $x) * 100), 1 ));
if($percentage!=$percentage2)
{
echo '<script type="text/javascript">prog('.$percentage.');</script>';
}
$percentage2 =$percentage;

$zname2 = "";
$zdate = "";
$zremark = "";
$zpayment = "";
$zhold = "";
$zlock = "";
$zaddedby = "";
$color ="";
$zhold1 = "No record";
$check ="";
$group2 ="";
$mydis ="";
$mydis2 ="";
$myunlock ="";


$req7 = "SELECT * FROM `AAFlatwork` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhkid' and `flat`='$flatno' and `work`='$work'";
$run7 = mysqli_query($con, $req7);
if(mysqli_num_rows($run7)>0)
{
$result7 = mysqli_fetch_assoc($run7);
$zid = $result7["id"];
$zname = $result7["emp"];
$zdate = $result7["date"];
$zremark = $result7["remark"];
$zpayment = $result7["status"];
$zhold = $result7["hold"];
$zhold1 = "Done ";
$zhold2 = "";
$zmylock = $result7["ext1"];
$zmytext = $result7["ext2"];

if($zmytext=="")
{
$myunlock = "Request to unlock";
}
else
{
$myunlock = "Requested";
}
$zlock ="";
$days = (strtotime($date) - strtotime($zmylock)) / (60 * 60 * 24);
if($days<=3)
{
$zlock ='<strong style="color:red">'. (3-$days).' day left</strong>';
$mydis ="block";
$mydis2 ="none";
}
else
{
$zlock='<strong style="color:red">Locked</strong>';
$mydis ="none";
$mydis2 ="block";
}

$zaddedby = $result7["addedby"];
$group2 ="";
$zuserid =openssl_decrypt ( $zaddedby , $ciphering, $dec_key, $options, $dec_iv);

$req9 = "SELECT AAuser.name uname, AAemployees.name ename FROM AAuser, AAemployees WHERE AAuser.id='$zuserid' and AAemployees.id='$zname'";
$run9 = mysqli_query($con, $req9);
$result9 = mysqli_fetch_assoc($run9);
$zaddedby2 ="Updated by_".$result9["uname"];
$zname2 =$result9["ename"];
$color ="#a0fad4";
if($zpayment=="true")
{
$zpayment ="Done";
$check ="checked";
$color1 ="";
}
else
{
$zpayment ="Not Done";
$check ="";
$color1 ="red";
}

if($done==1)
{
$display ="block";
}
else if($done==2)
{
$display ="block";
}
else if($done==3)
{
$display ="none";
}
}
else
{
if($done==1)
{
$display ="block";
}
else if($done==2)
{
$display ="none";
}
else if($done==3)
{
$display ="block";
}

$zname2 = "No record";
$zdate = "00/00/0000";
$zremark = "";
$zpayment = "Not Done";
$zlock = '<strong style="color:green"> Open</strong>';
$mydis ="block";
$mydis2 ="none";
$zaddedby = "";
$color ="";
$zhold1 = "No record";
$zhold2 = "";
$check ="checked";
}
$input ="";
$select="";
$mytext="";
if($sqft==1)
{
$input ="block";
$select="none";
$mytext="Work amount";
}
else
{
$input ="none";
$select="block";
$mytext="Hold work";
}

$count =0;

   $req5b = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' GROUP BY `date`";
   $run5b = mysqli_query($con, $req5b);
   while($result5b = mysqli_fetch_assoc($run5b))
   {
   $count = $count+1;
   
   }
   
   $req5b1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' ORDER BY `date` ASC";
   $run5b1 = mysqli_query($con, $req5b1);
   $result5b1 = mysqli_fetch_assoc($run5b1);
   
   $start =$result5b1["date"];
   $d1=strtotime($start);
   $start = date("d-m-Y", $d1); 
   
   if($start=="01-01-1970")
   {
   $start = "00-00-0000";
   }
   else
   {
   $start =$start;
   }
   
   $req5b2 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' ORDER BY `date` DESC";
   $run5b2 = mysqli_query($con, $req5b2);
   $result5b2 = mysqli_fetch_assoc($run5b2);
   
   $end =$result5b2["date"];
   $d2=strtotime($end);
   $end = date("d-m-Y", $d2); 
   
   if($end=="01-01-1970")
   {
   $end = "00-00-0000";
   }
   else
   {
   $end =$end;
   }
   
   $req5b4 = "SELECT SUM(no) as mason FROM `AAreport` WHERE `user`='$encUser' and `ext1`='Mason' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno'";
   $run5b4 = mysqli_query($con, $req5b4);
   $result5b4 = mysqli_fetch_assoc($run5b4);
   $mason = $result5b4["mason"];
   
   $req5b5 = "SELECT SUM(no) as helper FROM `AAreport` WHERE `user`='$encUser' and `ext1`='Helper' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno'";
   $run5b5 = mysqli_query($con, $req5b5);
   $result5b5 = mysqli_fetch_assoc($run5b5);
   $helper = $result5b5["helper"];
   
   
   
   
   $req5b2c = "SELECT emp, SUM(no) as count FROM `AAreport` WHERE `user`='$encUser' and `wing`='$wing' and `project`='$project' and `work`='$work' and `flat`='$flatno' GROUP BY `emp` ORDER BY `count` DESC";
   $run5b2c = mysqli_query($con, $req5b2c);
   $result5b2c = mysqli_fetch_assoc($run5b2c);
   
   $group2 =$result5b2c["emp"];
   

echo '<input type="hidden" value="'.$zid.'" id="flatworkid'.$flatid.'">';
echo '<input type="hidden" value="'.$flatno.'" id="flat'.$flatid.'">';
echo '<input type="hidden" value="'.$bhkid.'" id="bhk'.$flatid.'">';
echo '<input type="hidden" value="'.$worknameid.'" id="work'.$flatid.'">';
echo '<input type="hidden" value="'.$sqft.'" id="sqft'.$flatid.'">';


echo '<div id="rowA'.$flatid.'" class="mycontainer" style="width:100%;margin-top:3%;background-color:'.$color.';display:'.$display.';">'
.'<p class="F18" style="text-align:center;font-weight:bold;font-family:times;padding-top:2%;" >'.$flatno.'<i style="float:right;padding-right:20px;color:red;" onclick="deleteflat('.$flatid.');" class="fa fa-trash F20"></i></p>'
.'<div class="myinput" style="" >'
.'</div>'
.'</div>'
.'<div class="mycontainer box" id="rowB'.$flatid.'" style="background-color:'.$color.';display:'.$display.';">'
.'<table style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr>'
.'<td class="F12 " >'.$workname.'</td>'
.'</tr>'
.'</table>'
.'<hr class="" style="margin:2px;" color="black" size="2%"/>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;margin-top:10px;" >'
.'<tr>'
.'<td class="l" style="width:15%;padding-left:2%;">No</td>'
.'<td class="l">'.$flatno.'</td>'
.'<td class="l" style="width:15%;padding-right:2%;" >Type</td>'
.'<td class="r" style="width:15%;padding-right:2%;">'.$bhkname.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Done by</td>'
.'<td class="l F12" id="empname'.$flatid.'" >'.$zname2.'</td>'
.'<td class="l" style="width:15%;padding-right:2%;" >Date</td>'
.'<td class="r" style="width:20%;padding-right:2%;" id="date'.$flatid.'">'.$zdate.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Status</td>'
.'<td class="l"><strong id="holdA'.$flatid.'" >'.$zhold1. '</strong><strong style="color:red;" id="holdB'.$flatid.'">'.$zhold2.'</strong></td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Payment</td>'
.'<td class="r" style="width:20%;padding-right:2%;color:'.$color1.';" id="status'.$flatid.'">'.$zpayment.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Work Period</td>'
.'<td class="l">'.$count.' days  <small onclick="getatt('.$flatid.')" data-toggle="modal" data-target="#exampleModalCenter" style="margin-left:7px;" class="F8 mybutton"><i class="fa F15 fa-info"></i> info</small></td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Lock Status</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$zlock.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Total Mason </td>'
.'<td class="l">'.$mason.'</td>'
.'<td class="l" style="width:20%;padding-right:2%;" >Total Helper</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$helper.'</td>'
.'</tr>'
.'<tr>'
.'<td class="l" style="width:20%;padding-left:2%;">Started</td>'
.'<td class="l">'.$start.'</td>'
.'<td class="l" style="width:20%;padding-right:2%;" >End</td>'
.'<td class="r" style="width:20%;padding-right:2%;">'.$end.'</td>'
.'</tr>'
.'</table>'
.'<hr class="" style="margin:4px;" color="black" size="2%"/>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;margin-top:8px;" >'
.'<tr>'
.'<td class="l" style="width:40%;padding-left:2%;">Update Employee</td>'
.'<td class="c" style="width:60%;padding-right:2%;">'
.'<select class="mycontainer" style="hieght:10px;width:100%;outline:none;" id="name'.$flatid.'">';

$p ="";
$req6 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='Restore' and `project`='$project'";
$run6 = mysqli_query($con, $req6);
while ($result6= mysqli_fetch_assoc($run6))
{
$empname = $result6["name"];
$empid = $result6["id"];
$p =$p+1;
if($p==1 && $zname=="")
{
$zname = $empid;
}
else
{
$zname = $zname;
}
echo '<option value="'.$empid.'">'.$empname.'</option>';
}
if($group2>0)
{
echo '<script>document.getElementById("name'.$flatid.'").value = "'.$group2.'";</script>';
}
else
{
echo '<script>document.getElementById("name'.$flatid.'").value = "'.$zname.'";</script>';
}
  
echo '</select>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr style="display:none;">'
.'<td class="l" style="width:40%;padding-left:2%;">'.$mytext.'</td>'
.'<td class="r" style="width:60%;padding-right:2%;height:20px;">'
.'<input type="number" value="'.$rate.'" id="rate'.$flatid.'" class="myinput" style="height:20px;width:40%;outline:none;background-color:white;display:'.$input.';">'
.'<select class="mycontainer F12" style="hieght:10px;width:40%;outline:none;display:'.$select.'" id="hold'.$flatid.'">';
for ($z = 0; $z <= 51; $z++) {
if($z==15)
{
echo '<option value="'.$z.'" selected>'.$z.'%</option>';
}else{
 echo '<option value="'.$z.'">'.$z.'%</option>';
}}
  echo '<script>document.getElementById("hold'.$flatid.'").value = "25";</script>';
  if($sqft==1)
  {
  echo '<script>document.getElementById("hold'.$flatid.'").value = "0";</script>';
  }
echo '</select>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<table class="F9"  style="width:100%;text-align:center;font-weight:bold;font-family:times;" >'
.'<tr style="display:none;">'
.'<td class="l" style="width:40%;padding-left:2%;">Payment credit to employee A/C</td>'
.'<td class="r" style="width:60%;padding-right:2%;">'
.'<label class="switch">'
.'<input type="checkbox" id="payment'.$flatid.'" >'
.'<span class="slider round"></span></label></td>'
.'</td>'
.'</tr>'
.'</table>'
.'<br>'
.'<p class="F12" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;">Attachments<div class="upload-btn-wrapper F10 mybutton" style="float:right;font-weight:bold;font-family:times;margin-right:6px;height:15px;width:100px;">'
.'<button   style="height:100%;width:100%;" > '
.'<input type="file" style="" class="myfileZ" onclick="getref('.$flatid.');" refA="'.$workname.'" refB="'.$project.$wing.$flatno.$worknameid.'" name="myfile'.$flatid.'" id="myfile'.$flatid.'"> Upload file'
.'</button>'
.'</div>'
.'</p><table border="1" style="width:70%;" id="g'.$flatno.'">';
$reflink =$project.$wing.$flatno.$worknameid;
$sql1c= "SELECT * FROM `AAfolder` WHERE `user`='$encUser' and `ext2`='$reflink' and `type`='file'";
$result1c = mysqli_query($con, $sql1c);
while ( $resultlink =mysqli_fetch_assoc($result1c))
{
$fileid =$resultlink["id"];
$filenamep =$resultlink["filename"];
$filelink = $resultlink["filecodename"].".".$resultlink["ext1"];
echo '<tr id="frow'.$fileid.'"><td><p class="F12" id="filename'.$fileid.'" onclick="showfile2('.$fileid.');" ext="'.$resultlink["ext1"].'" link="'.$filelink.'" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;color:blue;">'.$filenamep.'</p></td><td><i id="ff'.$fileid.'" rfname="'.$filenamep.'" onclick="fdelete('.$fileid.')" rf="'.$reflink.'" class="F12 fa fa-trash" style="color:red;"></i></td></tr>';
}
echo '</table><br>'
.'<p class="F9" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;text-align:center;"><strong style="" >Issued materials</strong></p>'
.'<div class="myinput" style="width:94%;margin-left:3%;overflow:scroll;height:60px;" >'
.'<table border="1" class="F9" style="width:96%;margin:2%;">';
      
      $flatnoxx =$result2["flat"];
      $req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flatnoxx' and `ext1`='$work'";
      $reqRbb = mysqli_query($con, $req1bb);
      while ( $resultbb =mysqli_fetch_assoc($reqRbb))
      {
      $zid = $resultbb["id"];
      $zname = $resultbb["emp"];
      $zitem = $resultbb["item"];
      $zqty = $resultbb["qty"];
      $zunit = $resultbb["unit"];
      
      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];

      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];

echo '<tr>'
.'<td>'.$workname.'</td>'
.'<td class="c" >'.$zqty." ".$zunit.'</td>'
.'<td class="r"  >Recieved by '.$worknamem.'</td>'
.'</tr>';
}


echo '</table>'
.'</div>'
.'<p class="F9" style="padding-left:2%;padding-right:2%;font-weight:bold;font-family:times;" >Remark of the work <strong style="float:right;color:red;" >'.$zaddedby2.'</strong></p>'
.'<textarea class="F9" style="margin-left:2%;height:50px;resize:none;outline:none;width:96%;font-weight:bold;font-family:times;" id="remark'.$flatid.'">'.$zremark.'</textarea>'
.'<table class="F9 c" style="width:96%;margin-left:2%;" >'
.'<tr>'
.'<td style="width:33%;"><button class="mybutton" style="width:80%;display:'.$mydis.';" onclick="cleardata('.$flatid.');">Clear all data</button></td>'
.'<td style="width:34%;"><button class="mybutton" style="width:80%;display:'.$mydis.';" onclick="update('.$flatid.')" >Update work</button></td>'
.'<td style="width:33%;"><button class="mybutton" style="width:80%;display:'.$mydis2.';" id="kk'.$flatid.'" onclick="request('.$flatid.')">'.$myunlock.'</button></td>'
.'</tr>'
.'</table>'
.'</div>'
.'</div>';
}


































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


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content mycontainer">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body myinput" id="mm">
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn F12 btn-secondary mybutton" style="height:20px;outline:none;"  data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
var letters = "/^[A-Z a-z 0-9]+$/";
var id = "<?php echo $encId; ?>";
var User = "<?php echo $encUser; ?>";
var token = "<?php echo $encToken; ?>";
var work = "<?php echo $work; ?>";
var url = "<?php echo $url; ?>";
var wing = "<?php echo $wing; ?>";
var project = "<?php echo $project; ?>";
var ref2 = "<?php echo $ref2; ?>";
var wingname = "<?php echo $wingnameX; ?>";
var zz=0;
var s=0;
var myflat ="";


function getatt(z)
{
document.getElementById("mm").innerHTML = "";
var flat = document.getElementById("flat"+z).value;

var req2g=new XMLHttpRequest();
req2g.open("GET",url+"flatatt.php?id="+id+"&user="+User+"&token="+token+"&project="+project+"&wing="+wing+"&flat="+flat+"&work="+work,true);
req2g.onreadystatechange=function(){
if(req2g.readyState==4 && req2g.status==200){if( req2g.responseText =="ufFygf")
{  

}else{

document.getElementById("mm").innerHTML = req2g.responseText.trim();
 
}}}
req2g.send();
}

function request(z)
{
var flatworkid = document.getElementById("flatworkid"+z).value;
var req2g=new XMLHttpRequest();
req2g.open("GET",url+"workunlock.php?id="+id+"&user="+User+"&token="+token+"&ref="+flatworkid,true);
req2g.onreadystatechange=function(){
if(req2g.readyState==4 && req2g.status==200){if( req2g.responseText =="ufFygf")
{  

}else{

document.getElementById("kk"+z).innerHTML = "Requested";
 
}}}
req2g.send();
}





function update(z)
{
window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
var flatworkid = document.getElementById("flatworkid"+z).value;
var flat = document.getElementById("flat"+z).value;
var bhk = document.getElementById("bhk"+z).value;
var work = document.getElementById("work"+z).value;
var sqft = document.getElementById("sqft"+z).value;
var rate = document.getElementById("rate"+z).value;
var name = document.getElementById("name"+z).value;
var hold = document.getElementById("hold"+z).value;
var payment = document.getElementById("payment"+z).checked;
var remark = document.getElementById("remark"+z).value;


var req2=new XMLHttpRequest();
req2.open("GET",url+"addflatwork.php?id="+id+"&user="+User+"&token="+token+"&project="+project+"&wing="+wing+"&bhk="+bhk+"&flatworkid="+flatworkid+"&flat="+flat+"&work="+work+"&sqft="+sqft+"&rate="+rate+"&name="+name+"&hold="+hold+"&payment="+payment+"&remark="+remark,true);
req2.onreadystatechange=function(){
if(req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
{  

}else{


 var  rec = JSON.parse( req2.responseText.trim() );
 var  idz =rec.id;
 var  name2 =rec.name;
 var  date =rec.date;
 document.getElementById("flatworkid"+z).value=idz;
 document.getElementById("empname"+z).innerHTML=name2;
 document.getElementById("date"+z).innerHTML=date;
 document.getElementById("rowA"+z).style.backgroundColor="#a0fad4";
 document.getElementById("rowB"+z).style.backgroundColor="#a0fad4";
 
 document.getElementById("holdA"+z).innerHTML=100-hold + "% Done ";
 document.getElementById("holdB"+z).innerHTML=hold*-1 +"% Hold";
 if(payment==true)
 {
 document.getElementById("status"+z).innerHTML="Done";
 document.getElementById("status"+z).style.color="";
 }
 else
 {
 document.getElementById("status"+z).innerHTML="Not Done";
 document.getElementById("status"+z).style.color="red";
 }
 window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
}}}
req2.send();
}
var ref1 ="";
function getref(p)
{
s=p;
zz= document.getElementById("myfile"+p).getAttribute("refB");
myflat = document.getElementById("flat"+p).value;
var workname = document.getElementById("myfile"+p).getAttribute("refA");

    var checkfile =workname;
    
	var req5=new XMLHttpRequest();
	req5.open("GET",url+"checkfolder2.php?id="+id+"&user="+User+"&token="+token+"&fileid=0&ref2="+ref2+"&filename2="+checkfile+"&filename="+wingname,true);
	req5.onreadystatechange=function(){
if(	req5.readyState==4 && req5.status==200){if(req5.responseText=="ufFygf")
{  

}else{
  ref1=req5.responseText.trim();
  
  
}}}
	req5.send();
}
	
$(".myfileZ").change(function(){
  uploadFile2();
  });

function addfile(m)
{
var req5=new XMLHttpRequest();
	req5.open("GET",url+"addfile.php?id="+id+"&user="+User+"&token="+token+"&fid="+m,true);
	req5.onreadystatechange=function(){
if(req5.readyState==4 && req5.status==200){if(req5.responseText=="ufFygf")
{  

}else{

  document.getElementById("g"+myflat).innerHTML= req5.responseText.trim();
}}}
	req5.send();
}


function _(el){return document.getElementById(el); }

 function uploadFile2()
 { 
 var d = new Date();
var mydate = d.getDate()+"-"+d.getMonth()+"-"+d.getFullYear()+" "+d.getHours()+"_"+d.getMinutes()+"_"+d.getSeconds();
 var myfilename =myflat+" "+mydate;

var filep= _("myfile"+s).files[0]; 	
 //alert(filep.name+" | "+filep.size+" | "+filep.type);
var formdata = new FormData(); 
formdata.append("myfile"+s, filep); 
var ajax = new XMLHttpRequest(); 
ajax.upload.addEventListener("progress", progressHandler, false); 	
ajax.addEventListener("load", completeHandler, false); 	
ajax.addEventListener("error", errorHandler, false); 	
ajax.addEventListener("abort", abortHandler, false); 
ajax.open("POST",url+"uploadfolder2.php?id="+id+"&user="+User+"&token="+token+"&s="+s+"&filecodename=&filename="+myfilename+"&ref3=4&type=file&position=1&ref1="+ref1+"&ext2="+zz+"&ref2="+ref2);
ajax.send(formdata); 
function progressHandler(event){ 	
var percent = (event.loaded / event.total) * 100; 	
			//_("progressBar").value = Math.round(percent); 
prog(percent);
if(percent==100){addfile(zz);}
} 
function completeHandler(event){ 
addfile(zz);
window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');	
} function errorHandler(event){ 

} function abortHandler(event){ 
} 
}


function showfile2(pp)
{

var myfilename =document.getElementById("filename"+pp).getAttribute("link");
var myfileext =document.getElementById("filename"+pp).getAttribute("ext");
window.top.postMessage('{"id":11,"data1":"'+myfilename+'","data2":"'+myfileext+'","data3":"","data4":""}','*');
}

function deletefile(m)
{
window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
var req5=new XMLHttpRequest();
	req5.open("GET",url+"deletefile.php?id="+id+"&user="+User+"&token="+token+"&fid="+m,true);
	req5.onreadystatechange=function(){
if(req5.readyState==4 && req5.status==200){if(req5.responseText=="ufFygf")
{  

}else{
  window.top.postMessage('{"id":4,"data1":"","data2":"","data3":"","data4":""}', '*');
  document.getElementById("frow"+m).style.display="none";
}}}
	req5.send();
}



function fdelete(b)
{
var mycombref =document.getElementById("ff"+b).getAttribute("rf");
var rfname =document.getElementById("ff"+b).getAttribute("rfname");
window.top.postMessage('{"id":12,"data1":"'+mycombref+'","data2":"'+b+'","data3":"'+rfname+'","data4":""}','*');

}
window.onmessage = function(e) {
    var  req = JSON.parse(e.data);
    var    reqid =req.id;
    var    reqdata1 =req.data1;
    var    reqdata2 =req.data2;
    var    reqdata3 =req.data3;
    var    reqdata4 =req.data4;
    if(reqid==13)
    {
    deletefile(reqdata1);
    }
    if(reqid==14)
    {
    cleardata2(reqdata1);
    }
    if(reqid==15)
    {
    deleteflat2(reqdata1);
    }
 }
 
 function cleardata(z)
 {
 window.top.postMessage('{"id":13,"data1":"'+z+'","data2":"","data3":"","data4":""}','*');
 }
 function deleteflat(z)
 {
 window.top.postMessage('{"id":14,"data1":"'+z+'","data2":"","data3":"","data4":""}','*');
 }
 
 function deleteflat2(z)
 {
 window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
 var flatworkid = document.getElementById("flatworkid"+z).value;
 var req15=new XMLHttpRequest();
 req15.open("GET",url+"deleteflat.php?id="+id+"&user="+User+"&token="+token+"&fid="+z+"&wid="+flatworkid,true);
 req15.onreadystatechange=function(){
 if(req15.readyState==4 && req15.status==200){if(req15.responseText=="ufFygf")
 {  
 
 }else{
 
 document.getElementById("rowA"+z).style.display="none";
 document.getElementById("rowB"+z).style.display="none";
 
 window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
 }}}
 req15.send();
 
 }
 
 function cleardata2(z)
 {
 window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
 var flatworkid = document.getElementById("flatworkid"+z).value;
 var req15=new XMLHttpRequest();
 req15.open("GET",url+"deleteworkid.php?id="+id+"&user="+User+"&token="+token+"&wid="+flatworkid,true);
 req15.onreadystatechange=function(){
 if(req15.readyState==4 && req15.status==200){if(req15.responseText=="ufFygf")
 {  
 
 }else{
 
 document.getElementById("empname"+z).innerHTML="No record";
 document.getElementById("date"+z).innerHTML="00/00/000";
 document.getElementById("rowA"+z).style.backgroundColor="#E6E6E6";
 document.getElementById("rowB"+z).style.backgroundColor="#E6E6E6";
 
 document.getElementById("holdA"+z).innerHTML="No record";
 document.getElementById("holdB"+z).innerHTML="";
 document.getElementById("status"+z).innerHTML="Not Done";
 window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
 }}}
 req15.send();
 
 }
</script>
</body>
</html>


