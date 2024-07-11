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
$wing =$_GET["wing"];
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

$req1 = "SELECT * FROM `AAWorkname` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing'";
$reqR = mysqli_query($con, $req1);
while ($resultrow =mysqli_fetch_assoc($reqR))
{
    $x = $resultrow["id"];
    $xworkname = $resultrow["workname"];
    $xsqft = $resultrow["sqft"];
    $xrate = $resultrow["rate"];
    $xbhk = $resultrow["bhk"];
    
    $req1a = "SELECT * FROM `AABhk` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `id`='$xbhk'";
    $reqRa = mysqli_query($con, $req1a);
    $resultrowa = mysqli_fetch_assoc($reqRa);
    
    $mybhkid = $resultrowa["id"];
    $mybhk = $resultrowa["bhk"];
    
    $req1m = "SELECT * FROM `AAWorkitem` WHERE `user`='$encUser' and `id`='$xworkname'";
    $reqRm = mysqli_query($con, $req1m);
    $resultm= mysqli_fetch_assoc($reqRm);
    $xworkname = $resultm["name"];
   
    
echo '<div id="row'.$x.'" class="mycontainer" style="width:96%;margin:2%;">'
  .'<table class="F12"  style="width:96%;margin:2%;font-family:times;font-weight:bold;" >'
  .'<tr>'
  .'<td class="F14" colspan="3" style="text-align:center;" id="awork'.$x.'" >'.$xworkname.'</td>'
  .'</tr>'
  .'<tr>'
  .'<td>Type</td><td style="text-align:right;" ><input type="hidden" value="'.$mybhkid.'" id="abhk'.$x.'">'.$mybhk.'</td><td style="text-align:right;"></td>'
  .'</tr>'
  .'<tr>'
  .'<td>SqFt/SqMt</td><td style="text-align:right;" id="asqft'.$x.'">'.$xsqft.'</td><td style="text-align:right;"> <i class="fa fa-edit F18" onclick="ref('.$x.');" data-toggle="collapse" data-target="#collapseTwo'.$x.'" aria-expanded="false" aria-controls="collapseTwo"></i> </td>'
  .'</tr>'
  .'<tr>'
  .'<td>Rate</td><td style="text-align:right;" id="arate'.$x.'">'.$xrate.'</td><td style="text-align:right;"><i class="fa fa-trash F18" onclick="workdelete('.$x.');"></i> </td>'
  .'</tr>'
  .'</table>'
  .'<div id="collapseTwo'.$x.'" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'
  .'<div class="card-body">'
  .'<table class="F12" style="width:100%;font-family:times;font-weight:bold;" >'
  .'<tr>'
  .'<td colspan="2" style="width:65%;text-align:center;display:none;"><input disabled id="work'.$x.'" class="myinput" value="'.$xworkname.'" type="text" style="width:96%;margin:2%;height:30px;background-color:white;"></td>'
  .'</td>'
  .'</tr>'
  .'<tr>'
  .'<td style="width:65%;text-align:center;"><input id="sqft'.$x.'" class="myinput" value="'.$xsqft.'" type="number" style="width:96%;margin:2%;height:30px;background-color:white;"></td>'
  .'<td style="width:35%;text-align:center;"><input id="rate'.$x.'" class="myinput" value="'.$xrate.'" type="number" style="width:96%;margin:2%;height:30px;background-color:white;"></td>'
  .'</tr>'
  .'</table>'
  .'<p class="F12">Set materials uses limits </p>'
  .'<table class="F12"  id="myTable'.$x.'" style="width:96%;margin:2%;" border="1">'
  .'<tr>'
  .'<td class="F10"style="text-align:right;border:none;padding-right:20px;"colspan="3"><button class="mybutton" style="margin-right:20px;"onclick="myCreate()">Add more row</button><button  class="mybutton"onclick="myDelete()">Delete row</button></td>'
  .'</tr>'
  .'<tr>'
  .'<td class="cell1">Item Name</td>'
  .'<td class="cell2">Quantity</td>'
  .'<td class="cell3">Unit</td>'
  .'<td class="cell3"></td>'
  .'</tr>';
  
  $req1c = "SELECT * FROM `AAitem` WHERE `user`='$encUser' and `project`='$project' and `wing`='$wing' and `bhk`='$xbhk' and `ext1`='$x'";
  $reqRc = mysqli_query($con, $req1c);
  while ($resultc = mysqli_fetch_assoc($reqRc))
  {
  $myitemid = $resultc["id"];
  $myitemname = $resultc["itemname"];
  $myquantity = $resultc["qty"];
  $myunit = $resultc["unit"];
  
  $req1mk = "SELECT * FROM `AAitemname` WHERE `user`='$encUser' and `id`='$myitemname'";
  $reqRmk = mysqli_query($con, $req1mk);
  $resultmk= mysqli_fetch_assoc($reqRmk);
  $myitemname = $resultmk["name"];
  $myitemidzz = $resultmk["id"];
  
  echo'<tr id="itemrow'.$myitemid.'">'
  .'<td class="cell1"><input type="hidden" value="'.$myitemid.'" class="myitemid'.$x.'"> <input type="hidden" value="'.$myitemidzz.'" class="myitem'.$x.'"><input placeholder="item" disabled F12" value="'.$myitemname.'" type="text" style="width:95%;outline:none;background-color:white;height:20px;"></td>'
  .'<td class="cell2"><input placeholder="0.00 "class="myquantity'.$x.' F12" value="'.$myquantity.'" type="number" style="width:90%;outline:none;background-color:white;height:20px;"></td>'
  .'<td class="cell3"><select id="unit'.$myitemid.'" class="myunit'.$x.' F12" style="width:95%;outline:none;background-color:white;height:20px;">'
  .'<option value="BAG">BAG</option>'
  .'<option value="BKT">BKT</option>'
  .'<option value="KG">KG</option>'
  .'<option value="LTR">LTR</option>'
  .'<option value="NOS">NOS</option>'
  .'<option value="BOX">BOX</option>'
  .'<option value="PCS">PCS</option>'
  .'<option value="MTR">MTR</option>'
  .'<option value="FEET">FEET</option>'
  .'<option value="INCH">INCH</option>'
  .'<option value="BNDL">BNDL</option>'
  .'<option value="ROLL">ROLL</option>'
  .'<option value="BTL">BTL</option></select></td>'
  .'<td style="text-align:center;">'
  .'<i onclick="itemdelete('.$myitemid.')" class="fa fa-trash F15 mycontainer"></i></td>';
  echo '<script>document.getElementById("unit'.$myitemid.'").value = "'.$myunit.'";</script>';
  }
  
  echo '</table><table style="width:95%;margin-left:5%;">'
  .'<tr>'
  .'<td style="width:65%;text-align:right;"><button type="button" onclick="update('.$x.');" class="mybutton" >Update</button></td>'
  .'<td style="width:35%;text-align:center;"><button type="button" class="mybutton" data-dismiss="modal" data-toggle="collapse" data-target="#collapseTwo'.$x.'" aria-expanded="false" aria-controls="collapseTwo">Close</button></td>'
  .'</tr>'
  .'</table></div>'
  .'</div>'
  .'</div>';
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
if($permissionA[$x]==19)
{
$check1 =1; //update paid
}
if($permissionA[$x]==20)
{
$check2 =1; //update salary
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



  



<input type="hidden" id="items">






<script>
window.top.postMessage('{"id":5,"data1":"","data2":"","data3":"","data4":""}', '*');
var letters = "/^[A-Z a-z 0-9]+$/";
var id = "<?php echo $encId; ?>";
var User = "<?php echo $encUser; ?>";
var token = "<?php echo $encToken; ?>";
var req = "<?php echo $myreq; ?>";
var url = "<?php echo $url; ?>";
var wingitem = "<?php echo $wing; ?>";
var projectid = "<?php echo $project; ?>";
var myref =0;


var rows =1;
function myCreate() {
    rows=rows+1;
  var table = document.getElementById("myTable"+myref);
  var row = table.insertRow(rows);
  var cell1 = row.insertCell(0).innerHTML='<select class="myitem'+myref+' F12" style="width:95%;outline:none;background-color:white;height:20px;">'+document.getElementById("items").value+'</select>';
  var cell2 = row.insertCell(1).innerHTML='<input placeholder="0.00 "class="myquantity'+myref+' F12" type="number" style="width:90%;outline:none;background-color:white;height:20px;">';
  var cell3 = row.insertCell(2).innerHTML='<input type="hidden" value="" class="myitemid'+myref+'"><select class="myunit'+myref+' F12" style="width:95%;outline:none;background-color:white;height:20px;">'
        
  +'<option>BAG</option>'
  +'<option>BKT</option>'
  +'<option>KG</option>'
  +'<option>LTR</option>'
  +'<option>NOS</option>'
  +'<option>BKT</option>'
  +'<option>BOX</option>'
  +'<option>PCS</option>'
  +'<option>MTR</option>'
  +'<option>FEET</option>'
  +'<option>INCH</option>'
  +'<option>BNDL</option>'
  +'<option>Role</option>'
  +'<option>BTL</option></select>';
  
  
  cell1.className ="cell1";
  cell2.className ="cell2";
  cell3.className ="cell3";

  
  
}
function myDelete(N) {
if(rows>1)
{
  document.getElementById("myTable"+myref).deleteRow(rows);
  rows=rows-1;
}
}

var mydata ="";
function getdata()
{
mydata ="";
var myitem =document.getElementsByClassName("myitem"+myref);
var myquantity =document.getElementsByClassName("myquantity"+myref);
var myunit =document.getElementsByClassName("myunit"+myref);
var myitemid =document.getElementsByClassName("myitemid"+myref);
for (i = 0; i < myitem.length; i++){
   if(i==0)
   {
   mydata+= '{"item":"'+myitem[i].value+'","quantity":"'+myquantity[i].value+'","unit":"'+myunit[i].value+'","itemid":"'+myitemid[i].value+'"}';
    }
    else
    {
    mydata+= '@{"item":"'+myitem[i].value+'","quantity":"'+myquantity[i].value+'","unit":"'+myunit[i].value+'","itemid":"'+myitemid[i].value+'"}';
    }
}
}

function ref(N)
{
myref =N;
rows =1;
}

function update(m)
{
getdata();
var wname = document.getElementById("work"+myref).value;
var wsqft = document.getElementById("sqft"+myref).value;
var wrate = document.getElementById("rate"+myref).value;
var wbhk = document.getElementById("abhk"+myref).value;


 
 if(wsqft<0)
 {
  alert("please input quantity");
 }
  else  if(wrate.length<0)
 {
   alert("plesse input rate");
 }
 else 
 {
	var req5=new XMLHttpRequest();
	req5.open("GET",url+"updateworkname.php?id="+id+"&user="+User+"&bhk="+wbhk+"&data="+mydata+"&wid="+m+"&wrate="+wrate+"&wsqft="+wsqft+"&wname="+wname+"&wing="+wingitem+"&project="+projectid+"&token="+token,true);
	req5.onreadystatechange=function(){
if(req5.readyState==4 && req5.status==200){if( req5.responseText =="ufFygf")
{  

}else{
document.getElementById("asqft"+myref).innerHTML=wsqft;
document.getElementById("arate"+myref).innerHTML=wrate;
window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}','*');
}}}
	req5.send();
	}
	
	}




window.onmessage = function(e) {
    var  req = JSON.parse(e.data);
    var    reqid =req.id;
    var    reqdata1 =req.data1;
    var    reqdata2 =req.data2;
    var    reqdata3 =req.data3;
    var    reqdata4 =req.data4;
    if(reqid==4)
    {
    var wname = document.getElementById("awork"+reqdata1).innerHTML;
    var wbhk = document.getElementById("abhk"+reqdata1).value;
    window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
    var reqrefresh9 =new XMLHttpRequest();
    reqrefresh9.open("GET",url+"deleteworkname.php?id="+id+"&user="+User+"&work="+wname+"&req="+reqdata1+"&bhk="+wbhk+"&wing="+wingitem+"&project="+projectid+"&token="+token,true);
    reqrefresh9.onreadystatechange=function(){
    if(reqrefresh9.readyState==4 && reqrefresh9.status==200){if(reqrefresh9.responseText=="ufFygf")
    {  
    
    }else{
   
    document.getElementById("row"+reqdata1).style.display="none";
    window.top.postMessage('{"id":4,"data1":"","data2":"","data3":"","data4":""}','*');
    }}}
    reqrefresh9.send();
    }
    
    if(reqid==6)
    {
    
    window.top.postMessage('{"id":10,"data1":"","data2":"","data3":"","data4":""}', '*');
    var reqrefresh2 =new XMLHttpRequest();
    reqrefresh2.open("GET",url+"deleteitem.php?id="+id+"&user="+User+"&req="+reqdata1+"&token="+token,true);
    reqrefresh2.onreadystatechange=function(){
    if(reqrefresh2.readyState==4 && reqrefresh2.status==200){if(reqrefresh2.responseText=="ufFygf")
    {  
    
    }else{
    
    document.getElementById("itemrow"+reqdata1).remove();
    window.top.postMessage('{"id":4,"data1":"","data2":"","data3":"","data4":""}','*');
    }}}
    reqrefresh2.send();
    }
};

function workdelete(z)
{
window.top.postMessage('{"id":3,"data1":'+z+',"data2":"","data3":"","data4":""}','*');
}

function itemdelete(p)
{
window.top.postMessage('{"id":7,"data1":'+p+',"data2":"","data3":"","data4":""}','*');
}
function getitemname()
{
var 	req2=new XMLHttpRequest();
req2.open("GET",url+"getitemname.php?id="+id+"&user="+User+"&token="+token,true);
req2.onreadystatechange=function(){
if(	req2.readyState==4 && 	req2.status==200){if(	req2.responseText=="ufFygf")
{  

}else{
 
  
     var projectdata=req2.responseText.trim().split('@');
   for(var i = 0; i < projectdata.length ;  i++)
   {
   if (projectdata[i].length<3)
   {}
   else
   {
   var  rec = JSON.parse(projectdata[i]);
   var  pid=rec.id;
   var  pname=rec.name;
   var  punit=rec.unit;
  
     document.getElementById("items").value = document.getElementById("items").value+'<option value="'+pid+'">'+pname+'</option>';

}}
}}}
req2.send();

}
getitemname();
</script>
</div>
</body>
</html>