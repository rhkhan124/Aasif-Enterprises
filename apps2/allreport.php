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
.cell1
{
text-align:center;
width:50%;
}
.cell2
{
text-align:center;
width:20%;
}
.cell3
{
text-align:center;
width:20%;
}
.cell4
{
text-align:center;
width:10%;
}
 body{background:#E6E6E6;}.mycontainer{background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;}.myinput{border:none;background:#E6E6E6;outline:none;box-shadow:inset 5px 5px 5px #808080, inset -5px -5px 5px #ffffff;}.mytext{text-shadow: 2px 2px 2px #808080, -2px -2px 2px #ffffff;}.mytext2{text-shadow: 1px 1px 1px #808080, -1px -1px 1px #ffffff;}.mybutton{border:none;box-shadow:5px 5px 5px #808080, -5px -5px 5px #ffffff;outline:none;background:#E6E6E6; }.mybutton:hover{box-shadow:1px 1px 5px #808080,  -1px -1px 5px #ffffff;}.FAA{color:#000000;}.FB{color:#009dd1;}.FC{color:#ff0000;} .F5{font-size:5px;}  .F6{font-size:6px;}  .F7{font-size:7px;}  .F8{font-size:8px;}  .F9{font-size:9px;}  .F10{font-size:10px;}  .F11{font-size:11px;}  .F12{font-size:12px;}  .F13{font-size:13px;}  .F14{font-size:14px;}  .F15{font-size:15px;}  .F16{font-size:16px;}  .F17{font-size:17px;}  .F18{font-size:18px;}  .F19{font-size:19px;}  .F20{font-size:20px;}  .F21{font-size:21px;}  .F22{font-size:22px;}  .F23{font-size:23px;}  .F24{font-size:24px;}  .F25{font-size:25px;}  .F26{font-size:26px;}  .F27{font-size:27px;}  .F28{font-size:28px;}  .F29{font-size:29px;}  .F30{font-size:30px;}  .F31{font-size:31px;}  .F32{font-size:32px;}  .F33{font-size:33px;}  .F34{font-size:34px;}  .F35{font-size:35px;}  .F36{font-size:36px;}  .F37{font-size:37px;}  .F38{font-size:38px;}  .F39{font-size:39px;}  .F40{font-size:40px;}  .F{font-size:px;} 
.aa{
margin:10px;
}
.ab
{
height:40px;
vertical-align:middle;
font-family:times;
font-weight:bold;
padding-left:10px;
padding-top:10px;
}
.ac
{
height:30px;
vertical-align:middle;
font-family:times;
font-weight:bold;
padding-top:5px;
margin-top:10px;
}
.ad{
margin-top:10px;
}
.font{
font-family:times;
}
tr{
height:25px;
}
</style>
<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
<div class="fullbody">

<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["project"];
$wing =$_GET["wing"];




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
$empU = $reqData["employee"];
$active = $reqData["ext2"];
$type = $reqData["type"];
$permissionArray = $reqData["permission"];
$projectList = $reqData["project"];
if($type=="main")
{
$req1 = "";
if($project=="all")
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
else
{
if($wing=="all")
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
else
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
}


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
   
   $days = (strtotime($date) - strtotime($date2)) / (60 * 60 * 24);
   
   
   
   $d=strtotime($date2);
   $mydate = date("d-m-Y", $d); 
   $req3 = "SELECT AAproject.name pname, AAWing.wing wingname, AAWorkitem.name wname FROM AAproject, AAWing, AAWorkitem WHERE AAproject.id='$projectid' and AAWing.id='$wingid' and AAWorkitem.id='$workid'";
   $run3 = mysqli_query($con, $req3);
   $result3 = mysqli_fetch_assoc($run3);
   
   $projectname = $result3["pname"];
   $wingname = $result3["wingname"];
   $workname = $result3["wname"];
   
   $req4 = "SELECT SUM(no) as att FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2'";
   $run4 = mysqli_query($con, $req4);
   $result4 = mysqli_fetch_assoc($run4);
   
   $total = $result4["att"];
   
   $req8 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $run8 = mysqli_query($con, $req8);
   $result8 = mysqli_fetch_assoc($run8);
   
   $mygnameB = $result8["name"];
   
echo '<input type="hidden" id="flat'.$tid.$empid.'" value="'.$flat.'">';
echo '<input type="hidden" id="date'.$tid.$empid.'" value="'.$date2.'">';
echo '<input type="hidden" id="work'.$tid.$empid.'" value="'.$workid.'">';
echo '<input type="hidden" id="remark'.$tid.$empid.'" value="'.$remark.'">';
echo '<input type="hidden" id="emp'.$tid.$empid.'" value="'.$empid.'">';
echo '<div style="width:96%;margin:2%;">
<table class="F11 mycontainer" id="row'.$tid.$empid.'" style="width:96%;margin:2%;font-weight:bold;font-family:times;" >
<tr>
<td class="F14" colspan="4" style="text-align:center;padding-right:7px;" >'.$projectname.'<i class="fa F17 mybutton fa-trash" onclick="trash('.$tid.$empid.')" style="float:right;color:red;" ></i></td>
</tr>
<tr>
<td class="F14" colspan="4" style="text-align:left;padding-left:7px;" >'.$mygnameB.'</td>
</tr>
<tr>
<td style="padding-left:7px;" >Wing</td>
<td>'.$wingname.' - '.$flat.'</td>
<td style="text-align:right;">Date</td>
<td style="text-align:right;padding-right:7px;">'.$mydate.'</td>
</tr>
<tr>
<td style="padding-left:7px;">Work</td>
<td colspan="3">'.$workname.'</td>
</tr>
<tr>
<td style="padding-left:7px;">Man power</td>
<td>'.$total.'</td>
<td style="text-align:right;">Time</td>
<td style="text-align:right;padding-right:7px;">'.$time2.'</td>
</tr>';

$req6 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2' GROUP BY `date`, `emp`, `remark`, `flat`";
   $run6 = mysqli_query($con, $req6);
   while($result6 = mysqli_fetch_assoc($run6))
   {

    $tidB = $result6["id"];
    $empidB = $result6["emp"];
    $date2B = $result6["date"];
    $remarkB = $result6["remark"];
    $workidB = $result6["work"];
    $wingidB = $result6["wing"];
    $projectidB = $result6["project"];
    $flatB = $result6["flat"];
    $time2B = $result6["time"];
    
    
   $req5 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empidB' and `date`='$date2B' and `remark`='$remarkB' and `work`='$workidB' and `flat`='$flatB'";
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
   
echo '<tr id="one'.$rid.'" class="F12">
<td colspan="2" style="padding-left:7px;border:1px solid black;">'.$mygname.'</td>
<td class="F10" style="width:15%;"><select onchange="update('.$rid.')" class="mybutton" id="r'.$rid.'" value="" style="outline:none;" >
<option value="0.5">Half day</option>
<option value="1">full day</option>
<option value="1.5">One & a half day</option>
<option value="2">Double day</option>
</select></td>
<td style="text-align:right;padding-right:7px;color:red;border:1px solid black;"><i class="fa F17 mybutton fa-trash" onclick="empdelete('.$rid.');"></i></td>
</tr><script>document.getElementById("r'.$rid.'").value='.$no.';</script>';

}


echo '<tr>
<td colspan="4" class="F10" style="border:1px solid black;padding-left:7px;padding-right:7px;" >
work in progress '.$flatB.' '.$remarkB.'
</td>
</tr>';
}
echo '</table>
</div>';


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


$req1 = "";
if($project=="all")
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
else
{
if($wing=="all")
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
else
{
$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' GROUP BY `date`, `emp` ORDER BY `date` DESC LIMIT 100";
}
}

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
   
   $days = (strtotime($date) - strtotime($date2)) / (60 * 60 * 24);
   
   $disb ="";
   $disb2 ="";
   if($role=="Employee")
   {
   if($empU!=$empid)
   {
   $disb ="disabled";
   $disb2 ="none";
   }
   }
   else
   {
   if($days>3)
   {
   $disb ="disabled";
   $disb2 ="none";
   }
   }
   
   $d=strtotime($date2);
   $mydate = date("d-m-Y", $d); 
   $req3 = "SELECT AAproject.name pname, AAWing.wing wingname, AAWorkitem.name wname FROM AAproject, AAWing, AAWorkitem WHERE AAproject.id='$projectid' and AAWing.id='$wingid' and AAWorkitem.id='$workid'";
   $run3 = mysqli_query($con, $req3);
   $result3 = mysqli_fetch_assoc($run3);
   
   $projectname = $result3["pname"];
   $wingname = $result3["wingname"];
   $workname = $result3["wname"];
   
   $req4 = "SELECT SUM(no) as att FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2'";
   $run4 = mysqli_query($con, $req4);
   $result4 = mysqli_fetch_assoc($run4);
   
   $total = $result4["att"];
   
   $req8 = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $run8 = mysqli_query($con, $req8);
   $result8 = mysqli_fetch_assoc($run8);
   
   $mygnameB = $result8["name"];
   
echo '<input type="hidden" id="flat'.$tid.$empid.'" value="'.$flat.'">';
echo '<input type="hidden" id="date'.$tid.$empid.'" value="'.$date2.'">';
echo '<input type="hidden" id="work'.$tid.$empid.'" value="'.$workid.'">';
echo '<input type="hidden" id="remark'.$tid.$empid.'" value="'.$remark.'">';
echo '<input type="hidden" id="emp'.$tid.$empid.'" value="'.$empid.'">';
echo '<div style="width:96%;margin:2%;">
<table class="F11 mycontainer" id="row'.$tid.$empid.'" style="width:96%;margin:2%;font-weight:bold;font-family:times;" >
<tr>
<td class="F14" colspan="4" style="text-align:center;padding-right:7px;" >'.$projectname.'<i class="fa F17 mybutton fa-trash"  onclick="trash('.$tid.$empid.')" style="float:right;color:red;display:'.$disb2.';" ></i></td>
</tr>
<tr>
<td class="F14" colspan="4" style="text-align:left;padding-left:7px;" >'.$mygnameB.'</td>
</tr>
<tr>
<td style="padding-left:7px;" >Wing</td>
<td>'.$wingname.' - '.$flat.'</td>
<td style="text-align:right;">Date</td>
<td style="text-align:right;padding-right:7px;">'.$mydate.'</td>
</tr>
<tr>
<td style="padding-left:7px;">Work</td>
<td colspan="3">'.$workname.'</td>
</tr>
<tr>
<td style="padding-left:7px;">Man power</td>
<td>'.$total.'</td>
<td style="text-align:right;">Time</td>
<td style="text-align:right;padding-right:7px;">'.$time2.'</td>
</tr>';

$req6 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' and `date`='$date2' GROUP BY `date`, `emp`, `remark`, `flat`";
   $run6 = mysqli_query($con, $req6);
   while($result6 = mysqli_fetch_assoc($run6))
   {

    $tidB = $result6["id"];
    $empidB = $result6["emp"];
    $date2B = $result6["date"];
    $remarkB = $result6["remark"];
    $workidB = $result6["work"];
    $wingidB = $result6["wing"];
    $projectidB = $result6["project"];
    $flatB = $result6["flat"];
    $time2B = $result6["time"];
    
    
   $req5 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empidB' and `date`='$date2B' and `remark`='$remarkB' and `work`='$workidB' and `flat`='$flatB'";
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
   
echo '<tr id="one'.$rid.'" class="F12">
<td colspan="2" style="padding-left:7px;border:1px solid black;">'.$mygname.'</td>
<td class="F10" style="width:15%;"><select onchange="update('.$rid.')" class="mybutton" id="r'.$rid.'" value="" '.$disb.' style="outline:none;" >
<option value="0.5">Half day</option>
<option value="1">full day</option>
<option value="1.5">One & a half day</option>
<option value="2">Double day</option>
</select></td>
<td style="text-align:right;padding-right:7px;color:red;border:1px solid black;"><i class="fa F17 mybutton fa-trash" style="display:'.$disb2.'" onclick="empdelete('.$rid.');"></i></td>
</tr><script>document.getElementById("r'.$rid.'").value='.$no.';</script>';

}


echo '<tr>
<td colspan="4" class="F10" style="border:1px solid black;padding-left:7px;padding-right:7px;" >
work in progress '.$flatB.' '.$remarkB.'
</td>
</tr>';
}
echo '</table>
</div>';


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



    var id = "<?php echo $encId; ?>";
	var User = "<?php echo $encUser; ?>";
	var token = "<?php echo $encToken; ?>";
	var url = "<?php echo $url; ?>";
	var project = "<?php echo $project; ?>";
	var wing = "<?php echo $wing; ?>";


window.onmessage = function(e) {
    var  req = JSON.parse(e.data);
    var    reqid =req.id;
    var    reqdata1 =req.data1;
    var    reqdata2 =req.data2;
    var    reqdata3 =req.data3;
    var    reqdata4 =req.data4;
    if(reqid==3)
    {
    onedelete(reqdata1);
    }
    if(reqid==4)
    {
    deleteall(reqdata1);
    }
    
    }


function empdelete(N)
{
window.top.postMessage('{"id":3,"data1":'+N+',"data2":"","data3":"","data4":""}','*');
}

function trash(N)
{
window.top.postMessage('{"id":4,"data1":'+N+',"data2":"","data3":"","data4":""}','*');
}



function onedelete(M)
{

var req2=new XMLHttpRequest();
req2.open("GET",url+"reportdeleteB.php?id="+id+"&user="+User+"&token="+token+"&rid="+M,true);
req2.onreadystatechange=function(){
if(req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
{  

}else{
 document.getElementById("one"+M).style.display="none";

}}}
req2.send();

}

function update(N)
{
window.top.postMessage('{"id":1,"data1":"","data2":"","data3":"","data4":""}','*');
var no = document.getElementById("r"+N).value;
var req2=new XMLHttpRequest();
req2.open("GET",url+"reportupdate.php?id="+id+"&user="+User+"&token="+token+"&no="+no+"&rid="+N,true);
req2.onreadystatechange=function(){
if(req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
{  

}else{
 
window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}','*');
}}}
req2.send();

}



function deleteall(N)
{
var flat = document.getElementById("flat"+N).value;
var date3 = document.getElementById("date"+N).value;
var work = document.getElementById("work"+N).value;
var remark = document.getElementById("remark"+N).value;
var emp = document.getElementById("emp"+N).value;
var req2=new XMLHttpRequest();
req2.open("GET",url+"reportdeleteA.php?id="+id+"&user="+User+"&token="+token+"&flat="+flat+"&date="+date3+"&remark="+remark+"&emp="+emp+"&work="+work,true);
req2.onreadystatechange=function(){
if(req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
{  

}else{
 
document.getElementById("row"+N).style.display="none";
}}}
req2.send();

}


</script>


</div>
</body>
</html>