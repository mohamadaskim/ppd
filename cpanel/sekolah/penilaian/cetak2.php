<?php
//require('../fpdf/fpdf.php');
require('../fpdf/mc_table2.php');


$pdf=new PDF_MC_Table();
//$pdf = new FPDF();
$pdf->SetTitle('KBK');
$pdf->AddPage();
$pdf->Ln(10); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,15,'LAMPIRAN 1.2',1,0,'R');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',14); 
$pdf->Cell(10,7,'',1,0);
$pdf->Cell(15 ,7,'KBK',1,1,'C');

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',1,0);

$pdf->Cell(101,5,'LAPORAN PRESTASI BULANAN',1,0);
$pdf->Cell(20,5,'Sept-2021',1,1);

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'',1,0);
$pdf->Cell(170,5,'Perkhidmatan Kebersihan Bangunan dan Kawasan',1,1,'C');


$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',1,0);
$pdf->Cell(70,5,'KOD DAN NAMA SEKOLAH/ INSTITUSI',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(95,5,'PEJABAT PENDIDIKAN DAERAH KLUANG',1,1);

$pdf->Cell(10,5,'',1,0);
$pdf->Cell(70,5,'NAMA KONTRAKTOR',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(45,5,'RZ BINA & ENTERPRISE',1,0);
$pdf->Cell(15,5,'ZON',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(10,5,'D',1,0,'C');
$pdf->Cell(10,5,' ',1,0,'C');
$pdf->Cell(10,5,'13',1,1,'C');

$pdf->Cell(10,5,'',1,0);
$pdf->Cell(70,5,'TEMPOH KONTRAK',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(30,5,'01.07.2019',1,0);
$pdf->Cell(18,5,'MULA',1,0);
$pdf->Cell(30,5,'31.12.2021',1,0);
$pdf->Cell(17,5,'TAMAT',1,1);

$pdf->Cell(10,5,'',1,0);
$pdf->Cell(70,5,'BILANGAN MURID SEMASA',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(30,5,'0',1,1);



$pdf->Ln(10); 
$pdf->SetFont('Times','',10);


$pdf->SetWidths(array(10,70,25,25,60));
$pdf->SetAligns(array(1,1,1,555,70));
$pdf->Row(array('BIL','PERKARA DINILAI','MARKAH PENILAIAN','ULASAN','CATATAN'));




$pdf->Ln(30); 

$pdf->Cell(10,50,'',1,0);
$pdf->Cell(70,5,'',1,0);
$pdf->Cell(25,5,'',1,0,'C');
$pdf->Cell(25,5,'',1,0);
$pdf->Cell(60,50,'',1,0);
$pdf->Cell(0,5,'',1,1);

$pdf->Cell(10,50,'',0,0);
$pdf->Cell(70,5,'',1,0);
$pdf->Cell(25,5,'',1,0,'C');

$pdf->Cell(0,5,'',1,1);

$pdf->Cell(10,50,'',0,0);
$pdf->Cell(70,5,'',1,0);
$pdf->Cell(25,5,'',1,0,'C');

$pdf->Cell(0,5,'',1,1);








$pdf->Ln(30);




$pdf->Cell(10,20,'',0,0);
$pdf->Cell(70,20,'PERKARADINILAI',1,0);
$pdf->Cell(25,20,'MARKAH PENILAIAN',1,0,'C');
$pdf->Cell(25,20,'ULASAN',1,0);
$pdf->MultiCell(60, 55, 'dfgdfgdfgdfgdfgdfgdfgdfgdfg', 1,'C');

$pdf->Cell(10,20,'BIL',1,0);
$pdf->Cell(70,20,'PERKARADINILAI',1,0);
$pdf->Cell(25,20,'MARKAH PENILAIAN',1,0,'C');
$pdf->Cell(25,20,'ULASAN',1,0);


$pdf->Ln(50); 

$widths = array(10, 70, 25, 25, 60);
$border = array('TLBR', 'TLBR', 'TLBR', 'TLBR', 'TLBR');
$caption = array('BIL','PERKARA DINILAI', 'MARKAH PENILAIAN', 'ULASAN','CATATAN');
$caption2 = array('BIL','PERKARA DINILAI', 'MARKAH PENILAIAN', 'ULASAN', 'ULASAN');
$align = array('', 'C', 'C', 'C', '');
$style = array('', 'I', '', 'I', '');
$empty = array('','','','','');
$pdf->SetWidths($widths);
//$pdf->FancyRow($empty, $border);
$pdf->FancyRow($caption, $border, $align, $style);
$pdf->FancyRow($caption2, $border, $align, $style);

$column_widths = ["50","50","50","50"];

// First row.
$pdf->Cell($column_widths[0],                     5, "Cell", 1, 0, "C", false);
$pdf->Cell($column_widths[1] + $column_widths[2], 5, "Cell", 1, 0, "C", false);
$pdf->Cell($column_widths[3],                     5, "Cell", 1, 1, "C", false);

// Second row.
$pdf->Cell($column_widths[0], 5, "Cell", 1, 0, "C", false);
$pdf->Cell($column_widths[1], 5, "C1",   1, 0, "C", false);
$pdf->Cell($column_widths[2], 5, "C2",   1, 0, "C", false);
$pdf->Cell($column_widths[3], 5, "Cell", 1, 1, "C", false);

// Third row.
$pdf->Cell($column_widths[0], 5, "",     1, 0, "C", false);
$pdf->Cell($column_widths[1], 5, "C1",   1, 0, "C", false);
$pdf->Cell($column_widths[2], 5, "C2",   1, 0, "C", false);
$pdf->Cell($column_widths[3], 5, "Cell", 1, 0, "C", false);

$pdf->Output();
?>