<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


 <link href="css/all.css" rel="stylesheet">
 
 <link href="boostrap/css/bootstrap2.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap3.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap4.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap5.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap6.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap7.css" rel="stylesheet">
 <link href="boostrap/css/bootstrap8.css" rel="stylesheet">
 <link href="boostrap/css/swiper.min.css" rel="stylesheet">
 
 <script src="js/all.js"></script>
 <script src="boostrap/js/jquery.js"></script>
 <script src="boostrap/js/date.js"></script>
 <script src="boostrap/js/date2.js"></script>
 <script src="boostrap/js/bootstrap.js" type="text/javascript" ></script><style type="text/css">
 body{background:#E6E6E6;font-family:times;}.mycontainer{position:relative;background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;}.mycontainer2{background:#E6E6E6;box-shadow:4px 4px 4px #808080,-4px -4px 4px #ffffff;}.myinput{position:relative;border:none;background:#E6E6E6;outline:none;box-shadow:inset 5px 5px 5px #808080, inset -5px -5px 5px #ffffff;}.myinput2{border:none;background:#E6E6E6;outline:none;box-shadow:inset 2px 2px 2px #808080, inset -2px -2px 2px #ffffff;}.mybutton{border:none;box-shadow:5px 5px 5px #808080, -5px -5px 5px #ffffff;outline:none;background:#E6E6E6; }.mybutton:hover{box-shadow:1px 1px 5px #808080,  -1px -1px 5px #ffffff;}.FAA{color:#000000;}.FB{color:#009dd1;}.FC{color:#ff0000;} .F0{font-size:0px;}  .F1{font-size:0px;}  .F2{font-size:0px;}  .F3{font-size:1px;}  .F4{font-size:2px;}  .F5{font-size:3px;}  .F6{font-size:4px;}  .F7{font-size:5px;}  .F8{font-size:6px;}  .F9{font-size:7px;}  .F10{font-size:8px;}  .F11{font-size:9px;}  .F12{font-size:10px;}  .F13{font-size:11px;}  .F14{font-size:12px;}  .F15{font-size:13px;}  .F16{font-size:14px;}  .F17{font-size:15px;}  .F18{font-size:16px;}  .F19{font-size:17px;}  .F20{font-size:18px;}  .F21{font-size:19px;}  .F22{font-size:20px;}  .F23{font-size:21px;}  .F24{font-size:22px;}  .F25{font-size:23px;}  .F26{font-size:24px;}  .F27{font-size:25px;}  .F28{font-size:26px;}  .F29{font-size:27px;}  .F30{font-size:28px;}  .F31{font-size:29px;}  .F32{font-size:30px;}  .F33{font-size:31px;}  .F34{font-size:32px;}  .F35{font-size:33px;}  .F36{font-size:34px;}  .F37{font-size:35px;}  .F38{font-size:36px;}  .F39{font-size:37px;}  .F40{font-size:38px;}  .F41{font-size:39px;}  .F42{font-size:px;} 

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

</style>
</head>
<script language="JavaScript">
    function clp_clear() {
        var content=window.clipboardData.getData("Text");
        if (content==null) {
            window.clipboardData.clearData();
        }
        setTimeout("clp_clear();",1000);
    }
    </script>
</head>
<body onload='clp_clear()'>

<?php
require_once("con.php");

/*
$myfile = fopen("count.txt", "r") or die("Unable to open file!");
$txt= fread($myfile,filesize("count.txt"));
fclose($myfile);

$myfile = fopen("count.txt", "w") or die("Unable to open file!");
$txt = +$txt+1;
fwrite($myfile, $txt);
fclose($myfile);

*/




/*
 mail( '+918669062338@aasifenterprises.com', '', 'This is a Test Message.' ) ;
*/


$empid= $_SERVER['QUERY_STRING'];
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$dec_iv = '1234567891011121';
$dec_key = "9923377552";
date_default_timezone_set('Asia/Kolkata');
$date=date('dmY');
$time =date("hi");
$datetime = $date.$time;
$expire=date("d/m/Y", strtotime("+180 days"));
//$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);
$empid =openssl_decrypt ( $empid , $ciphering, $dec_key, $options, $dec_iv);


$sql1= "SELECT * FROM `AAemployees` WHERE `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$mobile =$row1['mobile'];
$name =$row1['name'];
$nickname =$row1['nickname'];
$email =$row1['email'];
$desination =$row1['desination'];
$originalDate2 =$row1['Rdate'];
$registration= date("d-m-Y", strtotime($originalDate2));
$pid =$row1['project'];
$encUser =$row1['user'];
$encId =$row1['addedby'];

$sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_assoc($result9);
$project=$row9['name'];


$sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid' and `ext1`='true'";
$result15 = mysqli_query($con, $sql15);
$row15 =mysqli_fetch_assoc($result15);
$totalPaid = $row15["paid"];

$sql16 = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid' and `ext1`='true'";
$result16 = mysqli_query($con, $sql16);
$row16 =mysqli_fetch_assoc($result16);
$totalSalary = $row16["salary"];


?>

<div class="mycontainer"><div style="font-family:times;height:50px;padding-top:20px;font-size:30px;text-align:center;font-weight:bold;">Digital Diary </div>
<hr>


<div class="mycontainer"><div style="font-family:times;height:50px;padding-top:20px;font-size:20px;text-align:center;font-weight:bold;">AASIF ENTERPRISES</div>
<hr>
<div style="width:100%;" >
<div id="prog1" style="background-color:green;width:0%;hight:10px;" >0%</div>
</div>
<table style="width:100%;" >
<tr>
<td><div class="upload-btn-wrapper mybutton" style="margin:3px;">
<button class="mybutton" style="height:auto;width:100%;" > 
<input type="file" name="myfile1" id="myfile1">Change Photo
</button>
</div></td>
<td><button class="mybutton" data-toggle="modal" data-target="#exampleModal">Upload Documents</button></td>
<td><button class="mybutton">Update address</button></td>
</tr>
</table>
<hr>
<table style="width:100%;" >
<tr>
<td><button class="mybutton">Download Statement</button></td>
<td><button class="mybutton">Download APKs</button></td>
<td><button class="mybutton">Get ID Password</button></td>
</tr>
</table>
<hr>
<table style="width:90%;" ><tr><td>
<div class="mycontainer"  style="border-radius:50%;height:100px;width:100px;" ><img src="user.png" id="img" onerror="imgerror()" style="height:100px;width:100px;border-radius: 50%;" alt="Avatar">
</div>
</td>
<script type="text/javascript">
var empid = "<?php echo $empid; ?>";
document.getElementById("img").src="http://aasifenterprises.com/apps2/folder/"+empid+".png";
function imgerror()
{
document.getElementById("img").src="http://aasifenterprises.com/user2.png";
}

</script>
<td style="font-size:20px;font-weight:bold;" > <?php echo $name; ?> </td>
</tr></table>
<table  style="width:100%;font-size:10;">
<tr>
<td>Nick Name</td>
<td> <?php echo $nickname; ?> </td>
<td>ID No</td>
<td>#<?php echo $empid; ?> </td>
</tr>
<tr>
<td>Registration</td>
<td><?php echo $registration; ?> </td>
<td>Desination</td>
<td><?php echo $desination; ?> </td>
</tr>
<tr>
<td>Mobile</td>
<td><?php echo $mobile; ?> </td>
<td>Email</td>
<td><?php echo $email; ?> </td>
</tr>
<tr>
<td>Project</td>
<td colspan="3" ><?php echo $project; ?> </td>
</tr>


</table>
</div>

<div class="mycontainer">
<table  style="width:100%;font-size:12px;" >
<tr>
<td>Total Paid(-)</td>
<td style="text-align:center;"  >Net Balance</td>
</tr>
<tr style="font-size:14px;font-weight:bold;" >
<td><strong>₹</strong> <?php echo $totalPaid; ?><strong>.00</strong></td>
<td style="text-align:center;color:red;font-size:20px;"  > <div class="mycontainer2"><strong>₹</strong> <?php echo ($totalSalary-$totalPaid); ?><strong>.00</strong></div></td>
</tr>
<tr>
<td>Total Salary(+)</td>
</tr>
<tr style="font-size:14px;font-weight:bold;" >
<td> <strong>₹</strong> <?php echo $totalSalary; ?><strong>.00</strong></td>
</tr>

</table>
<div style="text-size:12px;text-align:center;" >Paid-Out Transaction History</div>
<hr>

<table border="1"style="border: 1px solid black;border-collapse: collapse;width:100%;font-size:10px;">
<tr style="text-align:center;font-weight:bold;" >
<td>SR</td>
<td>Remark</td>
<td>Date</td>
<td>Amount</td>

</tr>
<?php
$i=1;
$sql14= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' and `ext1`='true' ORDER BY `date` DESC ";
$result14 = mysqli_query($con, $sql14);
while ($row14 = mysqli_fetch_assoc($result14))
{

 $remark =$row14['remarks'];
 $originalDate=$row14['date'];
 $dateT= date("d-m-Y", strtotime($originalDate));
 $amount =$row14['amount'];
 
 echo '<tr style="" >
 <td style="text-align:center;">'.$i++.'</td>
 <td>'.$remark.'</td>
 <td style="text-align:center;">'.$dateT.'</td>
 <td style="text-align:right;"><strong>₹</strong> '.$amount.'<span>.00</span></td>
 </tr>';
 
 }

?>

</table>


<div style="text-size:12px;text-align:center;" >Salary Transaction History</div>
<hr>

<table border="1"style="border: 1px solid black;border-collapse: collapse;width:100%;font-size:10px;">
<tr style="text-align:center;font-weight:bold;" >
<td>SR</td>
<td>Remark</td>
<td>Date</td>
<td>Amount</td>

</tr>
<?php
$i=1;
$sql15= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `name`='$empid' and `ext1`='true' ORDER BY `date` DESC ";
$result15 = mysqli_query($con, $sql15);
while ($row15 = mysqli_fetch_assoc($result15))
{

 $remark =$row15['remarks'];
 $originalDate=$row15['date'];
 $dateT= date("d-m-Y", strtotime($originalDate));
 $amount =$row15['amount'];
 
 echo '<tr style="" >
 <td style="text-align:center;">'.$i++.'</td>
 <td>'.$remark.'</td>
 <td style="text-align:center;">'.$dateT.'</td>
 <td style="text-align:right;"><strong>₹</strong> '.$amount.'<span>.00</span></td>
 </tr>';
 
 }

?>

</table>
</div>



</body>
</html>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table style="width:100%;" >
        <tr>
        <td style="width:50%;" ><img src="front.png" style="width:100%;" ></td>
        </tr>
        <tr>
        <td> <div class="upload-btn-wrapper mybutton" style="margin:3px;">
        <button class="mybutton" style="height:auto;width:100%;" > 
        <input type="file" name="myfile2" id="myfile2">Upload aadhar card front photo
        </button>
        </div></td>
        <td><div id="prog2" style="background-color:green;width:0%;hight:10px;" >0%</div></td>
        </tr>
        
        <tr>
        <td><hr></td>
        <td><img src="back.png" style="width:100%;" ></td>
        </tr>
        <tr>
        <td> <div id="prog3" style="background-color:green;width:0%;hight:10px;" >0%</div></td>
        <td> <div class="upload-btn-wrapper mybutton" style="margin:3px;">
        <button class="mybutton" style="height:auto;width:100%;" > 
        <input type="file" name="myfile3" id="myfile3">Upload aadhar card back photo
        </button>
        </div></td>
        </tr>
        
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

var id= "<?php echo $encId; ?>";
var User= "<?php echo $encUser; ?>";
var ref2= "<?php echo $empid; ?>";
var codename= "";
var filename="";
function _(el){ 	return document.getElementById(el); }

 
 function upload(M)
 {
 
 var m=M;
 if(m==1)
 {
 var filename ="Profile Photo";
 var codename= "<?php echo $empid; ?>";
 }
 else if (m==2)
 {
 var filename ="Aadhar Front";
 var codename= "<?php echo $empid; ?>aadharFront";
 }
 else if (m==3)
 {
 var filename ="Aadhar Back";
 var codename= "<?php echo $empid; ?>aadharBack";
 }

document.getElementById("prog"+m).style.width="0%";
document.getElementById("prog"+m).innerHTML="0%";
 		var filep= _("myfile"+m).files[0]; 	
 	
 // alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData(); 
		formdata.append("myfile"+m, filep); 
			var ajax = new XMLHttpRequest(); 
				ajax.upload.addEventListener("progress", progressHandler, false); 	
				ajax.addEventListener("load", completeHandler, false); 	
				ajax.addEventListener("error", errorHandler, false); 	
				ajax.addEventListener("abort", abortHandler, false); 
				
					ajax.open("POST","https://aasifenterprises.com/apps2/uploadfolder5.php?id="+id+"&user="+User+"&token=&filecodename="+codename+"&filename="+filename+"&ref3=1&type=file&position=0&w="+m+"&ref1=Home&ref2="+ref2);
					ajax.send(formdata); 
					function progressHandler(event){ 	
					var percent = (event.loaded / event.total) * 100; 	
			//		_("progressBar").value = Math.round(percent); 	
					//app.Execute("loader2(2);");   
					
					document.getElementById("prog"+m).style.width=Math.round(percent)+"%";
				    document.getElementById("prog"+m).innerHTML= Math.round(percent)+"%";
				    var myper =Math.round(percent);
				    if(m==1 && myper==100)
				    {
				    document.getElementById("img").src="http://aasifenterprises.com/apps2/folder/"+ref2+".png";
				    }
					} 
					function completeHandler(event){ 	

				       //app.Execute("loader2(4);");   
              //app.SaveText("msg",'{"color":"green","msg":"Seccessfully uploded"}');
               //getfolder();
					} function errorHandler(event){ 
					alert("error");
					       //app.Execute("loader2(4);");   
  //app.SaveText("msg",'{"color":"red","msg":"Uploading failed"}');
						} function abortHandler(event){ 	
      //app.Execute("loader2(4);");   
 // app.SaveText("msg",'{"color":"red","msg":"Connection aborted"}');
						} 
						}
$("#myfile1").change(function(){
	upload(1);
});

$("#myfile2").change(function(){
  upload(2);
});

$("#myfile3").change(function(){
  upload(3);
});





</script>


