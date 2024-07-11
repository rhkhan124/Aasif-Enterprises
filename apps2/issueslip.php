<?php
require('fpdf/mc_table.php');
require_once("con.php");
   

//number_format($number, 2, '.', ',');
    $id =$_GET["id"];
	$user =$_GET["user"];
	$token =$_GET["token"];
	
	$project =$_GET["project"];
	$url =$_GET["url"];
	
    $ref =$_GET["ref"];
    $name =$_GET["name"];



$pdf=new PDF_MC_Table();
function repeat($con,$pdf,$id,$user,$token,$project,$ref)
{

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
	

    $req1xa = "SELECT * FROM `AAissue` WHERE `user`='$user' and `project`='$project' and `token`='$ref'";
    $reqRxa = mysqli_query($con, $req1xa);
    $resutAa =mysqli_fetch_assoc($reqRxa);
     
    $xname = $resutAa["emp"];
    $xtoken = $resutAa["token"];
    $xdate = $resutAa["date"];
    $xaddedby = $resutAa["addedby"];
    $xverified = $resutAa["verified"];
    $xwing = $resutAa["wing"];
    
    
    $decId2 =openssl_decrypt ( $xaddedby , $ciphering, $dec_key, $options, $dec_iv);
    $find2 = "SELECT AAemployees.name ename, AAuser.name uname FROM AAemployees, AAuser WHERE AAemployees.id='$xname' and AAuser.id='$decId2'";
    $resultfind2 = mysqli_query($con, $find2);
    $rowfind2 = mysqli_fetch_assoc($resultfind2);
    $ename =$rowfind2["ename"];
    $uname =$rowfind2["uname"];
    
    $find2f = "SELECT * FROM AAWing WHERE `id`='$xwing'";
    $resultfind2f = mysqli_query($con, $find2f);
    $rowfind2f = mysqli_fetch_assoc($resultfind2f);
    $wingname =$rowfind2f["wing"];
    
    $req1xc = "SELECT * FROM `AAemployees` WHERE `user`='$user' and `id`='$xname'";
    $reqRxc = mysqli_query($con, $req1xc);
    $resutAc =mysqli_fetch_assoc($reqRxc);
    
    $empname =$resutAc["name"];
    $empmobile =$resutAc["mobile"];
    $empemail =$resutAc["email"];
    
    $req1xd = "SELECT * FROM `AAproject` WHERE `user`='$user' and `id`='$project'";
    $reqRxd = mysqli_query($con, $req1xd);
    $resutAd =mysqli_fetch_assoc($reqRxd);
    
    $projectname =$resutAd["name"];
    $projectaddress =$resutAd["address"];
    
    $color ="";
    if($xverified=="Verified")
    {
    $color ="Digitally verified";
    }
    else
    {
    $color ="";
    }








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
$pdf->SetFont('Times','B',16);
$pdf->Cell(70,10,"Material Issued Slip",0,0,'C');
$pdf->Ln();
$pdf->SetX(5);
$pdf->SetY(50);
$pdf->SetFont('Times','B',10);
$pdf->Cell(95,5,"Issue No : ".$xtoken,0,0,'L');
$pdf->Cell(95,5,"Date : ".$xdate,0,0,'R');
$pdf->SetY(60);
$pdf->SetX(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,5,"Project",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$projectname,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Wing",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,$wingname,0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Address",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->MultiCell(75,5,$projectaddress,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Issue to",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,"Employee",0,0,'L');






$pdf->SetFont('Times','B',10);
$pdf->Ln();
$pdf->SetY(60);
$pdf->SetX(115);
$pdf->Cell(25,5,"Emp ID",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,"#".$xname,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Employee",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$ename,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Contact",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$empmobile,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Email",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,$empemail,0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Charge",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,"Not Chargeable",0,0,'L');

$pdf->SetY(90);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","C","C","C","C");
   $pdf->Row(array("Sr No","Item Descriptions","Code","UOM","Quantity"), $myalign );

   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(5);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Recieved by",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,$ename,0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,$color,0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(66);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Issued by",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,$uname,0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"Digitaly verified",0,0,'C');
   
   
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
   
   $xname ="";
   $text ="";
   $text2 ="";
   $req1xa2 = "SELECT * FROM `AAissue` WHERE `user`='$user' and `project`='$project' and `token`='$ref'";
   $reqRxa2 = mysqli_query($con, $req1xa2);
   while ($resutAa2 =mysqli_fetch_assoc($reqRxa2))
   {
   $xremark = $resutAa2["remark"];
   $xname = $resutAa2["emp"];
   if($xremark!=$text)
   {
   $text =$text.$xremark;
   $text2 =$text2.$xremark.", ";
   }
   }
   
   
   repeat($con,$pdf,$id,$user,$token,$project,$ref);
   $pdf->SetY(95);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","L","C","C","R");
   $pdf->SetFont('Times','',10);
   $pdf->SetX(5);
   
   $y=0;
   $req1xa1f = "SELECT * FROM `AAissue` WHERE `user`='$user' and `project`='$project' and `token`='$ref'";
   $reqRxa1f = mysqli_query($con, $req1xa1f);
   while ($resutAa1f =mysqli_fetch_assoc($reqRxa1f))
   {
   $y=$y+1;
   }
   
   
   $x =0;
   $req1xa1 = "SELECT * FROM `AAissue` WHERE `user`='$user' and `project`='$project' and `token`='$ref'";
   $reqRxa1 = mysqli_query($con, $req1xa1);
   while ($resutAa1 =mysqli_fetch_assoc($reqRxa1))
   {
   $x =$x+1;
   $xitem = $resutAa1["item"];
   $xqty = $resutAa1["qty"];
   $xunit = $resutAa1["unit"];
   $xflat = $resutAa1["flat"];
   
   if(count($xflat)>0)
   {
   $xflat =" for the ".$xflat;
   }
  
   
   $find2 = "SELECT AAproject.name pname, AAitemname.name item FROM AAproject, AAitemname WHERE AAproject.id='$project' and AAitemname.id='$xitem'";
   $resultfind2 = mysqli_query($con, $find2);
   $rowfind2 = mysqli_fetch_assoc($resultfind2);
   $itemname2 =$rowfind2["item"];
   
   
   $pdf->SetX(5);
   $pdf->Row(array($x,$itemname2.$xflat,$xitem,$xunit,$xqty."   "), $myalign );
   if($x==$y)
   {
   $pdf->SetX(5);
   $pdf->SetWidths(array(200));
   $myalign =array("L");
   $pdf->SetFont('Times','',10);
   $pdf->SetX(5);
   $pdf->Row(array("Remarks :- ".$text2), $myalign );
   }
   if($pdf->GetY()>250)
   {
   repeat($con,$pdf,$id,$user,$token,$project,$ref);
   $pdf->SetY(95);
   $pdf->SetX(5);
   }
   }
   
   $req1xcb = "SELECT * FROM `AAemployees` WHERE `user`='$user' and `id`='$xname'";
   $reqRxcb = mysqli_query($con, $req1xcb);
   $resutAcb =mysqli_fetch_assoc($reqRxcb);
   
   $empname =$resutAcb["name"];
   
   
   
$pdf->Output($empname.' '.$ref.'.pdf','D');
?>