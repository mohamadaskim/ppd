<?php

session_start();
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/dbcon/ppd.php");
define('USER',$_SESSION['user-ppdkluang']);


if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);

    $kuri = $PPD->prepare("SELECT * FROM `penilaian_bulan` where ID=? and kodsekolah=? LIMIT 1");
    $kuri->execute([$id,USER]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);




$tarikh=$newDate = date("d-M-Y", strtotime($d['tarikh']));
$bulan=$newDate = date("F", strtotime($d['tarikh']));
$tahun=$newDate = date("Y", strtotime($d['tarikh']));
$kodsekolah=$d['kodsekolah'];
$syarikat=$d['syarikat'];
$tempoh_mula=$newDate = date("d-m-Y", strtotime($d['tempoh_mula']));
$tempoh_tamat=$newDate = date("d-m-Y", strtotime($d['tempoh_tamat']));
$murid=$d['murid'];
$zon=$d['zon'];
if($kodsekolah==''){
	        ?>
<script>alert("Tiada Rekod");
window.location.href='senarai.php';
</script>

<?php
}
}

//require('../fpdf/fpdf.php');
require('../fpdf/mc_table2.php');


$pdf=new PDF_MC_Table();
//$pdf = new FPDF();
$pdf->SetTitle('KBK');
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,15,'LAMPIRAN 1.2',0,0,'R');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14); 
$pdf->Cell(10,7,'',0,0);
$pdf->Cell(15 ,7,'KBK',1,1,'C');

$pdf->SetFont('Times','B',8);
$pdf->Cell(10,5,'',0,0);

$pdf->Cell(151,5,'LAPORAN PRESTASI BULANAN',0,0);
$pdf->Cell(20,5,$tarikh,0,1);

$pdf->SetFont('Times','B',12);
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Perkhidmatan Kebersihan Bangunan dan Kawasan',0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(70,5,'KOD DAN NAMA SEKOLAH/ INSTITUSI',0,0);
$pdf->Cell(5,5,':',0,0,'C');
$pdf->Cell(95,5,'PEJABAT PENDIDIKAN DAERAH KLUANG',1,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(70,5,'NAMA KONTRAKTOR',0,0);
$pdf->Cell(5,5,':',0,0,'C');
$pdf->Cell(45,5,$syarikat,1,0);
$pdf->Cell(15,5,'ZON',1,0);
$pdf->Cell(5,5,':',1,0,'C');
$pdf->Cell(10,5,$zon,1,0,'C');
$pdf->Cell(10,5,' ',1,0,'C');
$pdf->Cell(10,5,'13',1,1,'C');

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(70,5,'TEMPOH KONTRAK',0,0);
$pdf->Cell(5,5,':',0,0,'C');
$pdf->Cell(30,5,$tempoh_mula,1,0);
$pdf->Cell(18,5,'MULA',1,0);
$pdf->Cell(30,5,$tempoh_tamat,1,0);
$pdf->Cell(17,5,'TAMAT',1,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(70,5,'BULAN & TAHUN',0,0);
$pdf->Cell(5,5,':',0,0,'C');
$pdf->Cell(30,5,$bulan,1,0);
$pdf->Cell(18,5,'BULAN',1,0);
$pdf->Cell(30,5,$tahun,1,0);
$pdf->Cell(17,5,'TAHUN',1,1);

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(70,5,'BILANGAN MURID SEMASA',0,0);
$pdf->Cell(5,5,':',0,0,'C');
$pdf->Cell(30,5,$murid,1,1);

function lain($PPD,$id,$user,$data_id){
	$kuri = $PPD->prepare("SELECT COUNT(*) as bil from penilaian_data  where  kodsekolah=? and perkara_id=? and data_id=? and value=1");
$kuri->execute([$user,$id,$data_id]);
$kaun = $kuri->fetch()['bil']; 
if($kaun==1) return '/';
}
function ulasan($PPD,$id,$user,$data_id){
	$kuri = $PPD->prepare("SELECT ulasan from penilaian_data  where  kodsekolah=? and perkara_id=? and data_id=?");
$kuri->execute([$user,$id,$data_id]);
$kaun = $kuri->fetch()['ulasan']; 
 return $kaun;
}
$pdf->Ln(5); 
$pdf->SetFont('Times','',8);


$pdf->SetWidths(array(10,65,35,30,50));
$pdf->SetAligns(array(1,1,1,555,70));
$pdf->Row(array('BIL','PERKARA DINILAI','MARKAH PENILAIAN','ULASAN','CATATAN'));
$x=0;
$kanan=$pdf->GetY();
$kuri = $PPD->prepare("SELECT * FROM `penilaian_perkara` where kategori = 1 and kat_tajuk!='Lain-Lain' group by kat_tajuk");
$kuri->execute([]);
$mainsub = $kuri->fetchAll(PDO::FETCH_ASSOC);
$jumlah=0;
foreach($mainsub as $s){

$pdf->Cell(140,5,$s['kat_tajuk'],1,1);
$dat=$s['kat_tajuk'];
$kurisub = $PPD->prepare("SELECT *,SUBSTR(ulasan,1,20) ulasan2 FROM `penilaian_perkara` p inner join penilaian_data d on d.perkara_id=p.ID where kategori = 1 and kat_tajuk='$dat' and d.kodsekolah=? and d.data_id=?");
$kurisub->execute([USER,$id]);
$sub = $kurisub->fetchAll(PDO::FETCH_ASSOC);

foreach($sub as $a){
$x++;
$ya=$pdf->GetY();
$pdf->Row(array($x,$a['tajuk'],'',$a['ulasan2']));
$yb=$pdf->GetY();
$y=$yb-$ya;
$pdf->SetXY(85,$yb-$y);
$value=$a['value'];
$pdf->Cell(17,$y,$value,1,0,'C');

$pdf->Cell(18,$y,'',1,1,'C');
$jumlah+=$value;
}

}
$pdf->Cell(140,5,'JUMLAH KESELURUHAN',1,1,'C');
//$pdf->Cell(75,5,'JUMLAH KESELURUHAN',1,0,'C');
//$pdf->Cell(17,5,'',1,0,'C');

//$pdf->Cell(18,5,'',1,0,'C');
//$pdf->Cell(30,5,'',1,1,'C');
$pdf->Cell(75,10,'PERATUS = (JUMLAH KESELURUHAN/75)*100',1,0,'C');
$pdf->Cell(17,10,$jumlah,1,0,'C');
$peratus=intval(($jumlah/75)*100);
$pdf->Cell(18,10,$peratus.'%',1,0,'C');
$pdf->Cell(30,10,'',1,1,'C');
$kotakbawahkiri=$pdf->GetY();

$pdf->SetXY(10,$kanan);
$kotakatas=$pdf->GetY();
$x33='';
$n33=lain($PPD,33,USER,$id);
if($n33=='') $x33='/';
$x34='';
$n34=lain($PPD,34,USER,$id);
if($n34=='') $x34='/';
$n35=ulasan($PPD,35,USER,$id);

$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(55,5,'1. Kes salah laku pekerja:',0,1,'L');
$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(5,5,'',0,0,'C');
$pdf->Cell(10,5,'Ada',0,0,'L');
$pdf->Cell(10,5,$n33,1,1,'C');
$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(5,5,'',0,0,'C');
$pdf->Cell(10,5,'Tiada',0,0,'L');
$pdf->Cell(10,5,$x33,1,1,'C');
$pdf->Cell(10,5,'',0,1,'C');

$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(55,5,'2. Cadangan pihak sekolah:',0,1,'L');
$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(5,5,'',0,0,'C');
$pdf->Cell(31,5,'Perkhidmatan diteruskan',0,0,'L');
$pdf->Cell(10,5,$n34,1,1,'C');
$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(5,5,'',0,0,'C');
$pdf->Cell(31,5,'Perkhidmatan ditamatkan',0,0,'L');
$pdf->Cell(10,5,$x34,1,1,'C');
$pdf->Cell(10,5,'',0,1,'C');

$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(55,5,'(Ulasan)',0,1,'L');
$pdf->Cell(140,5,'',0,0,'C');
$pdf->Cell(5,5,'',0,0,'C');
$pdf->SetFont('Times','U',8);
$pdf->MultiCell(40,5,$n35,0,'L',0);
$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',0,1,'C');




$kotakbawah=$pdf->GetY();



$sizekotak=$kotakbawahkiri-$kotakatas;
$pdf->SetXY(0,$kanan);
$pdf->Cell(150,5,'',0,0,'C');
$pdf->Cell(50,$sizekotak,'',1,1,'C');








$pdf->Ln(5);

$pdf->SetFont('Times','',7);
$pdf->Cell(140,3,'Skala Markah  berdasarkan takrifan yang dinyatakan dalam Lampitan 1.6:',0,1,'L');
$pdf->Cell(140,3,'1. Lemah           2. Tidak memuaskan           3.Sederhana             4. Baik              5. Cemerlang',0,1,'L');

$pdf->Ln(3);
$pdf->MultiCell(190,3,'Catatan:  Seksyen 18, akta SPRM: " Seseorang melakukan kesalahan jika dia memberi seseorang agen, atau sebagai seorang agen dia menggunaka, dengan niat hendak memperdayakan prinsipalnya, apa-apa resit, akaun atau dokumen lain yang berkenaan dengan prinsipalnyaitu mempunyai kepentingan, dan yang dia mempunyai sebab untuk mempercayai mengandungi apa-apa pernyataan yang palsu atau silap atau tidak lengkap tentang apa-apa pernyataan yang palsu atau tidak lengkap tentang apa-apa butir matan, dan yang dimaksudkan untuk mengelirukan prinsipalnya.',0,'L',0);

$pdf->Ln(3);
$pdf->SetFont('Times','',9);
$pdf->Cell(75,5,'Disediakan Oleh:',0,0,'L');
$pdf->Cell(45,5,'',0,0,'L');
$pdf->Cell(75,5,'Disahkan Oleh:',0,1,'L');

$pdf->Cell(75,5,'',0,0,'L');
$pdf->Cell(45,5,'',0,0,'L');
$pdf->Cell(75,5,'',0,1,'L');

$pdf->Cell(75,5,'...........................',0,0,'L');
$pdf->Cell(45,5,'',0,0,'L');
$pdf->Cell(75,5,'...........................',0,1,'L');

$pdf->Cell(75,3,'Nama:',0,0,'L');
$pdf->Cell(45,3,'',0,0,'L');
$pdf->Cell(75,3,'Nama:',0,1,'L');

$pdf->Cell(75,3,'KPT/ PEK/ Guru Penolong Kanan',0,0,'L');
$pdf->Cell(45,3,'',0,0,'L');
$pdf->Cell(75,3,'Ketua Jabatan',0,1,'L');

$pdf->Cell(75,3,'Tarikh:',0,0,'L');
$pdf->Cell(45,3,'',0,0,'L');
$pdf->Cell(75,3,'Tarikh:',0,1,'L');




$pdf->Output();
?>