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
	
	</style>
	<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
	<div class="fullbody" id="accordionExample">
	
	<?php
	require_once("con.php");
	
	$id =$_GET["id"];
	$user =$_GET["user"];
	$token =$_GET["token"];
	
	$project =$_GET["project"];
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
	
    $req1xa = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' GROUP BY `token` ORDER BY `date` DESC";
    $reqRxa = mysqli_query($con, $req1xa);
    while ($resutAa =mysqli_fetch_assoc($reqRxa))
     {
     $xwing = $resutAa["wing"];
    $xname = $resutAa["emp"];
    $xtoken = $resutAa["token"];
    $xdate = $resutAa["date"];
    $xaddedby = $resutAa["addedby"];
    $xverified = $resutAa["verified"];
    $text ="";
    $text2 ="";
    $req1xa2 = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `token`='$xtoken'";
    $reqRxa2 = mysqli_query($con, $req1xa2);
    while ($resutAa2 =mysqli_fetch_assoc($reqRxa2))
    {
    $xremark = $resutAa2["remark"];
    if($xremark!=$text)
    {
    $text =$text.$xremark;
    $text2 =$text2.$xremark.", ";
    }
    }
    
    
    
    $decId2 =openssl_decrypt ( $xaddedby , $ciphering, $dec_key, $options, $dec_iv);
    $find2 = "SELECT AAemployees.name ename, AAuser.name uname FROM AAemployees, AAuser WHERE AAemployees.id='$xname' and AAuser.id='$decId2'";
    $resultfind2 = mysqli_query($con, $find2);
    $rowfind2 = mysqli_fetch_assoc($resultfind2);
    $ename =$rowfind2["ename"];
    $uname =$rowfind2["uname"];
    
    $color ="red";
    if($xverified=="Verified")
    {
    $color ="green";
    }
    else
    {
    $color ="red";
    }
    $find2f = "SELECT * FROM AAWing WHERE `id`='$xwing'";
    $resultfind2f = mysqli_query($con, $find2f);
    $rowfind2f = mysqli_fetch_assoc($resultfind2f);
    $wingname =$rowfind2f["wing"];
    
    
    echo '<div id="g'.$xtoken.'" class="mycontainer" style="width:96%;margin:2%;">
    <table class="F12" style="width:96%;margin:2%;font-weight:bold;font-family:times;"  class="F15" >
    <tr>
    <td style="text-align:left;">Name </td>
    <td style="text-align:left;">'.$ename.'</td>
    <td style="text-align:right;width:8%;"><i class="F18 fa fa-print mybutton" id="row'.$xtoken.'" name="'.$ename.' '.$xtoken.'" src="'.$url.'issueslip.php?id='.$id.'&user='.$user.'&token='.$token.'&name='.$ename.'&project='.$project.'&ref='.$xtoken.'" onclick="printslip('.$xtoken.');" ></i></td>
    <td style="text-align:right;width:8%;"><i class="F18 fa fa-trash mybutton" onclick="cancelM('.$xtoken.');"></i></td>
    </tr>
    <tr>
    <td>Wing</td>
    <td colspan="3">'.$wingname.'</td>
    </tr>
    </table>
    <table class="F12" style="width:96%;margin:2%;font-weight:bold;font-family:times;"  class="F15" >
    <tr>
    <td style="text-align:left;"  class="F10">Taken No</td>
    <td colspan="4"style="text-align:left;"  class="F10">#'.$xtoken.'</td>
    <td>Date</td>
    <td>'.$xdate.'</td>
    </table>
    
    <table class="F10"style="width:96%;margin:2%;font-weight:bold;font-family:times;"border="1" class="F12">';
    $x =0;
    $req1xa1 = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `token`='$xtoken'";
    $reqRxa1 = mysqli_query($con, $req1xa1);
    while ($resutAa1 =mysqli_fetch_assoc($reqRxa1))
    {
    $x =$x+1;
    $xitem = $resutAa1["item"];
    $xflat = $resutAa1["flat"];
    $xqty = $resutAa1["qty"];
    $xunit = $resutAa1["unit"];
    
    $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$xitem'";
    $resultfind2 = mysqli_query($con, $find2);
    $rowfind2 = mysqli_fetch_assoc($resultfind2);
    $itemname2 =$rowfind2["item"];
    
   echo '<tr>
    <td style="text-align:left;" >#'.$x.'</td>
    <td style="text-align:left;">'.$itemname2.' '.$xflat.'</td>
    <td style="text-align:right;">'.$xqty.'</td>
    <td style="text-align:right;">'.$xunit.'</td>
    </tr>';
    }
    
    echo '<tr>
    <td style="text-align:left;"colspan="5">'.$text2.'</td>
    </tr>
    <tr>
    <td  style="text-align:right;padding-right:10px;color:red;"colspan="7"><strong style="color:'.$color.';float:left;">'.$xverified.'</strong>Issued by_'.$uname.'</td>
    </tr>
    </table>
    </div>';
    
    }









	
	
	
	
	
	
	
	
	}
	else
	{
	if ($active=="active")
	{
	$check1=0;
	$check2=0;
	$permissionA = explode(",",$permissionArray);
	for ($x = 0; $x <= count($permissionA); $x++) 
	{
	if($permissionA[$x]==30)
	{
	$check =1;
	}
	}
	
	$display ="";
	if($check==1)
	{
	
	$display ="block";
	}
	else
	{
	$display ="none";
	}
	
	$req1xa = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' GROUP BY `token` ORDER BY `date` ASC";
	$reqRxa = mysqli_query($con, $req1xa);
	while ($resutAa =mysqli_fetch_assoc($reqRxa))
	{
	$xwing = $resutAa["wing"];
	$xname = $resutAa["emp"];
	$xtoken = $resutAa["token"];
	$xdate = $resutAa["date"];
	$xaddedby = $resutAa["addedby"];
	$xverified = $resutAa["verified"];
	$text ="";
	$text2 ="";
	$req1xa2 = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `token`='$xtoken'";
	$reqRxa2 = mysqli_query($con, $req1xa2);
	while ($resutAa2 =mysqli_fetch_assoc($reqRxa2))
	{
	$xremark = $resutAa2["remark"];
	if($xremark!=$text)
	{
	$text =$text.$xremark;
	$text2 =$text2.$xremark.", ";
	}
	}
	
	
	
	$decId2 =openssl_decrypt ( $xaddedby , $ciphering, $dec_key, $options, $dec_iv);
	$find2 = "SELECT AAemployees.name ename, AAuser.name uname FROM AAemployees, AAuser WHERE AAemployees.id='$xname' and AAuser.id='$decId2'";
	$resultfind2 = mysqli_query($con, $find2);
	$rowfind2 = mysqli_fetch_assoc($resultfind2);
	$ename =$rowfind2["ename"];
	$uname =$rowfind2["uname"];
	
	$color ="red";
	if($xverified=="Verified")
	{
	$color ="green";
	}
	else
	{
	$color ="red";
	}
	$find2f = "SELECT * FROM AAWing WHERE `id`='$xwing'";
	$resultfind2f = mysqli_query($con, $find2f);
	$rowfind2f = mysqli_fetch_assoc($resultfind2f);
	$wingname =$rowfind2f["wing"];
	
	
	echo '<div id="g'.$xtoken.'" class="mycontainer" style="width:96%;margin:2%;">
	<table class="F12" style="width:96%;margin:2%;font-weight:bold;font-family:times;"  class="F15" >
	<tr>
	<td style="text-align:left;">Name </td>
	<td style="text-align:left;">'.$ename.'</td>
	<td style="text-align:right;width:8%;"><i class="F18 fa fa-print mybutton" id="row'.$xtoken.'" name="'.$ename.' '.$xtoken.'" src="'.$url.'issueslip.php?id='.$id.'&user='.$user.'&token='.$token.'&name='.$ename.'&project='.$project.'&ref='.$xtoken.'" onclick="printslip('.$xtoken.');" ></i></td>
	<td style="text-align:right;width:8%;"><i class="F18 fa fa-trash mybutton" style="display:'.$display.';" onclick="cancelM('.$xtoken.');"></i></td>
	</tr>
	<tr>
	<td>Wing</td>
	<td colspan="3">'.$wingname.'</td>
	</tr>
	</table>
	<table class="F12" style="width:96%;margin:2%;font-weight:bold;font-family:times;"  class="F15" >
	<tr>
	<td style="text-align:left;"  class="F10">Taken No</td>
	<td colspan="4"style="text-align:left;"  class="F10">#'.$xtoken.'</td>
	<td>Date</td>
	<td>'.$xdate.'</td>
	</table>
	
	<table class="F10"style="width:96%;margin:2%;font-weight:bold;font-family:times;"border="1" class="F12">';
	$x =0;
	$req1xa1 = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `token`='$xtoken'";
	$reqRxa1 = mysqli_query($con, $req1xa1);
	while ($resutAa1 =mysqli_fetch_assoc($reqRxa1))
	{
	$x =$x+1;
	$xitem = $resutAa1["item"];
	$xflat = $resutAa1["flat"];
	$xqty = $resutAa1["qty"];
	$xunit = $resutAa1["unit"];
	
	$find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$xitem'";
	$resultfind2 = mysqli_query($con, $find2);
	$rowfind2 = mysqli_fetch_assoc($resultfind2);
	$itemname2 =$rowfind2["item"];
	
	echo '<tr>
	<td style="text-align:left;" >#'.$x.'</td>
	<td style="text-align:left;">'.$itemname2.' '.$xflat.'</td>
	<td style="text-align:right;">'.$xqty.'</td>
	<td style="text-align:right;">'.$xunit.'</td>
	</tr>';
	}
	
	echo '<tr>
	<td style="text-align:left;"colspan="5">'.$text2.'</td>
	</tr>
	<tr>
	<td  style="text-align:right;padding-right:10px;color:red;"colspan="7"><strong style="color:'.$color.';float:left;">'.$xverified.'</strong>Issued by_'.$uname.'</td>
	</tr>
	</table>
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



function printslip(N)
{
var src = document.getElementById("row"+N).getAttribute("src");
var name =document.getElementById("row"+N).getAttribute("name");
var data ='{"url":"'+src+'","name":"'+name+'"}';
window.top.postMessage("dld"+data,'*');
}

function cancelM(M)
{
window.top.postMessage("hhh"+M,'*');
}

window.onmessage = function(e) {
    var  req =e.data
document.getElementById("g"+req).style.display="none";
}



/*
var mydata ="";

function getdata(n)
{
mydata ="";
var myitem =document.getElementsByClassName("myitem"+n);
var myquantity =document.getElementsByClassName("myquantity"+n);
var myunit =document.getElementsByClassName("myunit"+n);
var myamount =document.getElementsByClassName("myamount"+n);
var myid =document.getElementsByClassName("myid"+n);

var party = document.getElementById("party"+n).innerHTML;
var challan = document.getElementById("challan"+n).innerHTML;
var date2 = document.getElementById("date"+n).innerHTML;
mydata = '{"item":"'+party+'","quantity":"'+challan+'","unit":"'+date2+'","amount":"", "id":""}';

for (i = 0; i < myitem.length; i++){
    mydata+= '@{"item":"'+myitem[i].value+'","quantity":"'+myquantity[i].innerHTML+'","unit":"'+myunit[i].innerHTML+'","amount":"'+myamount[i].innerHTML+'", "id":"'+myid[i].value+'"}';
}

window.top.postMessage(mydata,'*');
}
	var mydata2 ="";
function getdata2(n)
{
mydata2 ="delete";

var myid =document.getElementsByClassName("myid"+n);


for (i = 0; i < myid.length; i++){
    mydata2 =mydata2+(myid[i].value)+",";
}

window.top.postMessage(mydata2,'*');
}
	
	
	
	
	
	window.top.postMessage('{"id":5,"data1":"","data2":"","data3":"","data4":""}','*');
	
	var letters = "/^[A-Z a-z 0-9]+$/";
	var id = "<?php echo $encId; ?>";
	var User = "<?php echo $encUser; ?>";
	var token = "<?php echo $encToken; ?>";
	var req = "<?php echo $myreq; ?>";
	var url = "<?php echo $url; ?>";
	var wingitem = "<?php echo $wing; ?>";
	var projectid = "<?php echo $project; ?>";


	var req2=new XMLHttpRequest();
	req2.open("GET",url+"getitemname.php?id="+id+"&user="+User+"&token="+token,true);
	req2.onreadystatechange=function(){
	if(	req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
	{  
	
	}else{
	
	
	}}}
	req2.send();

*/
	</script>
	</div>
	</body>
	</html>