<?php
require('fpdf/mc_table.php');

   

//number_format($number, 2, '.', ',');
    $id =$_GET["id"];
	$user =$_GET["user"];
	$token =$_GET["token"];
	
	$project =$_GET["project"];
	$url =$_GET["url"];
	
    $ref =$_GET["ref"];
    $name =$_GET["name"];



$pdf=new PDF_MC_Table();
function repeat($pdf)
{
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Rect(5,5,200,287);
$pdf->Rect(5,5,200,30);
$pdf->Image('img/Logo.png',10,5,30,30,'png');
$pdf->SetFont('Times','B',14);
$pdf->SetX(40);
$pdf->MultiCell(130,5,'AASIF ENTERPRISES',0,'C');
$pdf->SetFont('Times','B',10);
$pdf->SetX(40);
$pdf->MultiCell(130,5,'Shop no 7, New Dream Diamond Bld, Shamsh Masjid Gali, Naya Nagar Mira Road East Thane 401107',0,'C');
$pdf->SetX(40);
$pdf->MultiCell(130,5,'Mobile : 9892558100 Email : aasifenterprises09@gmail.com',0,'C');
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
$pdf->Cell(95,5,"Issue No : 7554375465",0,0,'L');
$pdf->Cell(95,5,"Date : 12-05-2022",0,0,'R');
$pdf->SetY(60);
$pdf->SetX(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(25,5,"Project",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(75,5,"34 Park Estate",0,0,'L');
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(25,5,"Address",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->MultiCell(75,5,"Teen dongri yaswant, nagar, Near ganesh mandir Goregaon west mumbai",0,'L');
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
$pdf->Cell(60,5,"#46565",0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Employee",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,"Razaul Haque Khan",0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Contact",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,"9923377552",0,0,'L');
$pdf->Ln();
$pdf->SetX(115);
$pdf->Cell(25,5,"Email",0,0,'L');
$pdf->Cell(5,5,":",0,0,'C');
$pdf->Cell(60,5,"r4razaulhaque@gmail.com",0,0,'L');
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
   $pdf->Cell(66,5,"Razaul Haque Khan",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(5);
   $pdf->Cell(66,5,"Digitaly verified",0,0,'C');
   
   
   $pdf->Ln();
   $pdf->SetY(255);
   $pdf->SetX(66);
   $pdf->SetFont('Times','',10);
   $pdf->Cell(66,10,"Issued by",0,0,'C');
   $pdf->Ln();
   $pdf->SetX(66);
   $pdf->Cell(66,5,"Shadab Khan",0,0,'C');
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
   
   repeat($pdf);
   $pdf->SetY(95);
   $pdf->SetX(5);
   $pdf->SetWidths(array(20,90,20,30,40));
   $myalign =array("C","L","C","C","R");
   $pdf->SetFont('Times','',10);
   $pdf->SetX(5);
   for($i=0;$i<40;$i++)
   {
   $pdf->SetX(5);
   $pdf->Row(array($i,"Gypsum Powder", $pdf->GetY() ,"BAG","480.00   "), $myalign );
   if($pdf->GetY()>250)
   {
   repeat($pdf);
   $pdf->SetY(95);
   $pdf->SetX(5);
   }
   }
$pdf->Output('temp/'.$name.' '.$ref.'.pdf','F');
?>