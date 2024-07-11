<?php
require('fpdf/fpdf.php');


class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}
// $MatchName="";
// $myColor ="";
function Row($data)
{
    //Calculate the height of the row


    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
		if ($i==0)
		{
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		}
		else if ($i==3)
		{
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		}
		else if ($i==4)
			{
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
		}
		else
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		}
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text



		if ($i==3)
			{

        $this->MultiCell($w-4,5,$data[$i],0,$a);
		}
		else
		{

        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
		}
		$this->SetXY($x+$w,$y);

    }
    //Go to the next line
    $this->Ln($h);
}
function RowT($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
       // $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}

  class PDF extends FPDF
  {

  // Page footer
  function Footer()
  {
  // Position at 1.5 cm from bottom


  $this->SetY(-15);
  // Arial italic 8
  $this->SetFont('Arial','I',8);
  // Page number
  //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
  }
require_once("con.php");

date_default_timezone_set('Asia/Kolkata');
$date =date('Y/m/d');
$date2=date('d/m/Y');
$expire =date("Y/m/d", strtotime($date." -1 days"));
$Tdate ="";
$sqle2lg = "SELECT * FROM `Dates`";
$resulte2lg = mysqli_query($con, $sqle2lg);
    while($rowe2lg = mysqli_fetch_assoc($resulte2lg)) {

	$Tdate = $rowe2lg["dates"] ;

	}
$pvrs7 =date("Y/m/d", strtotime($Tdate." -7 days"));
$pvrs72 =date("Y/m/d", strtotime($Tdate." -1 days"));

  $pdf=new PDF_MC_Table();
  $pdf->AddPage();
  $pdf->AddFont('times','','times.php');
  $pdf->SetFont('Times', 'B', 35);
  $pdf->SetTextColor(0, 77, 133);
  $pdf->Ln(7);
  $pdf->Cell(0, 0, 'AASIF ENTERPRISES', 0,0,'C');
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->SetTextColor(0, 79, 76);
  $pdf->Ln(20);
  $pdf->Cell(0, 0, 'Two Week Paid Amount Records ', 0,0,'L');
  $pdf->Ln(5);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetFillColor(0, 79, 76);
  $pdf->Cell(30,5,"", 0,1,'L',true);
  $pdf->SetTextColor(0, 79, 76);
  $pdf->Cell(0, -4,"                                      This  color indicate single value", 0,0,'L');
  $pdf->Ln(1);
  $pdf->SetFillColor(194, 0, 0);
  $pdf->Cell(30,5,"", 0,1,'L',true);
  $pdf->SetTextColor(194, 0, 0);
  $pdf->Cell(0, -4,"                                      Red color indicate double value", 0,0,'L');
  $pdf->Ln(5);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetTextColor(0, 79, 76);
  $pdf->Cell(0, 0,"This Week ".$Tdate. ' to ' .$expire, 0,0,'R');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',8);
  $pdf->SetWidths(array(15,51,51,36,36));
  srand(microtime()*1000000);
  $y =0;
  for($i=0;$i<1;$i++)
  $pdf->Row(array("    Sr No","                        Name","                         Remarks","            Date           ","Amounts               "));


$sqle2l = "SELECT * FROM `Dates`";
$resulte2l = mysqli_query($con, $sqle2l);
    while($rowe2l = mysqli_fetch_assoc($resulte2l)) {

	$Tdate = $rowe2l["dates"] ;
  //for($i=0;$i<12;$i++)
	  $x =0;
		
    $MatchName="";
    $matchColor="";
    $sqle2x = "SELECT `name` FROM `spend` WHERE `user`='aasifenterprises09@gmail.com' AND `role`='Restore' AND ext2 between '$Tdate' and '$date' GROUP BY `name`";
  $resulte2x = mysqli_query($con, $sqle2x);
      while($rowe2x = mysqli_fetch_assoc($resulte2x)) {
    $Fnamex = $rowe2x["name"];


	$sqle2 = "SELECT * FROM `spend` WHERE `user`='aasifenterprises09@gmail.com' AND `name`='$Fnamex' AND `role`='Restore' AND ext2 between '$Tdate' and '$date' ORDER BY id ASC";
$resulte2 = mysqli_query($con, $sqle2);
    while($rowe2 = mysqli_fetch_assoc($resulte2)) {
       $x = $x+1;
		$y = $y+$rowe2["amount"];
		$Nname = $rowe2["name"];
		$sql = "SELECT * FROM `employees` WHERE `user`='aasifenterprises09@gmail.com' AND id='$Nname'";
        $result = mysqli_query($con, $sql);
	    $row = mysqli_fetch_assoc($result);
		$Fname = $row["name"];
    if($MatchName==$Fname)
    {
      $pdf->SetTextColor(194, 0, 0);
    }
    else {
      $pdf->SetTextColor(0, 79, 76);
    }

$MatchName=$Fname;
  $pdf->Row(array($x,$Fname."  (" .$rowe2["amount"]. ")",$rowe2["comment"],$rowe2["date"],$rowe2["amount"].'/-      '));
}}


$start=$Tdate;
$end=$date;
$amount=$y;
$status="pending";
$user="aasifenterprises09@gmail.com";
// url=http://aasifenterprises.com/apps/useremail.php?user=r4razaulhaque@gmail.com
$sqlG = "SELECT * FROM `secure` WHERE `start`='$start' AND `end`='$end' AND `amount`='$amount'AND `user`='$user'";
$resultG = mysqli_query($con, $sqlG);

if (mysqli_num_rows($resultG) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($resultG)) {
       
       
    }
} else {

     $sqlD = "INSERT INTO `secure` (`id`, `start`, `end`, `amount`, `status`, `user`, `ext1`, `ext2`, `ext3`) VALUES (NULL, '$start', '$end', '$amount', '$status', '$user', '', '', '')";
     $resultD = mysqli_query($con, $sqlD);
     
       }


















  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(117, 5, '', 1,0,'L');
  $pdf->Cell(36, 5, 'Total', 1,0,'C');
  $pdf->Cell(36, 5, $y.'/-     ', 1,0,'R');

	}

  $pdf->Ln(15);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetTextColor(0, 79, 76);
  $pdf->Cell(0, 0,"Privious Week ".$pvrs7. ' to ' .$pvrs72, 0,0,'R');
  $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B', 8);
  $x =0;
  $y =0;
  $pdf->Row(array("    Sr No","                        Name","                         Remarks","            Date           ","Amounts               "));
  $MatchName="";
  $matchColor="";


$y =0;
  $sqle2xz = "SELECT `name` FROM `spend` WHERE `user`='aasifenterprises09@gmail.com' AND `role`='Restore' AND ext2 between '$Tdate' and '$date' GROUP BY `name`";
$resulte2xz = mysqli_query($con, $sqle2xz);
    while($rowe2xz = mysqli_fetch_assoc($resulte2xz)) {
  $Fnamexz = $rowe2xz["name"];


$sqle2 = "SELECT * FROM `spend` WHERE `user`='aasifenterprises09@gmail.com' AND `name`='$Fnamexz' AND `role`='Restore' AND ext2 between '$pvrs7' and '$pvrs72' ORDER BY amount DESC";
$resulte2 = mysqli_query($con, $sqle2);
  while($rowe2 = mysqli_fetch_assoc($resulte2)) {
     $x = $x+1;
  $y = $y+$rowe2["amount"];
  $Nname = $rowe2["name"];
  $sql = "SELECT * FROM `employees` WHERE `user`='aasifenterprises09@gmail.com' AND id='$Nname'";
      $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
  $Fname = $row["name"];
if($MatchName==$Fname)
{
  $pdf->SetTextColor(194, 0, 0);
}
else {
  $pdf->SetTextColor(0, 79, 76);
}
$MatchName=$Fname;
$pdf->Row(array($x,$Fname."  (" .$rowe2["amount"]. ")",$rowe2["comment"],$rowe2["date"],$rowe2["amount"].'/-      '));
}}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(117, 5, '', 1,0,'L');
$pdf->Cell(36, 5, 'Total', 1,0,'C');
$pdf->Cell(36, 5, $y.'/-     ', 1,0,'R');

     // $sqle2lk = "UPDATE `Dates` SET `dates`='$date'";
     // $resulte2lk = mysqli_query($con, $sqle2lk);
$pdf->Output();

$filename = 'Weekly Report.pdf';
$file = 'Weekly Report.pdf';
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

// header
$header = "From:  Weekly Report Aasif Enterprises <weekly@aasifenterprises.com>\r\n";
$header .= "Reply-To: \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= "\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";
$nmessage .= "<p>Please find blew aattachment </P>";

mail("aasifenterprises09@gmail.com,r4razaulhaque@gmail.com", "Weekly Report ", $nmessage, $header);
    


?>