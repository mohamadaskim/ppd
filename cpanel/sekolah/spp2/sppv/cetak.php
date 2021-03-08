<?php
session_start();
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/dbcon/ppd.php");
define('USER',$_SESSION['user-ppdkluang']);

if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);

    $kuri = $PPD->prepare("SELECT s.*,sek.realname,j.jawatan jawatannama,isp.ISP,isp.TALIAN,isp.tarikhpasang FROM `spp` s left join spp_jawatan j on j.kod=s.jawatan left join users_sekolah sek on sek.username=s.kodsekolah inner join spp_isp isp on isp.kodsekolah2=s.kodsekolah WHERE s.ID = ? and s.kodsekolah = ? LIMIT 1");
    $kuri->execute([$id,USER]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);

$u2='';
$v2='';
$catatan2='';
$u3='';
$v3='';
$catatan3='';

$isp1="";
$isp2="";
$isp3="";
$isp4="";
$isp5="";

$nama=$d['namapegawai'];
$jawatannama=$d['jawatannama'];
$tarikh=$newDate = date("d-m-Y", strtotime($d['tarikh']));

$tarikhpasang=$newDate = date("d-m-Y", strtotime($d['tarikhpasang']));
$kodsekolah=$d['kodsekolah'];
$namasekolah=$d['realname'];
$v1=$d['v1'].'  Mbps';
$u1=$d['u1'].'  Mbps';
$catatan1=$d['catatan1'];
if(isset($d['v2'])){
$v2=$d['v2'].'  Mbps';
$u2=$d['u2'].'  Mbps';
$catatan2=$d['catatan2'];	

}
if(isset($d['v3'])){
$v3=$d['v3'].'  Mbps';
$u3=$d['u3'].'  Mbps';
$catatan3=$d['catatan3'];
}




$isp=$d['ISP'];
$tekno=$d['TALIAN'];
if($isp=='Celcom'){

$isp1="Celcom Mobile Sdn. Bhd.";
$isp2="Level 26@Celcom, No. 6";
$isp3="Persiaran Barat, Seksyen 52";
$isp4="46200 Petaling Jaya";
$isp5="Selangor Darul Ehsan";
}

if($isp=='Maxis'){

$isp1="Maxis Sdn. Bhd.";
$isp2="";
$isp3="";
$isp4="";
$isp5="";
}


if($isp=='TM'){

$isp1="TM";
$isp2="";
$isp3="";
$isp4="";
$isp5="";
}
if($kodsekolah==''){
	        ?>
<script>alert("Tiada Rekod");
window.location.href='senarai.php';
</script>

<?php
}
}


require('../fpdf/fpdf.php');


//require('../fpdf/mc_table2.php');


//$pdf=new PDF_MC_Table();
$pdf = new FPDF();
$pdf->SetTitle('SIJIL PENGUJIAN DAN PENTAULIAHAN');
$pdf->AddPage();
$pdf->Ln(5); 
$pdf->SetFont('Arial','B',12);

$pdf->Cell(190,15,'SIJIL PENGUJIAN DAN PENTAULIAHAN VERSI 3.0',0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','',10); 
$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,'(Nama Syarikat dan Alamat)',0,1);

$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,$isp1,0,1);

$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,$isp2,0,1);

$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,$isp3,0,1);

$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,$isp4,0,1);

$pdf->Cell(115,5,'',0,0);
$pdf->Cell(75,5,$isp5,0,1);





//$pdf->Cell(101,5,'LAPORAN PRESTASI BULANAN',0,0);
//$pdf->Cell(20,5,'Sept-2021',0,1);




$pdf->SetFont('Times','',11);
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Setiausaha Bahagian',0,1,'');
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Bahagian Pengurusan Maklumat',0,1,'');
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Kementerian Pendidikan Malaysia',0,1,'');
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Aras 3-4, Blok E11, Kompleks E,',0,1,'');
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'Pusat Pentadbiran Kerajaan Persekutuan,',0,1,'');
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(170,5,'62604 WILAYAH PERSEKUTUAN PUTRAJAYA',0,1,'');



$pdf->Ln(3); 
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(178,5,'Tuan,',0,1,'');
$pdf->Ln(3); 

$pdf->SetFont('Times','B',12);
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(188,5,'Projek Pelaksanaan Talian Internet bagi Agensi KPM Dalam Tempoh Interim.',0,1,'');
$pdf->Ln(3); 
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(25,5,'No. Kontrak:',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(160,5,' KPM.BPL.S.400-10/3/128 Jilid 2(34) / LA190000000056717 / CT190000000041959',0,1,'');
$pdf->Ln(3); 
$pdf->Cell(15,5,'',0,0);
$pdf->Cell(178,5,'Merujuk kepada kontrak tersebut di atas, dengan ini dimaklumkan bahawa item di bawah yang mana',0,1,'');
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(35,5,'telah dibekalkan ke ',0,0);
$pdf->SetFont('Times','B',10);
$y=$pdf->GetY();

$pdf->Cell(85,5,''.$namasekolah.' ('.$kodsekolah.')',0,0);
$pdf->SetFont('Times','U',10);
$pdf->SetXY(52,$y);
$pdf->Cell(85,5,'                                                                                             ',0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(10,5,'pada',0,0);
$pdf->SetFont('Times','UB',11);
$pdf->Cell(20,5,$tarikhpasang,0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(30,5,'dan telah berjaya',0,1,'');
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(65,5,'dipasang, diujilari dan ditauliah pada ',0,0);
$pdf->SetFont('Times','UB',11);
$pdf->Cell(118,5,$tarikh,0,1,'');
$pdf->SetFont('Times','',12);
$pdf->Ln(5); 









$pdf->SetFont('Times','B',13);



$pdf->Cell(10,10,'Bil.',1,0,'C');

$y=$pdf->GetY();
$pdf->MultiCell(35,5,'No. Kod & Nama Item',1,'C',0);



$pdf->SetXY(55,$y);
$pdf->Cell(25,10,'Kuantiti',1,0,'C');

$pdf->Cell(25,10,'Peralatan',1,0,'C');
$pdf->Cell(25,10,'Berfungsi',1,0,'C');
$pdf->Cell(70,5,'Pengesahan Ujian Speed Test',1,1,'C');
$y=$pdf->GetY();
$pdf->SetXY(130,$y);
$pdf->Cell(35,5,'Upload',1,0,'C');
$pdf->Cell(35,5,'Download',1,1,'C');


$pdf->SetFont('Times','',12);


$pdf->Cell(10,15,'1.',1,0,'C');
$y=$pdf->GetY();
$pdf->MultiCell(35,5,'Perkhidmatan 4G tanpa wayar - Celcom',1,'L',0);



$pdf->SetXY(55,$y);

$y=$pdf->GetY();
$pdf->Cell(25,15,$tekno.' unit',1,0,'C');
if($v1=='' || $v1=='0'){
	$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 1',1,0,'C');
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Ya/Tidak',1,0,'C');
}else{
$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 1',1,0,'C');
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Ya',1,0,'C');	
}

$pdf->Cell(35,5,$u1,1,0,'C');
$pdf->Cell(35,5,$v1,1,1,'C');


$pdf->SetXY(80,$y+5);
if($v2=='' || $v2=='0'){
	$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 2',1,0,'C');
$pdf->SetFont('Times','',12);
if($tekno>=2){
$pdf->Cell(25,5,'Ya/Tidak',1,0,'C');
}
else
{
$pdf->Cell(25,5,'',1,0,'C');	
}

}else{
$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 2',1,0,'C');
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Ya',1,0,'C');	
}


$pdf->Cell(35,5,$u2,1,0,'C');
$pdf->Cell(35,5,$v2,1,1,'C');

$pdf->SetXY(80,$y+10);
if($v3=='' || $v3=='0'){
	$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 3',1,0,'C');
$pdf->SetFont('Times','',12);

if($tekno>=3){
$pdf->Cell(25,5,'Ya/Tidak',1,0,'C');
}
else
{
$pdf->Cell(25,5,'',1,0,'C');	
}

}else{
$pdf->SetFont('Times','B',12);
$pdf->Cell(25,5,'Peralatan 3',1,0,'C');
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Ya',1,0,'C');	
}
$pdf->Cell(35,5,$u3,1,0,'C');
$pdf->Cell(35,5,$v3,1,1,'C');

$pdf->Ln(3); 


$pdf->SetFont('Times','',12);
$pdf->Cell(7,5,'',0,0);
$pdf->Cell(20,5,'2. ',0,0);
$pdf->Cell(163,5,'Dimaklumkan juga bahawa dengan pengesahan kerja-kerja pemasangan, pengujian dan',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'pentauliahan oleh Ketua Jabatan/Bahagian seperti di bawah, tidak menghadkan pihak tuan/puan untuk',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'membuat apa-apa tuntutan kepada kami seperti mana yang ditetapkan di dalam syarat-syarat kontrak',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'sekiranya berlaku apa-apa kerosakan terhadap item tersebut.',0,1,'');
$y=$pdf->GetY();
$pdf->Ln(7); 
$pdf->SetXY(80,$y);
$pdf->SetFont('Times','UB',12);
$pdf->Cell(60,5,$nama,0,1);
$pdf->SetFont('Times','',12);



$pdf->Cell(7,5,'',0,0);

$pdf->Cell(63,5,'.......................................................',0,0,'');
$pdf->SetFont('Times','UB',12);
$pdf->Cell(60,5,$jawatannama,0,1);
$pdf->SetFont('Times','',12);
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'(Tandatangan Pegawai ICT PPD/ Pegawai ICT BTPN/ Pegawai PKG/ Juruteknik Komputer)',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'(Nama dan Cop Jabatan)',0,1,'');
$pdf->Ln(5); 
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'Tarikh: '.$tarikh,0,1,'');

$pdf->Ln(5); 
$pdf->Cell(7,5,'',0,0);


$pdf->SetFont('Times','B',12);
$pdf->Cell(188,5,'Pengesahan Ketua Jabatan/Bahagian',0,1,'');
$pdf->SetFont('Times','',12);


$pdf->Ln(3); 


$pdf->SetFont('Times','',12);
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'Dengan ini adalah disahkan bahawa item seperti yang dinyatakan seperti di para 1 di atas telah',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'dipasang, diujilari dan ditauliah pada '.$tarikh.'. Disahkan juga di sini bahawa segala perubahan',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'dan pembetulan kepada mana-mana maklumat yang tercatat sebelum ini telah diambil kira dan',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'dipersetujui oleh saya pada tarikh pengesahan ini.',0,1,'');


$pdf->Ln(10); 

$pdf->Cell(7,5,'',0,0);

$pdf->Cell(100,5,'.......................................................',0,0,'');
$pdf->Cell(40,5,'Tarikh: '.$tarikh,0,1);



$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'(Tandatangan Pengetua/Guru Besar)',0,1,'');
$pdf->Cell(7,5,'',0,0);

$pdf->Cell(188,5,'(Nama dan Cop Jabatan)',0,1,'');





$pdf->Output();
?>