<?php
require('fpdf/mc_table.php');
require('con.php');

//number_format($number, 2, '.', ',');
    $id =$_GET["id"];
	$user =$_GET["user"];
	$encUser =$user;
	$token =$_GET["token"];
	
	$emp =$_GET["emp"];
	$empid=$emp;
    $paid =$_GET["paid"];
    $salary =$_GET["salary"];
    $work =$_GET["work"];
    $att =$_GET["att"];
    $issue =$_GET["issue"];
    
    date_default_timezone_set('Asia/Kolkata');
    $date=date('d-m-Y');
    $time =date("h:i:sa");
    $datetime = $date." ".$time;
    $expire=date("d/m/Y", strtotime("+180 days"));

if($work=="true")
{
$paid ="true";
}
if($issue=="true")
{
$salary="true";
}

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



   $sql1b= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $result1b = mysqli_query($con, $sql1b);
   $row1b = mysqli_fetch_assoc($result1b);
   
   $name =$row1b['name'];


$pdf=new PDF_MC_Table();

if($paid=="true")
{
function repeat($con,$pdf,$id,$encUser,$token,$empid,$paid,$salary,$work,$att,$issue)
{







date_default_timezone_set('Asia/Kolkata');
$date=date('d-m-Y');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));


$sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

 $pid =$row1['project'];
 $userid =$row1['addedby'];
 


$sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
$result9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_assoc($result9);




$sql12= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
$result12 = mysqli_query($con, $sql12);
$row12 =mysqli_fetch_assoc($result12);

   $myq1 ="";
   if($work=="true")
   {
   $myq1 ="and `ext1`='true'";
   }
   $myq2 ="";
   if($issue=="true")
   {
   $myq2 ="and `ext1`='true'";
   }

$sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid' ".$myq1."";
$result15 = mysqli_query($con, $sql15);
$row15 =mysqli_fetch_assoc($result15);
$totalPaid = $row15["paid"];

$sql16 = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid' ".$myq2."";
$result16 = mysqli_query($con, $sql16);
$row16 =mysqli_fetch_assoc($result16);

$totalSalary = $row16["salary"];

$available = $totalSalary-$totalPaid;
if($salary!="true")
{
$totalSalary ="00";
$available ="00";
}


$account =substr("#00000000000",0,(10-count($empid))).$empid;
$empname =$row1['name'];
$empnick =$row1['nickname'];
$empdesination =$row1['desination'];
$empmobile =$row1['mobile'];
$empemail =$row1['email'];
$empproject =$row9['name'];
$empdob =$row1['dob'];
$empage =$row1['age'];
$emprdate =$row1['Rdate'];
$empissue =$row1['issue'];
$empexpire =$row1['expire'];
$emptype =$row1['type'];

$paddress2 =$row12["paddress"];

$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Rect(5,5,200,287);
$pdf->Rect(5,5,200,30);

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$dec_iv = '1234567891011121';
$dec_key = "9923377552";

//$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);

$MM=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
$req1 = "SELECT * FROM `AAuser` WHERE `Main`='$MM'";
$reqR = mysqli_query($con, $req1);
$reqData = mysqli_fetch_assoc($reqR);
$cc = $reqData["company"];
$ee= $reqData["email"];
if($MM=='9892558100')
{
$pdf->Image('img/Logo.png',10,5,30,30,'png');
$pdf->SetFont('Times','B',14);
$pdf->SetX(40);
$pdf->MultiCell(130,5,'AASIF ENTERPRISES',0,'C');
$pdf->SetFont('Times','B',10);
$pdf->SetX(40);
$pdf->MultiCell(130,5,'Shop no 7, New Dream Diamond Bld, Shamsh Masjid Gali, Naya Nagar Mira Road East Thane 401107',0,'C');
$pdf->MultiCell(130,5,'Mobile : 9892558100 Email : aasifenterprises09@gmail.com',0,'C');
}
else
{
//$pdf->Image('img/Logo.png',10,5,30,30,'png');
$pdf->SetFont('Times','B',14);
$pdf->SetX(40);
$pdf->MultiCell(130,5,$cc,0,'C');
$pdf->SetFont('Times','B',10);
$pdf->SetX(40);
$pdf->MultiCell(130,5,$cc,0,'C');
$pdf->SetX(40);
$pdf->MultiCell(130,5,'Mobile : '.$MM.' Email : '.$ee,0,'C');
}
$pdf->Rect(5,35,200,15);
$pdf->SetFillColor(0,0,0);
$pdf->Rect(66,38.5,80,10,'F');
$pdf->SetFillColor(255,255,255);
$pdf->Rect(65,37.5,80,10,'FD');
$pdf->Rect(5,50,200,5);
$pdf->Rect(5,55,110,35);
$pdf->Rect(115,55,90,35);
$pdf->Rect(5,257,200,35);
$pdf->Ln();
$pdf->SetY(38);
$pdf->SetX(70);
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,10,"PAID AMOUNT STATEMENT",0,0,'C');
$pdf->Ln();
$pdf->SetX(5);
$pdf->SetY(50);
$pdf->SetFont('Times','B',10);
$pdf->Cell(95,5,"",0,0,'L');
$pdf->Cell(95,5,"Statement date : ".$date,0,0,'R');
$pdf->SetY(55);
$pdf->SetX(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,5,"AC No ",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$account,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Name",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$empname,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Mobile",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$empmobile,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Email",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$empemail,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Address",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->MultiCell(75,5,$paddress2,0,'L');






$pdf->SetFont('Times','B',10);
$pdf->Ln();
$pdf->SetY(55);
$pdf->SetX(115);
$pdf->Cell(25,5,"Registation",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$emprdate,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Project",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$empproject,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Total Paid",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$totalPaid."/-",0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Total Salary",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$totalSalary."/-",0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Available",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$available."/-",0,0,'L');

$pdf->SetY(90);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,110,30,40));
   $myalign =array("C","C","C","C");
   $pdf->Row(array("Sr No","Remarks","Date","Amount"), $myalign );

   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(5);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Employee sign",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(66);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(132);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Approved by",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(132);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(132);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   }
   
   repeat($con,$pdf,$id,$user,$token,$emp,$paid,$salary,$work,$att,$issue);
   $pdf->SetY(95);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,110,30,40));
   $myalign =array("C","L","C","R");
   $pdf->SetFont('Times','',10);
   $pdf->SetX(5);
   $i=1;
   $totalAmt =0;
   $myq ="";
   if($work=="true")
   {
   $myq ="and `ext1`='true'";
   }
   
   $sql8= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `name`='$empid' ".$myq." ORDER BY `date` DESC";
   $result8 = mysqli_query($con, $sql8);
   while ($row8 = mysqli_fetch_assoc($result8))
   {
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $totalAmt = $totalAmt+$empamount;
   $pdf->SetX(5);
   $pdf->Row(array($i++,$empremarks,$empdate,$empamount."   "), $myalign );
   if($pdf->GetY()>250)
   {
   repeat($con,$pdf,$id,$user,$token,$emp,$paid,$salary,$work,$att,$issue);
   $pdf->SetY(95);
   $pdf->SetX(5);
   }
   }
   $pdf->SetWidths(array(160,40));
   $myalign =array("R","R");
   $pdf->SetFont('Times','B',12);
   $pdf->SetX(5);
   $pdf->Row(array("Total Paid Amount    ",$totalAmt."   "), $myalign );
   
   
   }
   if($salary=="true")
   {
   function repeat2($con,$pdf,$id,$encUser,$token,$empid,$paid,$salary,$work,$att,$issue)
   {
   date_default_timezone_set('Asia/Kolkata');
   $date=date('d-m-Y');
   $time =date("h:i:sa");
   $datetime = $date." ".$time;
   $expire=date("d/m/Y", strtotime("+180 days"));
   
   
   $sql1= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $result1 = mysqli_query($con, $sql1);
   $row1 = mysqli_fetch_assoc($result1);
   
   $pid =$row1['project'];
   $userid =$row1['addedby'];
   
   
   
   $sql9= "SELECT * FROM `AAproject` WHERE `user`='$encUser' and `id`='$pid'";
   $result9 = mysqli_query($con, $sql9);
   $row9 = mysqli_fetch_assoc($result9);
   
   
   
   
   $sql12= "SELECT * FROM `AAaddress` WHERE `user`='$encUser' and `name`='$empid'";
   $result12 = mysqli_query($con, $sql12);
   $row12 =mysqli_fetch_assoc($result12);
   
   
   $myq1 ="";
   if($work=="true")
   {
   $myq1 ="and `ext1`='true'";
   }
   $myq2 ="";
   if($issue=="true")
   {
   $myq2 ="and `ext1`='true'";
   }
   
   $sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid' ".$myq1."";
   $result15 = mysqli_query($con, $sql15);
   $row15 =mysqli_fetch_assoc($result15);
   $totalPaid = $row15["paid"];
   
   $sql16 = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid' ".$myq2."";
   $result16 = mysqli_query($con, $sql16);
   $row16 =mysqli_fetch_assoc($result16);
   
   $totalSalary = $row16["salary"];
   
   $available = $totalSalary-$totalPaid;
   
   if($paid!="true")
   {
   $totalPaid ="00";
   $available ="00";
   }
   
   $account =substr("#00000000000",0,(10-count($empid))).$empid;
   $empname =$row1['name'];
   $empnick =$row1['nickname'];
   $empdesination =$row1['desination'];
   $empmobile =$row1['mobile'];
   $empemail =$row1['email'];
   $empproject =$row9['name'];
   $empdob =$row1['dob'];
   $empage =$row1['age'];
   $emprdate =$row1['Rdate'];
   $empissue =$row1['issue'];
   $empexpire =$row1['expire'];
   $emptype =$row1['type'];
   
   $paddress2 =$row12["paddress"];
   
   $pdf->AddPage();
   $pdf->SetFont('Arial','',14);
   $pdf->Rect(5,5,200,287);
   $pdf->Rect(5,5,200,30);
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $dec_iv = '1234567891011121';
    $dec_key = "9923377552";
    
    //$BtokenC = openssl_encrypt($token_stringC, $ciphering, $encryption_key, $options, $encryption_iv);
    
    $MM=openssl_decrypt ( $encUser , $ciphering , $dec_key, $options, $dec_iv);
    $req1 = "SELECT * FROM `AAuser` WHERE `Main`='$MM'";
    $reqR = mysqli_query($con, $req1);
    $reqData = mysqli_fetch_assoc($reqR);
    $cc = $reqData["company"];
    $ee= $reqData["email"];
    if($MM=='9892558100')
    {
    $pdf->Image('img/Logo.png',10,5,30,30,'png');
    $pdf->SetFont('Times','B',14);
    $pdf->SetX(40);
    $pdf->MultiCell(130,5,'AASIF ENTERPRISES',0,'C');
    $pdf->SetFont('Times','B',10);
    $pdf->SetX(40);
    $pdf->MultiCell(130,5,'Shop no 7, New Dream Diamond Bld, Shamsh Masjid Gali, Naya Nagar Mira Road East Thane 401107',0,'C');
    $pdf->MultiCell(130,5,'Mobile : 9892558100 Email : aasifenterprises09@gmail.com',0,'C');
    }
    else
    {
    //$pdf->Image('img/Logo.png',10,5,30,30,'png');
    $pdf->SetFont('Times','B',14);
    $pdf->SetX(40);
    $pdf->MultiCell(130,5,$cc,0,'C');
    $pdf->SetFont('Times','B',10);
    $pdf->SetX(40);
    $pdf->MultiCell(130,5,$cc,0,'C');
    $pdf->SetX(40);
    $pdf->MultiCell(130,5,'Mobile : '.$MM.' Email : '.$ee,0,'C');
    }$pdf->Rect(5,35,200,15);
    
   $pdf->SetFillColor(0,0,0);
   $pdf->Rect(66,38.5,80,10,'F');
   $pdf->SetFillColor(255,255,255);
   $pdf->Rect(65,37.5,80,10,'FD');
   $pdf->Rect(5,50,200,5);
   $pdf->Rect(5,55,110,35);
   $pdf->Rect(115,55,90,35);
   $pdf->Rect(5,257,200,35);
   $pdf->Ln();
   $pdf->SetY(38);
   $pdf->SetX(70);
   $pdf->SetFont('Times','B',12);
   $pdf->Cell(70,10,"SALARY AMOUNT STATEMENT",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->SetY(50);
   $pdf->SetFont('Times','B',10);
   $pdf->Cell(95,5,"",0,0,'L');
   $pdf->Cell(95,5,"Statement date : ".$date,0,0,'R');
   $pdf->SetY(55);
   $pdf->SetX(5);
   $pdf->SetFont('Times','B',10);
   $pdf->Cell(25,5,"AC No ",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(75,5,$account,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(25,5,"Name",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(75,5,$empname,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(25,5,"Mobile",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(75,5,$empmobile,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(25,5,"Email",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(75,5,$empemail,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(25,5,"Address",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->MultiCell(75,5,$paddress2,0,'L');
   
   
   
   
   
   
   $pdf->SetFont('Times','B',10);
   $pdf->Ln();
   $pdf->SetY(55);
   $pdf->SetX(115);
   $pdf->Cell(25,5,"Registation",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(60,5,$emprdate,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(115);
   $pdf->Cell(25,5,"Project",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(60,5,$empproject,0,0,'L');
   $pdf->Ln();
   $pdf->SetX(115);
   $pdf->Cell(25,5,"Total Paid",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(60,5,$totalPaid."/-",0,0,'L');
   $pdf->Ln();
   $pdf->SetX(115);
   $pdf->Cell(25,5,"Total Salary",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(60,5,$totalSalary."/-",0,0,'L');
   $pdf->Ln();
   $pdf->SetX(115);
   $pdf->Cell(25,5,"Available",0,0,'L');
   $pdf->Cell(5,5,":",0,0,'C');
   $pdf->Cell(60,5,$available."/-",0,0,'L');
   
   $pdf->SetY(90);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,110,30,40));
   $myalign =array("C","C","C","C");
   $pdf->Row(array("Sr No","Remarks","Date","Amount"), $myalign );
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(5);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Employee sign",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(66);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(132);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Approved by",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(132);
   $pdf->Cell(66,5,"",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(132);
   $pdf->Cell(66,5,"",0,0,'C');
   
   
   }
   
   repeat2($con,$pdf,$id,$user,$token,$emp,$paid,$salary,$work,$att,$issue);
   $pdf->SetY(95);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,110,30,40));
   $myalign =array("C","L","C","R");
   $pdf->SetFont('Times','',10);
   $pdf->SetX(5);
   $i=1;
   $totalAmt =0;
   $myq="";
   if($issue=="true")
   {
   $myq ="and `ext1`='true'";
   }
   
   $sql8= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `name`='$empid' ".$myq." ORDER BY `date` DESC";
   $result8 = mysqli_query($con, $sql8);
   while ($row8 = mysqli_fetch_assoc($result8))
   {
   $d=strtotime($row8['date']);
   $empdate  = date("d/m/Y", $d); 
   $empdatef  = date("Y-m-d", $d);
   $empamount = $row8['amount'];
   $empremarks = $row8['remarks'];
   $totalAmt = $totalAmt+$empamount;
   $pdf->SetX(5);
   $pdf->Row(array($i++,$empremarks,$empdate,$empamount."   "), $myalign );
   if($pdf->GetY()>250)
   {
   repeat2($con,$pdf,$id,$user,$token,$emp,$paid,$salary,$work,$att,$issue);
   $pdf->SetY(95);
   $pdf->SetX(5);
   }
   }
   $pdf->SetWidths(array(160,40));
   $myalign =array("R","R");
   $pdf->SetFont('Times','B',12);
   $pdf->SetX(5);
   $pdf->Row(array("Total Salary Amount    ",$totalAmt."   "), $myalign );
   
   }
   
   $alluser ="";
   $sqlmobile2g = "SELECT * FROM `AAuser` WHERE `Main`='$decUser' and `role`!='Employee' and `id`!='$decId'";
   $resultmobile2g = mysqli_query($con, $sqlmobile2g);
   while($rowe3dg = mysqli_fetch_array($resultmobile2g)) 
   {
   $alluser = $alluser.$rowe3dg['id'].",";
   }
   
   
   $find = "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $resultfind = mysqli_query($con, $find);
   $rowfind = mysqli_fetch_assoc($resultfind);
   $focus =$rowfind["id"];
   
   $Adescription =", ".$name. " Statement Downloaded";
   $Atitle = "";
   $Aref1 ="1";
   $Aref2 ="1";
   $Aref3 ="";
   $Aref4 ="";
   $Aref5 ="";
   $Aref6 ="";
   $Aref7 ="";
   $Adate =$date;
   $Atime =$time;
   $Atype ="employee";
   $Alimitday ="30";
   $Aalert ="0";
   $Aaddedby =$decId;
   $Ausers =$alluser;
   $Anotif =$alluser;
   $Afocus =$focus;
   $Amainuser =$encUser;
   $qalert="INSERT INTO `AAalert`(`description`, `title`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `date`, `time`, `type`, `Alimit`, `alert`, `addedby`, `users`, `notif`, `focus`, `mainuser`) VALUES ('$Adescription','$Atitle','$Aref1','$Aref2','$Aref3','$Aref4','$Aref5','$Aref6','$Aref7','$Adate','$Atime','$Atype','$Alimitday','$Aalert','$Aaddedby','$Ausers','$Anotif','$Afocus','$Amainuser')";
   $alert = mysqli_query($con, $qalert);
   
   
$pdf->Output($name.'.pdf','D');
?>