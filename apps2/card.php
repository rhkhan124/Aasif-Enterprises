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

echo '<table style="width:100%;margin-top:5px;overflow:hidden;" >
<tr>
<td>
<select onchange="empchange()" id="myemp"style="width:90%; font-family:times;font-weight:bold;" class="F14 mybutton">';

$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Main' and `role`='Restore' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_assoc($result1))
{
$emp1 = $row1['id'];
$empname1 = $row1['name'];
echo '<option value="'.$emp1.'">'.$empname1.'</option>';
$sql1b= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `type`='Group employee' and `role`='Restore' and `ext1`='$emp1'";
   $result1b = mysqli_query($con, $sql1b);
   while ($row1b = mysqli_fetch_assoc($result1b))
   {
   $emp2 = $row1b['id'];
   $empname2 = $row1b['name'];
   echo '<option value="'.$emp2.'">'.$empname2.'</option>';
}
}

echo '</select>
</td>
<td style="width:35%;">
<select id="mydate" onchange="monthchange()" style="width:90%;font-family:times;font-weight:bold;" class="F14 mybutton" >';

$req1 = "SELECT * FROM `AAreport` WHERE `user`='$encUser' and `emp`='$empid' group by month(date), year(date)";
   $run1 = mysqli_query($con, $req1);
   while( $responce =mysqli_fetch_array($run1))
   {
   $mydate = $responce["date"];
   
   $yrdata= strtotime($mydate);
   $mytext1 = date('F-Y', $yrdata);

echo '<option value="'.$mydate.'">'.$mytext1.'</option>';
}
echo '</select>
</td>
</tr>
</table>';




?>

<iframe class="" id="h" style="width:100%;height:700px;overflow-x:hidden;outline:none;" src=""></iframe>

  










<script>
var letters = "/^[A-Z a-z 0-9]+$/";
var id = "<?php echo $encId; ?>";
var User = "<?php echo $encUser; ?>";
var token = "<?php echo $encToken; ?>";
var main = "<?php echo $empid; ?>";
var req = "<?php echo $myreq; ?>";
var url = "<?php echo $url; ?>";

function empchange()
{
var empid = document.getElementById("myemp").value;
var mydate = document.getElementById("mydate").value;
var mydatetext = $( "#mydate option:selected" ).text();
document.getElementById("h").src=url+"carddata.php?id="+id+"&user="+User+"&token="+token+"&main="+main+"&text="+mydatetext+"&empid="+empid+"&date="+mydate+"&url="+url;
}

function monthchange()
{
var empid = document.getElementById("myemp").value;
var mydate = document.getElementById("mydate").value;
var mydatetext = $( "#mydate option:selected" ).text();
document.getElementById("h").src=url+"carddata.php?id="+id+"&user="+User+"&token="+token+"&main="+main+"&text="+mydatetext+"&empid="+empid+"&date="+mydate+"&url="+url;
}

var empid = document.getElementById("myemp").value;
var mydate = document.getElementById("mydate").value;
var mydatetext = $( "#mydate option:selected" ).text();
document.getElementById("h").src=url+"carddata.php?id="+id+"&user="+User+"&token="+token+"&main="+main+"&text="+mydatetext+"&empid="+empid+"&date="+mydate+"&url="+url;

/*
window.top.postMessage('{"id":4,"data1":"","data2":"","data3":"","data4":""}', '*');
function update(v)
{

var amount = document.getElementById("amount"+v).value;
var date = document.getElementById("date"+v).value;
var remark = document.getElementById("remark"+v).value;

var amount2 =document.getElementById("amountb"+v).innerHTML;
var date2 =document.getElementById("dateb"+v).innerHTML;
var remark2 =document.getElementById("remarkb"+v).innerHTML;


if(1==1)
{
if(amount.length>=0)
{
window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
var reqrefresh=new XMLHttpRequest();
reqrefresh.open("GET",url+"updatemoney2.php?id="+id+"&user="+User+"&token="+token+"&amount="+amount+"&date="+date+"&remark="+remark+"&amount2="+amount2+"&date2="+date2+"&remark2="+remark2+"&empid="+empid+"&uid="+v+"&req="+req,true);
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
window.top.postMessage('{"id":3,"data1":"'+reqrefresh.responseText.trim()+'","data2":"","data3":"","data4":""}', '*');
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
var row=0;
function rowdelete(row)
{
row=row;
window.top.postMessage('{"id":5,"data1":'+row+',"data2":"","data3":"","data4":""}', '*');
}


function change()
{
var myamount =0;
var i=0;
var inputs = document.getElementsByClassName("check");
for( i = 0; i < inputs.length; i++) {
        if (inputs[i].checked == true)
        {
        var myid = inputs[i].value;
          myamount2 =parseInt(document.getElementById("amountb"+myid).innerHTML);
        myamount = myamount+myamount2;

}
}
window.top.postMessage('{"id":1,"data1":'+myamount.toFixed(2)+',"data2":"","data3":"","data4":""}', '*');
}
change();
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
    
   
    window.top.postMessage('{"id":2,"data1":"","data2":"","data3":"","data4":""}', '*');
    var reqrefresh2 =new XMLHttpRequest();
    reqrefresh2.open("GET",url+"deletemoney2.php?id="+id+"&user="+User+"&token="+token+"&amount2="+amount2+"&date2="+date2+"&remark2="+remark2+"&empid="+empid+"&uid="+reqdata1+"&req="+req,true);
    reqrefresh2.onreadystatechange=function(){
    if(reqrefresh2.readyState==4 && reqrefresh2.status==200){if(reqrefresh2.responseText=="ufFygf")
    {  
    
    }else{
   // alert(reqrefresh2.responseText.trim());
    document.getElementById("row"+reqdata1).style.display="none";
    change();
    window.top.postMessage('{"id":7,"data1":"'+ reqrefresh2.responseText.trim() +'","data2":"","data3":"","data4":""}', '*');
    }}}
    reqrefresh2.send();
    
    
    }
};

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
   window.top.postMessage('{"id":3,"data1":"5","data2":"","data3":"","data4":""}', '*');
   }}}
   reqrefresh3.send();
   
}
*/

</script>
</div>
</body>
</html>