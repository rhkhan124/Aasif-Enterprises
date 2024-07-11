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
</style>
<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
<div class="fullbody">

<div style="height:70%;overflow:scroll;">






<?php
require_once("con.php");


$id =$_GET["id"];
$user =$_GET["user"];
$token =$_GET["token"];
$project =$_GET["project"];
$wing =$_GET["wing"];
$emp =$_GET["emp"];
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
if($type=="main")
{
$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' ORDER BY `flat`+0 ASC";
$run1 = mysqli_query($con, $req1);
while ($result1 = mysqli_fetch_assoc($run1))
{
$flat =$result1["flat"];
$bhk =$result1["bhk"];


echo '<div class="aa"  >
<div class="card">
    <div class="card-header F18 ab mycontainer" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo'.$flat.'" aria-expanded="false" aria-controls="collapseTwo'.$flat.'">';
    echo $flat;
    echo '<i class="F15 fa fa-chevron-down" style="padding-right:10px;float:right;" ></i></div>
    <div id="collapseTwo'.$flat.'" class="collapse" aria-labelledby="headingTwo'.$flat.'" data-parent="#accordionExample">
      <div class="card-body" style="margin-left:8px;" >';
      
      $req2 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk'";
      $run2 = mysqli_query($con, $req2);
      while ($result2 = mysqli_fetch_assoc($run2))
      {
      $x =$result2["id"];
      $worknameid =$result2["workname"];
      
      $req3 = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$worknameid'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
      
      echo '<div class="card ad">
      <div class="card-header F14 ac mycontainer" style="background-color:#c2bebe;" data-toggle="collapse" id="headingTwo2" data-target="#collapse'.$worknameid.$flat.'" aria-expanded="false" aria-controls="collapseTwo2">';
      echo $workname; 
      echo' <i class="F10 fa fa-chevron-down" style="padding-right:10px;float:right;"></i> </div>
      <div id="collapse'.$worknameid.$flat.'" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample2">
      <div class="card-body">
      <table class="F10 font" border="1" style="width:97%;margin-left:3%;margin-top:10px;" >
      <tr>
      <td style="text-align:center;">Item</td>
      <td style="text-align:center;" >Quantity</td>
      <td style="text-align:center;" >Prvs</td>
      <td style="text-align:center;">Limit</td>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';
      $myitemid ="";
      $req4 = "SELECT * FROM `AAitem` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `ext1`='$x'";
      $run4 = mysqli_query($con, $req4);
      while ($result4 = mysqli_fetch_assoc($run4))
      {
      $myitemid = $result4["id"];
      $myitemname = $result4["itemname"];
      $myquantity = $result4["qty"];
      $myunit = $result4["unit"];
      
      $req1mk = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$myitemname'";
      $reqRmk = mysqli_query($con, $req1mk);
      $resultmk= mysqli_fetch_assoc($reqRmk);
      $myitemname = $resultmk["name"];
      $myitemidzz = $resultmk["id"];
      
      $req1xdab = "SELECT SUM(qty) as allissueb FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$myitemidzz' and `ext1`='$worknameid'";
      $reqRxdab = mysqli_query($con, $req1xdab);
      $resultBab = mysqli_fetch_assoc($reqRxdab);
      $allissueab = $resultBab["allissueb"];
      
      
      echo '<tr style="height:30px;"><input type="hidden" id="flat'.$myitemid.$flat.'" value="'.$flat.'"><input type="hidden" id="ext'.$myitemid.$flat.'" value="'.$worknameid.'">
      <td><input type="hidden" id="item'.$myitemid.$flat.'" value="'.$myitemidzz.'">'.$myitemname.'</td>
      <td style="width:20%;" ><input class="myinput" type="text" style="background-color:white;height:20px;" id="qty'.$myitemid.$flat.'" value="'.($myquantity-$allissueab).'"  placeholder="0.00"  ></td>
      <td style="text-align:center;" >'.$allissueab.'</td>
      <td style="text-align:center;" id="limit'.$myitemid.$flat.'">'.$myquantity.'</td>
      <td style="text-align:center;" id="unit'.$myitemid.$flat.'" >'.$myunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" onclick="issue('.$myitemid.$flat.')" >issue</button></td>
      </tr>';
      }
      
      echo '</table>
      <hr color="black" size="40" style="margin:3px;"  >
      <table class="F10" id="ss'.$worknameid.$flat.'" border="1" style="width:94%;margin-left:6%;margin-top:10px;" >
      <tr>
      <td style="text-align:center;">Descriptions</td>
      <td style="text-align:center;" >Qty</t>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';
      $req1b = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `ext1`='$worknameid' GROUP BY item";
      $reqRb = mysqli_query($con, $req1b);
      while ( $resultb =mysqli_fetch_assoc($reqRb))
      {
      $zitem = $resultb["item"];
      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
      echo '<tr>
      <td colspan="4" style="text-align:center;">'.$workname.'</td>
      </tr>';
      $req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$zitem' and `ext1`='$worknameid'";
      $reqRbb = mysqli_query($con, $req1bb);
      while ( $resultbb =mysqli_fetch_assoc($reqRbb))
      {
      $zid = $resultbb["id"];
      $zname = $resultbb["emp"];
      $zqty = $resultbb["qty"];
      $zunit = $resultbb["unit"];
      
      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];
      
      echo '<tr id="g'.$zid.'" style="height:30px;" >
      <td >'.$worknamem.'</td>
      <td style="text-align:right;">'.$zqty.'</td>
      <td style="text-align:center;">'.$zunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" onclick="cancelM('.$zid.');">cancel</button></td>
      </tr>';
      
      }
      }
      
      echo '</table>
      </div>
      </div>
      </div>';
      }
      
      
      
        echo '</div>
    </div>
  </div>
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
if($permissionA[$x]==30)
{
$check =1;
}
}


$req1 = "SELECT * FROM `AAFlat` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' ORDER BY `flat`+0 ASC";
$run1 = mysqli_query($con, $req1);
while ($result1 = mysqli_fetch_assoc($run1))
{
$flat =$result1["flat"];
$bhk =$result1["bhk"];


echo '<div class="aa"  >
<div class="card">
    <div class="card-header F18 ab mycontainer" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo'.$flat.'" aria-expanded="false" aria-controls="collapseTwo'.$flat.'">';
    echo $flat;
    echo '<i class="F15 fa fa-chevron-down" style="padding-right:10px;float:right;" ></i></div>
    <div id="collapseTwo'.$flat.'" class="collapse" aria-labelledby="headingTwo'.$flat.'" data-parent="#accordionExample">
      <div class="card-body" style="margin-left:8px;" >';
      
      $req2 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk'";
      $run2 = mysqli_query($con, $req2);
      while ($result2 = mysqli_fetch_assoc($run2))
      {
      $x =$result2["id"];
      $worknameid =$result2["workname"];
      
      $req3 = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$worknameid'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
      
      echo '<div class="card ad">
      <div class="card-header F14 ac mycontainer" style="background-color:#c2bebe;" data-toggle="collapse" id="headingTwo2" data-target="#collapse'.$worknameid.$flat.'" aria-expanded="false" aria-controls="collapseTwo2">';
      echo $workname; 
      echo' <i class="F10 fa fa-chevron-down" style="padding-right:10px;float:right;"></i> </div>
      <div id="collapse'.$worknameid.$flat.'" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample2">
      <div class="card-body">
      <table class="F10 font" border="1" style="width:97%;margin-left:3%;margin-top:10px;" >
      <tr>
      <td style="text-align:center;">Item</td>
      <td style="text-align:center;" >Quantity</td>
      <td style="text-align:center;" >Prvs</td>
      <td style="text-align:center;">Limit</td>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';
      $myitemid ="";
      $req4 = "SELECT * FROM `AAitem` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$bhk' and `ext1`='$x'";
      $run4 = mysqli_query($con, $req4);
      while ($result4 = mysqli_fetch_assoc($run4))
      {
      $myitemid = $result4["id"];
      $myitemname = $result4["itemname"];
      $myquantity = $result4["qty"];
      $myunit = $result4["unit"];
      
      $req1mk = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$myitemname'";
      $reqRmk = mysqli_query($con, $req1mk);
      $resultmk= mysqli_fetch_assoc($reqRmk);
      $myitemname = $resultmk["name"];
      $myitemidzz = $resultmk["id"];
      
      $req1xdab = "SELECT SUM(qty) as allissueb FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$myitemidzz' and `ext1`='$worknameid'";
      $reqRxdab = mysqli_query($con, $req1xdab);
      $resultBab = mysqli_fetch_assoc($reqRxdab);
      $allissueab = $resultBab["allissueb"];
      
      
      echo '<tr style="height:30px;"><input type="hidden" id="flat'.$myitemid.$flat.'" value="'.$flat.'"><input type="hidden" id="ext'.$myitemid.$flat.'" value="'.$worknameid.'">
      <td><input type="hidden" id="item'.$myitemid.$flat.'" value="'.$myitemidzz.'">'.$myitemname.'</td>
      <td style="width:20%;" ><input class="myinput" type="text" style="background-color:white;height:20px;" id="qty'.$myitemid.$flat.'" value="'.($myquantity-$allissueab).'"  placeholder="0.00"  ></td>
      <td style="text-align:center;" >'.$allissueab.'</td>
      <td style="text-align:center;" id="limit'.$myitemid.$flat.'">'.$myquantity.'</td>
      <td style="text-align:center;" id="unit'.$myitemid.$flat.'" >'.$myunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" onclick="issue('.$myitemid.$flat.')" >issue</button></td>
      </tr>';
      }
      
      echo '</table>
      <hr color="black" size="40" style="margin:3px;"  >
      <table class="F10" id="ss'.$worknameid.$flat.'" border="1" style="width:94%;margin-left:6%;margin-top:10px;" >
      <tr>
      <td style="text-align:center;">Descriptions</td>
      <td style="text-align:center;" >Qty</t>
      <td style="text-align:center;">Unit</td>
      <td style="text-align:center;" ></td>
      </tr>';
      $req1b = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `ext1`='$worknameid' GROUP BY item";
      $reqRb = mysqli_query($con, $req1b);
      while ( $resultb =mysqli_fetch_assoc($reqRb))
      {
      $zitem = $resultb["item"];
      $req3 = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$zitem'";
      $run3 = mysqli_query($con, $req3);
      $result3 = mysqli_fetch_assoc($run3);
      $workname = $result3["name"];
      echo '<tr>
      <td colspan="4" style="text-align:center;">'.$workname.'</td>
      </tr>';
      $req1bb = "SELECT * FROM `AAissue` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `flat`='$flat' and `item`='$zitem' and `ext1`='$worknameid'";
      $reqRbb = mysqli_query($con, $req1bb);
      while ( $resultbb =mysqli_fetch_assoc($reqRbb))
      {
      $zid = $resultbb["id"];
      $zname = $resultbb["emp"];
      $zqty = $resultbb["qty"];
      $zunit = $resultbb["unit"];
      $display ="";
      if($role=="Employee")
      {
      $date3 = $resultbb["date"];
      $days = (strtotime($date) - strtotime($date3)) / (60 * 60 * 24);
      $display ="";
      $dis ="";
      if($days>1)
      {
      $display ="none";
      
      }
      else
      {
      $display ="block";
      }
      }
      else 
      {
      $date3 = $resultbb["date"];
      $days = (strtotime($date) - strtotime($date3)) / (60 * 60 * 24);
      $display ="";
      $dis ="";
      if($days>3)
      {
      $display ="none";
      }
      else
      {
      $display ="block";
      }
      }
      
      $req3m = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$zname'";
      $run3m = mysqli_query($con, $req3m);
      $result3m = mysqli_fetch_assoc($run3m);
      $worknamem = $result3m["name"];
      
      echo '<tr id="g'.$zid.'" style="height:30px;" >
      <td >'.$worknamem.'</td>
      <td style="text-align:right;">'.$zqty.'</td>
      <td style="text-align:center;">'.$zunit.'</td>
      <td style="text-align:right;" ><button class="mybutton" style="display:'.$display.';" onclick="cancelM('.$zid.');">cancel</button></td>
      </tr>';
      
      }
      }
      
      echo '</table>
      </div>
      </div>
      </div>';
      }
      
      
      
        echo '</div>
    </div>
  </div>
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
	var emp = "<?php echo $emp; ?>";

function issue(N)
{
var flat = document.getElementById("flat"+N).value;
var ext = document.getElementById("ext"+N).value;
var item = document.getElementById("item"+N).value;
var qty = document.getElementById("qty"+N).value;
var unit = document.getElementById("unit"+N).innerHTML;
var limit = document.getElementById("limit"+N).innerHTML;




var req2=new XMLHttpRequest();
req2.open("GET",url+"addissue2.php?id="+id+"&user="+User+"&token="+token+"&project="+project+"&wing="+wing+"&ext1="+ext+"&emp="+emp+"&flat="+flat+"&limit="+limit+"&item="+item+"&qty="+qty+"&unit="+unit,true);
req2.onreadystatechange=function(){
if(req2.readyState==4 && req2.status==200){if(req2.responseText=="ufFygf")
{  

}else{
 if(req2.responseText.trim().substr(0,3)=="Ove")
 {
 alert(req2.responseText.trim());
 }
 else if(req2.responseText.trim().substr(0,3)=="Sto")
 {
 alert(req2.responseText.trim());
 }
 else
 {
document.getElementById("ss"+ext+flat).innerHTML= req2.responseText.trim();
}

}}}
req2.send();



}

function cancelM(M)
{
window.top.postMessage("ggg"+M,'*');
}

window.onmessage = function(e) {
    var  req =e.data
document.getElementById("g"+req).style.display="none";
}
</script>

</div>
</div>
</body>
</html>