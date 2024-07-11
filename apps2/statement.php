<?php
require('fpdf/mc_table.php');
require('con.php');
   

//number_format($number, 2, '.', ',');
    $id =$_GET["id"];
	$user ="r0g5Sx047QSLiQ==";
	$token =$_GET["token"];
	
	$project =$_GET["project"];
	$url =$_GET["url"];
	
    $ref =$_GET["ref"];
    $name =$_GET["name"];
    
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
$date=date('d-m-Y');
$time =date("h:i:sa");
$datetime = $date." ".$time;
$expire=date("d/m/Y", strtotime("+180 days"));



// Today is 2011-03-30
$first = date('Y-m-d', strtotime('first day of last month')); // Output:
$last = date('Y-m-d', strtotime('last day of last month')); // Output:

$first2 = date('d-m-Y', strtotime('first day of last month')); // Output:
$last2 = date('d-m-Y', strtotime('last day of last month')); // Output:


$pdf=new PDF_MC_Table();
function repeat($pdf,$con,$first,$last,$date)
{
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Rect(5,5,200,287);
$pdf->Rect(5,5,200,30);
$pdf->Image('logo/letterhead.png',0,0,210,295,'png');
$pdf->SetFont('Times','B',14);
$pdf->SetFillColor(0,0,0);
$pdf->Rect(66,43.5,80,10,'F');
$pdf->SetFillColor(255,255,255);
$pdf->Rect(65,42.5,80,10,'FD');
$pdf->Ln();
$pdf->SetY(43);
$pdf->SetX(70);
$pdf->SetFont('Times','B',16);
$pdf->Cell(70,10,"STATEMENT",0,0,'C');
$pdf->Ln();
$pdf->SetX(5);
$pdf->SetY(50);
$pdf->SetFont('Times','',10);
$pdf->Cell(95,5,"Period ".$first." To ".$last,0,0,'L');
$pdf->Cell(95,5,"Date : ".$date,0,0,'R');
   
   
   }
   
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   $color =1;
   $sql1= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `date` between '$first' AND '$last' and `role`='Restore' and `type`!='grp' GROUP BY `name`";
   $result1 = mysqli_query($con, $sql1);
   while ($row1 = mysqli_fetch_assoc($result1))
   {
   if($color==1)
   {
   $color =2;
   $pdf->SetTextColor(230,16,151);
   }
   else
   {
   $color =1;
   $pdf->SetTextColor(10,133,255);
   }
   
   $empid =$row1['name'];
   
   $sql2= "SELECT * FROM `AAemployees` WHERE `user`='$encUser' and `id`='$empid'";
   $result2 = mysqli_query($con, $sql2);
   $row2 = mysqli_fetch_assoc($result2);
   $name =$empid."-".$row2['name'];
   
   
   
   $sql15 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid'";
   $result15 = mysqli_query($con, $sql15);
   $row15 =mysqli_fetch_assoc($result15);
   $totalPaid1 = $row15["paid"];
   
   $sql16 = "SELECT SUM(amount) as paid FROM `AAPaid` WHERE `name`='$empid' and `date` between '$first' AND '$last'";
   $result16 = mysqli_query($con, $sql16);
   $row16 =mysqli_fetch_assoc($result16);
   $totalPaid2 = $row16["paid"];
   
   $opening =$totalPaid1-$totalPaid2;
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','B',12);
   $pdf->Cell(209,5,"PAID AMOUNT",0,0,'C');
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','B',10);
   $pdf->Cell(209,5,"Employee Name :- ".$name,0,0,'L');
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','',10);
   $pdf->Cell(209,5,"Closing balance is....".$opening."/-",0,0,'L');
   $pdf->SetFont('Times','',10);
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","C","C","C","C");
   $pdf->Row(array("Sr No","Remarks","Date","Amount","Added by"), $myalign );
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","L","C","R","R");
   $i=1;
   $sql3= "SELECT * FROM `AAPaid` WHERE `user`='$encUser' and `date` between '$first' AND '$last' and `name`='$empid'";
   $result3 = mysqli_query($con, $sql3);
   while ($row3 = mysqli_fetch_assoc($result3))
   {
   
   $remark =$row3['remarks'];
   $date2BBB =$row3['date'];
   $d1=strtotime($date2BBB);
   $date2 = date("d-m-Y", $d1); 
   $amount =$row3['amount'];
   $encId2 =$row3['addedby'];
   $decId2 =openssl_decrypt ( $encId2 , $ciphering, $dec_key, $options, $dec_iv);
   
   $sql4= "SELECT * FROM `AAuser` WHERE `id`='$decId2'";
   $result4 = mysqli_query($con, $sql4);
   $row4 = mysqli_fetch_assoc($result4);
   $username =$row4['name'];
   
   $pdf->SetX(5);
   $pdf->Row(array($i++,$remark,$date2,$amount."/-",$username." "), $myalign );
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   }
   
   $pdf->SetX(5);
   $pdf->SetWidths(array(130,30,40));
   $myalign =array("R","R","R");
   $pdf->Row(array("Paid Amount of this month   ",$totalPaid2."/-",""), $myalign );
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetX(5);
   $pdf->Row(array("Total Paid Amount   ",$totalPaid1."/-",""), $myalign );
   $pdf->Ln();
   
   
   
   
   
   
   
   
   $sql15B = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid'";
   $result15B = mysqli_query($con, $sql15B);
   $row15B =mysqli_fetch_assoc($result15B);
   $totalPaid1B = $row15B["salary"];
   if($totalPaid1B>0)
   {
   $sql16B = "SELECT SUM(amount) as salary FROM `AASalary` WHERE `name`='$empid' and `date` between '$first' AND '$last'";
   $result16B = mysqli_query($con, $sql16B);
   $row16B =mysqli_fetch_assoc($result16B);
   $totalPaid2B = $row16B["salary"];
   
   $openingB =$totalPaid1B-$totalPaid2B;
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','B',12);
   $pdf->Cell(209,5,"SALARY AMOUNT",0,0,'C');
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','B',10);
   $pdf->Cell(209,5,"Employee Name :- ".$name,0,0,'L');
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetFont('Times','',10);
   $pdf->Cell(209,5,"Closing balance is....".$openingB."/-",0,0,'L');
   $pdf->SetFont('Times','',10);
   $pdf->Ln();
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","C","C","C","C");
   $pdf->Row(array("Sr No","Remarks","Date","Amount","Added by"), $myalign );
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","L","C","R","R");
   $iB=1;
   $sql3B= "SELECT * FROM `AASalary` WHERE `user`='$encUser' and `date` between '$first' AND '$last' and `name`='$empid'";
   $result3B = mysqli_query($con, $sql3B);
   while ($row3B = mysqli_fetch_assoc($result3B))
   {
   
   $remarkB =$row3B['remarks'];
   $date2BB =$row3B['date'];
   $d1=strtotime($date2BB);
   $date2B = date("d-m-Y", $d1); 
   $amountB =$row3B['amount'];
   $encId2B =$row3B['addedby'];
   $decId2B =openssl_decrypt ( $encId2B , $ciphering, $dec_key, $options, $dec_iv);
   
   $sql4B= "SELECT * FROM `AAuser` WHERE `id`='$decId2B'";
   $result4B = mysqli_query($con, $sql4B);
   $row4B = mysqli_fetch_assoc($result4B);
   $usernameB =$row4B['name'];
   
   $pdf->SetX(5);
   $pdf->Row(array($iB++,$remarkB,$date2B,$amountB."/-",$usernameB." "), $myalign );
   if($pdf->GetY()>260)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   }
   
   $pdf->SetX(5);
   $pdf->SetWidths(array(130,30,40));
   $myalign =array("R","R","R");
   $pdf->Row(array("Salary Amount of this month   ",$totalPaid2B."/-",""), $myalign );
   $pdf->SetX(5);
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   $pdf->Row(array("Total Salary Amount   ",$totalPaid1B."/-",""), $myalign );
   $pdf->SetX(5);
   if($pdf->GetY()>270)
   {
   repeat($pdf,$con,$first2,$last2,$date);
   $pdf->SetY(55);
   $pdf->SetX(5);
   }
   
   $pdf->Row(array("Total Available Amount   ",($totalPaid1B-$totalPaid1)."/-",""), $myalign );
   $pdf->Ln();
   $pdf->Ln();
   }
   
   
   }
//$pdf->Output('Test.pdf','D');

$pdf->Output('Monthly Statement.pdf','F');

$filename = 'Monthly Statement.pdf';
$file = 'Monthly Statement.pdf';
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

// header
$header = "From:  Statement Aasif Enterprises <statement@aasifenterprises.com>\r\n";
$header .= "Reply-To: admin@aasifenterprises.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $message."\r\n\r\n";
$nmessage .= "--".$uid."\r\n"; 
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";
$nmessage .= "<p>Please find blew aattachment </P>";

if (mail("aasifenterprises09@gmail.com,r4razaulhaque@gmail.com", "Monthly Statement", $nmessage, $header)) {
    return true; // Or do something here
} else {
  return false;
}



?>