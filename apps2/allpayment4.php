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
$myreq =$_GET["req"];
$fdate =$_GET["fdate"];
$ldate =$_GET["ldate"];
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

$sqle2lg = "SELECT * FROM `Dates`";
$resulte2lg = mysqli_query($con, $sqle2lg);
    while($rowe2lg = mysqli_fetch_assoc($resulte2lg)) {
    
	$Tdate = $rowe2lg["dates"] ;
		
	}
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



$match ="";
$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' AND `type`!='grp' AND `datetime` between '$Tdate' AND '$date' ORDER BY `name` DESC";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

 $userid =$row8['addedby'];
 $useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 $sql10= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
 $result10 = mysqli_query($con, $sql10);
 $row10 = mysqli_fetch_assoc($result10);
 
 $uname =$row10['name'];
 
 
 $userid2 =$row8['updatedby'];
 $useridenc2=openssl_decrypt ( $userid2 , $ciphering, $dec_key, $options, $dec_iv);
 $sql11= "SELECT * FROM `AAuser` WHERE `id`='$useridenc2'";
 $result11 = mysqli_query($con, $sql11);
 $row11 = mysqli_fetch_assoc($result11);
 $ustr ="";
 $uname2 =$row11['name'];
 
   $x = $row8['id'];
   $empname  = $row1['name'];
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $ext1 = $row8['ext1'];
   
   $checked="";
   if($ext1=="true")
   {
   $checked="checked";
   }
   else
   {
   $checked="";
   }
   $d2=strtotime($row8['datetime']);
   
   $datetime = date("d-m-Y", $d2);
   $time2 = $row8['time'];
   
   if(strlen($uname2)>1)
   {
   $ustr ='Updated by '.$uname2.' <button class="mybutton" style="padding-left:10px;outline:none;border:none;text-align:center;" data-toggle="collapse" data-target="#collapseOne'.$x.'" aria-expanded="false" aria-controls="collapseOne'.$x.'"><i class="fa fa-info"></i></button>';
   }
   else
   {
   $ustr ="";
   }
   $style="";
   if($empname==$match)
   {
   $style="background-color:#a8a632;width:90%;margin-bottom:3%;margin-left:8%;";
   }
   else
   {
   $style="width:96%;margin-bottom:3%;margin-left:2%;";
   }
   
   $match = $empname;
   echo '<input type="hidden" value="'.$empid.'" id="empid'.$x.'">';
   echo '<div id="row'.$x.'" ><div class="mycontainer" style="'.$style.'">'
   .'<table style="width:100%;">'
   .'<tr style="height:15px;"><td colspan="2"></td><td colspan="2" style="text-align:right;" class="F8">Show transaction in employee application</td><td style="text-align:center;"><input type="checkbox" onchange="change2('.$x.')" '.$checked.' id="mycheck'.$x.'" class="F12 " style="width:17px;height:25px;margin:0px;padding:0px;"></td></tr>'
   
   .'<tr style="height:15px;"><td colspan="4" class="F15" style="font-weight:bold;font-family:times;padding-left:10px;">'.$empname.'</td></tr>'
   .'<tr>'
   .'<td class="F14" style="width:26%;text-align:left;font-family:times;font-weight:bold;padding-left:10px;" >'.$x.'</td>'
   .'<td class="F14" style="width:26%;text-align:center;font-family:times;font-weight:bold;" id="dateb'.$x.'">'.$empdate.'</td>'
   .'<td class="F14" style="width:26%;padding-right:20px;text-align:right;font-family:times;font-weight:bold;" ><strong id="amountb'.$x.'" class="check" >'.$empamount.'</strong><strong>/-</strong></td>'
   .'<td class="F14" style="width:11%;text-align:center;font-family:times;font-weight:bold;" ><button class="mybutton" style="outline:none;border:none;text-align:center;" data-toggle="collapse" data-target="#collapsetwo'.$x.'" aria-expanded="false" aria-controls="collapsetwo'.$x.'"><i class="fa fa-edit"></i></button></td>'
   .'</tr>'
   .'<tr>'
   .'<td class="F10" style="padding-left:10px;text-align:left;font-family:times;font-weight:bold;" colspan="4" id="remarkb'.$x.'" >'.$empremarks.'</td>'
   .'<td style="width:11%;text-align:center;font-family:times;font-weight:bold;"><button class="mybutton" style="outline:none;border:none;text-align:center;" onclick="rowdelete('.$x.');"><i class="fa fa-trash"></i></button></td>'
   .'</tr>'
   .'<tr>'
   .'<td class="F7" style="text-align:right;font-family:times;font-weight:bold;color:red;padding-right:15px;" colspan="2" >'.$ustr.'</td>'
   .'<td class="F8" style="text-align:right;font-family:times;font-weight:bold;color:red;padding-right:15px;" colspan="3" >Added by _ '.$uname.' '.$datetime.'_'.$time2.'</td>'
   .'</tr>'
   .'</table>'
   .'</div>'
   .'<div style="width:100%;" id="collapseOne'.$x.'" class="collapse " aria-labelledby="headingOne'.$x.'" data-parent="">'
   .'<div style="width:100%;" class="card-body myinput" style="font-weight:bold;font-family:times;">';
   
   $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `type`='money' and `focus`='$x' ORDER BY `id` DESC";
   $resultfind = mysqli_query($con, $find);
   while($rowfind = mysqli_fetch_array($resultfind))
   {
   $description =$rowfind["description"];
   $title =$rowfind["title"];
   $rowid =$rowfind["id"];
   $rowdate =$rowfind["date"];
   $rowtime =$rowfind["time"];
   $rowuser =$rowfind["addedby"];
   
   $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$rowuser'";
   $resultmobile2 = mysqli_query($con, $sqlmobile2);
   $rowe3d = mysqli_fetch_assoc($resultmobile2);
   $uname3 = $rowe3d['name'];
   
   echo "<p>".$uname3." updated</p>";
   echo "<p>".$title."</p>";
   echo '<p style="width:95%;text-align:right;">'.$rowdate.'_'.$rowtime.'</p><hr>';
   
   }
   
   echo '<div style="width:94%;text-align:right;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" data-toggle="collapse" data-target="#collapseOne'.$x.'" aria-expanded="false" aria-controls="collapseOne'.$x.'">Close</button></div>'
   .'</div>'
   .'</div>'
   
   .'<div style="width:100%;" id="collapsetwo'.$x.'" class="collapse " aria-labelledby="headingtwo'.$x.'" data-parent="">'
   .'<div style="width:100%;" class="card-body mycontainer" style="font-weight:bold;font-family:times;">'
   .'<table style="width:100%;"><tr>'
   .'<td style="width:50%;text-align:center;" ><div class="mycontainer" style="width:80%;margin-left:10%;text-align:center;"><input style="margin:5px;width:92%;" class="myinput" type="date" id="date'.$x.'" value="'.$empdatef.'"></div></td>'
   .'<td colspan="2" style="width:50%;text-align:center;"><div class="mycontainer" style="width:80%;margin-left:10%;text-align:center;"><input style="margin:5px;width:92%;" class="myinput"type="number" id="amount'.$x.'" value="'.$empamount.'"></div></td></tr><tr>'
   .'<td colspan="3"><div class="mycontainer" style="width:90%;text-align:left;margin-left:5%;"><input style="margin:5px;width:97%;" class="myinput"type="text" id="remark'.$x.'" value="'.$empremarks.'"></div></td></tr><tr>'
   .'<td style="text-align:center;width:33%;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" onclick="update('.$x.')" >Update</button></td>'
   .'<td style="text-align:center;"></td>'
   .'<td style="text-align:center;width:33%;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" data-toggle="collapse" data-target="#collapsetwo'.$x.'" aria-expanded="false" aria-controls="collapsetwo'.$x.'">Close</button></td>'
   .'</tr></table>'
   .'</div>'
   .'</div><br>'
   .'</div></div>';

}















}
else
{
if ($active=="active")
{
$check1=0;
$check2=0;
$check3=0;
$check4=0;
$check5=0;
$check6=0;
$permissionA = explode(",",$permissionArray);
for ($x = 0; $x <= count($permissionA); $x++) 
{
if($permissionA[$x]==19)
{
$check1 =1; //update paid
}
if($permissionA[$x]==20)
{
$check2 =1; //update salary
}
if($permissionA[$x]==21)
{
$check3 =1; //delete paid
}
if($permissionA[$x]==22)
{
$check4 =1; //delete salary
}
if($permissionA[$x]==6)
{
$check5 =1; //delete salary
}
if($permissionA[$x]==7)
{
$check6 =1; //delete salary
}
}



$match ="";
$sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' AND `type`!='grp' AND `datetime` between '$Tdate' AND '$date' ORDER BY `name` DESC";
$result8 = mysqli_query($con, $sql8);
while ($row8 = mysqli_fetch_assoc($result8))
{
$empid =$row8['name'];
$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

 $userid =$row8['addedby'];
 $useridenc=openssl_decrypt ( $userid , $ciphering, $dec_key, $options, $dec_iv);
 $sql10= "SELECT * FROM `AAuser` WHERE `id`='$useridenc'";
 $result10 = mysqli_query($con, $sql10);
 $row10 = mysqli_fetch_assoc($result10);
 
 $uname =$row10['name'];
 
 
 $userid2 =$row8['updatedby'];
 $useridenc2=openssl_decrypt ( $userid2 , $ciphering, $dec_key, $options, $dec_iv);
 $sql11= "SELECT * FROM `AAuser` WHERE `id`='$useridenc2'";
 $result11 = mysqli_query($con, $sql11);
 $row11 = mysqli_fetch_assoc($result11);
 $ustr ="";
 $uname2 =$row11['name'];
 
   $x = $row8['id'];
   $empname  = $row1['name'];
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $ext1 = $row8['ext1'];
   
   $checked="";
   if($ext1=="true")
   {
   $checked="checked";
   }
   else
   {
   $checked="";
   }
   $d2=strtotime($row8['datetime']);
   
   $datetime = date("d-m-Y", $d2);
   $time2 = $row8['time'];
   
   if(strlen($uname2)>1)
   {
   $ustr ='Updated by '.$uname2.' <button class="mybutton" style="padding-left:10px;outline:none;border:none;text-align:center;" data-toggle="collapse" data-target="#collapseOne'.$x.'" aria-expanded="false" aria-controls="collapseOne'.$x.'"><i class="fa fa-info"></i></button>';
   }
   else
   {
   $ustr ="";
   }
   $style="";
   if($empname==$match)
   {
   $style="background-color:#a8a632;width:90%;margin-bottom:3%;margin-left:8%;";
   }
   else
   {
   $style="width:96%;margin-bottom:3%;margin-left:2%;";
   }
   
   $match = $empname;
   echo '<input type="hidden" value="'.$empid.'" id="empid'.$x.'">';
   echo '<div id="row'.$x.'" ><div class="mycontainer" style="'.$style.'">'
   .'<table style="width:100%;">';
   
   if($check1==1){echo '<tr style="height:15px;"><td colspan="2"></td><td colspan="2" style="text-align:right;" class="F8">Show transaction in employee application</td><td style="text-align:center;"><input type="checkbox" onchange="change2('.$x.')" '.$checked.' id="mycheck'.$x.'" class="F12 " style="width:17px;height:25px;margin:0px;padding:0px;"></td></tr>';}
   
   echo '<tr style="height:15px;"><td colspan="4" class="F15" style="font-weight:bold;font-family:times;padding-left:10px;">'.$empname.'</td></tr>'
   .'<tr>'
   .'<td class="F14" style="width:26%;text-align:left;font-family:times;font-weight:bold;padding-left:10px;" >'.$x.'</td>'
   .'<td class="F14" style="width:26%;text-align:center;font-family:times;font-weight:bold;" id="dateb'.$x.'">'.$empdate.'</td>'
   .'<td class="F14" style="width:26%;padding-right:20px;text-align:right;font-family:times;font-weight:bold;" ><strong id="amountb'.$x.'" class="check" >'.$empamount.'</strong><strong>/-</strong></td>'
   .'<td class="F14" style="width:11%;text-align:center;font-family:times;font-weight:bold;" >';
   
   if($check1==1){echo '<button class="mybutton" style="outline:none;border:none;text-align:center;" data-toggle="collapse" data-target="#collapsetwo'.$x.'" aria-expanded="false" aria-controls="collapsetwo'.$x.'"><i class="fa fa-edit"></i></button>';}
   
   echo '</td>'
   .'</tr>'
   .'<tr>'
   .'<td class="F10" style="padding-left:10px;text-align:left;font-family:times;font-weight:bold;" colspan="4" id="remarkb'.$x.'" >'.$empremarks.'</td>'
   .'<td style="width:11%;text-align:center;font-family:times;font-weight:bold;"></td>'
   .'</tr>'
   .'<tr>'
   .'<td class="F7" style="text-align:right;font-family:times;font-weight:bold;color:red;padding-right:15px;" colspan="2" >'.$ustr.'</td>'
   .'<td class="F8" style="text-align:right;font-family:times;font-weight:bold;color:red;padding-right:15px;" colspan="3" >Added by _ '.$uname.' '.$datetime.'_'.$time2.'</td>'
   .'</tr>'
   .'</table>'
   .'</div>'
   .'<div style="width:100%;" id="collapseOne'.$x.'" class="collapse " aria-labelledby="headingOne'.$x.'" data-parent="">'
   .'<div style="width:100%;" class="card-body myinput" style="font-weight:bold;font-family:times;">';
   
   $find = "SELECT * FROM `AAalert` WHERE `mainuser`='$encUser' and `type`='money' and `focus`='$x' ORDER BY `id` DESC";
   $resultfind = mysqli_query($con, $find);
   while($rowfind = mysqli_fetch_array($resultfind))
   {
   $description =$rowfind["description"];
   $title =$rowfind["title"];
   $rowid =$rowfind["id"];
   $rowdate =$rowfind["date"];
   $rowtime =$rowfind["time"];
   $rowuser =$rowfind["addedby"];
   
   $sqlmobile2 = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `id`='$rowuser'";
   $resultmobile2 = mysqli_query($con, $sqlmobile2);
   $rowe3d = mysqli_fetch_assoc($resultmobile2);
   $uname3 = $rowe3d['name'];
   
   echo "<p>".$uname3." updated</p>";
   echo "<p>".$title."</p>";
   echo '<p style="width:95%;text-align:right;">'.$rowdate.'_'.$rowtime.'</p><hr>';
   
   }
   
   echo '<div style="width:94%;text-align:right;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" data-toggle="collapse" data-target="#collapseOne'.$x.'" aria-expanded="false" aria-controls="collapseOne'.$x.'">Close</button></div>'
   .'</div>'
   .'</div>'
   
   .'<div style="width:100%;" id="collapsetwo'.$x.'" class="collapse " aria-labelledby="headingtwo'.$x.'" data-parent="">'
   .'<div style="width:100%;" class="card-body mycontainer" style="font-weight:bold;font-family:times;">'
   .'<table style="width:100%;"><tr>'
   .'<td style="width:50%;text-align:center;" ><div class="mycontainer" style="width:80%;margin-left:10%;text-align:center;"><input style="margin:5px;width:92%;" class="myinput" type="date" id="date'.$x.'" value="'.$empdatef.'"></div></td>'
   .'<td colspan="2" style="width:50%;text-align:center;"><div class="mycontainer" style="width:80%;margin-left:10%;text-align:center;"><input style="margin:5px;width:92%;" class="myinput"type="number" id="amount'.$x.'" value="'.$empamount.'"></div></td></tr><tr>'
   .'<td colspan="3"><div class="mycontainer" style="width:90%;text-align:left;margin-left:5%;"><input style="margin:5px;width:97%;" class="myinput"type="text" id="remark'.$x.'" value="'.$empremarks.'"></div></td></tr><tr>'
   .'<td style="text-align:center;width:33%;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" onclick="update('.$x.')" >Update</button></td>'
   .'<td style="text-align:center;"></td>'
   .'<td style="text-align:center;width:33%;"><button class="mybutton" style="outline:none;border:none;text-align:center;width:70px;" data-toggle="collapse" data-target="#collapsetwo'.$x.'" aria-expanded="false" aria-controls="collapsetwo'.$x.'">Close</button></td>'
   .'</tr></table>'
   .'</div>'
   .'</div><br>'
   .'</div></div>';

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



  










<script>
var letters = "/^[A-Z a-z 0-9]+$/";
var id = "<?php echo $encId; ?>";
var User = "<?php echo $encUser; ?>";
var token = "<?php echo $encToken; ?>";
var empid = "<?php echo $empid; ?>";
var req = "AAPaid";
var url = "<?php echo $url; ?>";

var row=0;
function rowdelete(row)
{
row=row;
window.top.postMessage('{"id":5,"data1":"Are you sure want to delete?","data2":"","data3":"","data4":""}', '*');
}



function edit()
{
window.top.postMessage('hello', '*');
}
window.onmessage = function(e) {

    var  reqp = JSON.parse(e.data);
    var    reqid =reqp.id;
    var    reqdata1 =reqp.data1;
    var    reqdata2 =reqp.data2;
    var    reqdata3 =reqp.data3;
    var    reqdata4 =reqp.data4;
    if(reqid==6)
    {
    
    var amount2 =document.getElementById("amountb"+reqdata1).innerHTML;
    var date2 =document.getElementById("dateb"+reqdata1).innerHTML;
    var remark2 =document.getElementById("remarkb"+reqdata1).innerHTML;
    
   
    window.top.postMessage('{"id":1,"data1":"","data2":"","data3":"'+myamount.toFixed(2)+'","data4":""}', '*');
    var reqrefresh2 =new XMLHttpRequest();
    reqrefresh2.open("GET",url+"deletemoney.php?id="+id+"&user="+User+"&token="+token+"&amount2="+amount2+"&date2="+date2+"&remark2="+remark2+"&empid="+empid+"&uid="+reqdata1+"&req="+req,true);
    reqrefresh2.onreadystatechange=function(){
    if(reqrefresh2.readyState==4 && reqrefresh2.status==200){if(reqrefresh2.responseText=="ufFygf")
    {  
    
    }else{
   // alert(reqrefresh2.responseText.trim());
    document.getElementById("row"+reqdata1).style.display="none";
    change();
    window.top.postMessage('{"id":4,"data1":"Seccessfully deleted","data2":"","data3":"'+myamount.toFixed(2)+'","data4":""}', '*');
    }}}
    reqrefresh2.send();
    
    
    }
    
}


function change()
{
var myamount =0;
var i=0;
var inputs = document.getElementsByClassName("check");
for( i = 0; i < inputs.length; i++) {
        
          myamount2 =parseInt(inputs[i].innerHTML);
        myamount = myamount+myamount2;


}

window.top.postMessage('{"id":100,"data3":'+myamount.toFixed(2)+',"data2":"","data1":"","data4":"","p1":"10","p2":"20","p3":"30","p4":"40","p5":"50"}', '*');
}
change();
window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"'+myamount.toFixed(2)+'","data4":""}', '*');
function update(v)
{

var amount = document.getElementById("amount"+v).value;
var date = document.getElementById("date"+v).value;
var remark = document.getElementById("remark"+v).value;
var empid = document.getElementById("empid"+v).value;

var amount2 =document.getElementById("amountb"+v).innerHTML;
var date2 =document.getElementById("dateb"+v).innerHTML;
var remark2 =document.getElementById("remarkb"+v).innerHTML;


if(1==1)
{
if(amount.length>=0)
{
window.top.postMessage('{"id":1,"data1":"","data2":"","data3":"'+myamount.toFixed(2)+'","data4":""}', '*');
var reqrefresh=new XMLHttpRequest();
reqrefresh.open("GET",url+"updatemoney.php?id="+id+"&user="+User+"&token="+token+"&amount="+amount+"&date="+date+"&remark="+remark+"&amount2="+amount2+"&date2="+date2+"&remark2="+remark2+"&empid="+empid+"&uid="+v+"&req="+req,true);
reqrefresh.onreadystatechange=function(){
if(reqrefresh.readyState==4 && reqrefresh.status==200){if(reqrefresh.responseText=="ufFygf")
{  

}else{

document.getElementById("amountb"+v).innerHTML =amount;
var mydate =date.split("-");
    mydate = mydate[2]+"/"+mydate[1]+"/"+mydate[0];
document.getElementById("dateb"+v).innerHTML=mydate;
document.getElementById("remarkb"+v).innerHTML=remark;
change();
window.top.postMessage('{"id":3,"data1":"Seccessfully updated","data2":"","data3":"'+myamount.toFixed(2)+'","data4":"","p1":"10","p2":"20","p3":"30","p4":"40","p5":"50"}', '*');
$('#collapsetwo'+v).collapse('hide');
}}}
reqrefresh.send();
}
else
{
alert("Amount should be grater than zero or equal to zero");
}
}
else
{
alert("Please remove special charactor in remark field");
}

}

function change2(X)
{
var value = document.getElementById("mycheck"+X).checked;

   window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
   var reqrefresh3 =new XMLHttpRequest();
   reqrefresh3.open("GET",url+"moneycheck.php?id="+id+"&user="+User+"&token="+token+"&value="+value+"&ref="+X+"&req="+req,true);
   reqrefresh3.onreadystatechange=function(){
   if(reqrefresh3.readyState==4 && reqrefresh3.status==200){if(reqrefresh3.responseText=="ufFygf")
   {  
   
   }else{
   window.top.postMessage('{"id":3,"data1":"Seccessfully updated","data2":"","data3":"","data4":""}', '*');
   }}}
   reqrefresh3.send();
   
}

</script>
</div>
</body>
</html>