<?php
$to = "r4razaulhaque@gmail.com";
$subject = "HTML email";

$message = 
/* '
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
 body{background:#E6E6E6;}.mycontainer{
 background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;
 }.myinput{
 border:none;background:#E6E6E6;outline:none;box-shadow:inset 5px 5px 5px #808080, inset -5px -5px 5px #ffffff;
 }.mytext{text-shadow: 2px 2px 2px #808080, -2px -2px 2px #ffffff;}.mytext2{text-shadow: 1px 1px 1px #808080, -1px -1px 1px #ffffff;}.mybutton{border:none;box-shadow:5px 5px 5px #808080, -5px -5px 5px #ffffff;outline:none;background:#E6E6E6; }.mybutton:hover{box-shadow:1px 1px 5px #808080,  -1px -1px 5px #ffffff;}.FAA{color:#000000;}.FB{color:#009dd1;}.FC{color:#ff0000;} .F5{font-size:5px;}  .F6{font-size:6px;}  .F7{font-size:7px;}  .F8{font-size:8px;}  .F9{font-size:9px;}  .F10{font-size:10px;}  .F11{font-size:11px;}  .F12{font-size:12px;}  .F13{font-size:13px;}  .F14{font-size:14px;}  .F15{font-size:15px;}  .F16{font-size:16px;}  .F17{font-size:17px;}  .F18{font-size:18px;}  .F19{font-size:19px;}  .F20{font-size:20px;}  .F21{font-size:21px;}  .F22{font-size:22px;}  .F23{font-size:23px;}  .F24{font-size:24px;}  .F25{font-size:25px;}  .F26{font-size:26px;}  .F27{font-size:27px;}  .F28{font-size:28px;}  .F29{font-size:29px;}  .F30{font-size:30px;}  .F31{font-size:31px;}  .F32{font-size:32px;}  .F33{font-size:33px;}  .F34{font-size:34px;}  .F35{font-size:35px;}  .F36{font-size:36px;}  .F37{font-size:37px;}  .F38{font-size:38px;}  .F39{font-size:39px;}  .F40{font-size:40px;}  .F{font-size:px;} 

</style>*/

'<body ondragstart="return false" onselectstart="return false" style="width:100%;height:100%;overflow-x:hidden;">
<div class="fullbody" id="accordionExample">

<div style="width:100%;background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;"  >
<div style="font-weight:bold;font-family:times;text-align:center;padding-top:10px;" >Aasif Enterprises Employee Report</div>
<div style="width:92%;margin:4%;border:none;background:black;"  >
<div style="height:1%;background-black;" ></div>




<div style="width:94%;margin:3%;background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;"  >
<div style="font-weight:bold;font-family:times;text-align:center;padding-top:10px;">34 Park Estate</div>
<div class="F12" style="font-weight:bold;font-family:times;text-align:left;padding-top:10px;padding-left:10px;" >A Wing</div>

<table class="F12" style="width:100%;font-weight:bold;font-family:times;padding-top:10px;">
<tr>
<td>Total Mason</td><td>10</td><td>Total Helper</td><td>10</td>
</tr>
<tr>
<td>Date</td><td>22-12-2023</td><td>Total Manpower</td><td>10</td>
</tr>
</table>
<table class="F12" border="1" style="width:100%;font-weight:bold;font-family:times;">
<tr>
<td style="text-align:center;" >1</td><td>RH khan</td><td style="text-align:center;">1</td>
</tr>
<tr>
<td style="text-align:center;" >1</td><td>RH khan</td><td style="text-align:center;">1</td>
</tr>
<tr>
<td style="text-align:left;" colspan="3" >This is remarks</td>
</tr>
</table>

</div>







<div style="height:1%;background-black;" ></div>
</div>
<hr>
</div>
<table>

</table>

</div>
</body>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@aasifenterprises.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>