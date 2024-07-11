<?php
require('fpdf/mc_table.php');

function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}

//number_format($number, 2, '.', ',');
$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,50,30,40,10));
$myalign =array("L","C","L","R","R");
srand(microtime()*1000000);
for($i=0;$i<20;$i++)
    $pdf->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence(),$i."\n ok"), $myalign );
$pdf->Output();
?>