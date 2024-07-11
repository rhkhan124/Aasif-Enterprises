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
	tr{
	height:40px;
	}
	body{background:#E6E6E6;}.mycontainer{background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;}.myinput{border:none;background:#E6E6E6;outline:none;box-shadow:inset 5px 5px 5px #808080, inset -5px -5px 5px #ffffff;}.mytext{text-shadow: 2px 2px 2px #808080, -2px -2px 2px #ffffff;}.mytext2{text-shadow: 1px 1px 1px #808080, -1px -1px 1px #ffffff;}.mybutton{border:none;box-shadow:5px 5px 5px #808080, -5px -5px 5px #ffffff;outline:none;background:#E6E6E6; }.mybutton:hover{box-shadow:1px 1px 5px #808080,  -1px -1px 5px #ffffff;}.FAA{color:#000000;}.FB{color:#009dd1;}.FC{color:#ff0000;} .F5{font-size:5px;}  .F6{font-size:6px;}  .F7{font-size:7px;}  .F8{font-size:8px;}  .F9{font-size:9px;}  .F10{font-size:10px;}  .F11{font-size:11px;}  .F12{font-size:12px;}  .F13{font-size:13px;}  .F14{font-size:14px;}  .F15{font-size:15px;}  .F16{font-size:16px;}  .F17{font-size:17px;}  .F18{font-size:18px;}  .F19{font-size:19px;}  .F20{font-size:20px;}  .F21{font-size:21px;}  .F22{font-size:22px;}  .F23{font-size:23px;}  .F24{font-size:24px;}  .F25{font-size:25px;}  .F26{font-size:26px;}  .F27{font-size:27px;}  .F28{font-size:28px;}  .F29{font-size:29px;}  .F30{font-size:30px;}  .F31{font-size:31px;}  .F32{font-size:32px;}  .F33{font-size:33px;}  .F34{font-size:34px;}  .F35{font-size:35px;}  .F36{font-size:36px;}  .F37{font-size:37px;}  .F38{font-size:38px;}  .F39{font-size:39px;}  .F40{font-size:40px;}  .F{font-size:px;} 
	
	</style>
	<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
	<div class="fullbody" id="accordionExample" style="width:100%;" >
	
	
	

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
	
    $req1xa = "SELECT * FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' GROUP BY `item`";
    $reqRxa = mysqli_query($con, $req1xa);
    while ($resutAa =mysqli_fetch_assoc($reqRxa))
    {
    $item = $resutAa["item"];
    $unit = $resutAa["unit"];
    
    
    $req1xa2 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$item'";
    $reqRxa2 = mysqli_query($con, $req1xa2);
    $resutAa2 =mysqli_fetch_assoc($reqRxa2);
    
    $itemname =$resutAa2["name"];
    
    $req1xab = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
    $reqRxab = mysqli_query($con, $req1xab);
    $resutAab =mysqli_fetch_assoc($reqRxab);
    
    $allstocka = $resutAab["allstock"];
    
    $req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
    $reqRxda = mysqli_query($con, $req1xda);
    $resultBa = mysqli_fetch_assoc($reqRxda);
    $allissuea = $resultBa["allissue"];
    
    $req1xdaf = "SELECT SUM(amount) as amount FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
    $reqRxdaf = mysqli_query($con, $req1xdaf);
    $resultBaf = mysqli_fetch_assoc($reqRxdaf);
    $allissueaf = $resultBaf["amount"];
    
    echo '<div class="mycontainer" style="width:94%;margin:3%;" >
    <table style="width:100%;font-family:times;font-weight:bold;text-align:center;" class="F17" >
    <tr>
    <td colspan="4" >'.$itemname.'</td>
    </tr>
    <tr class="F13">
    <td style="color:green;" >Total Issued</td><td style="color:#70078a;">Total Stock</td> <td style="color:#023352;">Total Available</td><td >Total Amount</td>
    </tr>
    <tr class="F13"> 
    <td style="color:green;">'.$allissuea.' <small class="F10" >'.$unit.'<small></td><td style="color:#70078a;">'.$allstocka.' <small class="F10">'.$unit.'<small></td ><td style="color:#023352;">'.($allstocka-$allissuea).' <small class="F10">'.$unit.'<small></td>
    <td >'.$allissueaf.' <small class="F10"><small></td>
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
	if(30==30)
	{
	$check =1;
	}
	}
	$req1xa = "SELECT * FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' GROUP BY `item`";
	$reqRxa = mysqli_query($con, $req1xa);
	while ($resutAa =mysqli_fetch_assoc($reqRxa))
	{
	$item = $resutAa["item"];
	$unit = $resutAa["unit"];
	
	
	$req1xa2 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$item'";
	$reqRxa2 = mysqli_query($con, $req1xa2);
	$resutAa2 =mysqli_fetch_assoc($reqRxa2);
	
	$itemname =$resutAa2["name"];
	
	$req1xab = "SELECT SUM(qty) as allstock FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
	$reqRxab = mysqli_query($con, $req1xab);
	$resutAab =mysqli_fetch_assoc($reqRxab);
	
	$allstocka = $resutAab["allstock"];
	
	$req1xda = "SELECT SUM(qty) as allissue FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
	$reqRxda = mysqli_query($con, $req1xda);
	$resultBa = mysqli_fetch_assoc($reqRxda);
	$allissuea = $resultBa["allissue"];
	
	$req1xdaf = "SELECT SUM(amount) as amount FROM `AAstock` WHERE `user`='$encUser' and `project`='$project' and `item`='$item'";
	$reqRxdaf = mysqli_query($con, $req1xdaf);
	$resultBaf = mysqli_fetch_assoc($reqRxdaf);
	$allissueaf = $resultBaf["amount"];
	
	echo '<div class="mycontainer" style="width:94%;margin:3%;" >
	<table style="width:100%;font-family:times;font-weight:bold;text-align:center;" class="F17" >
	<tr>
	<td colspan="4" >'.$itemname.'</td>
	</tr>
	<tr class="F13">
	<td style="color:green;" >Total Issued</td><td style="color:#70078a;">Total Stock</td> <td style="color:#023352;">Total Available</td><td >Total Amount</td>
	</tr>
	<tr class="F13"> 
	<td style="color:green;">'.$allissuea.' <small class="F10" >'.$unit.'<small></td><td style="color:#70078a;">'.$allstocka.' <small class="F10">'.$unit.'<small></td ><td style="color:#023352;">'.($allstocka-$allissuea).' <small class="F10">'.$unit.'<small></td>
	<td >'.$allissueaf.' <small class="F10"><small></td>
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
	







	
	
	
	
	
	
	

	</script>
	</div>
	</body>
	</html>