<?php
include 'sess.php';
             ?><?php
session_start(); 
include 'db.php'; 
@$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; 
@$username=$_SESSION['SESS_USERNAME']; 
@$userlevel=$_SESSION['SESS_USERLEVEL']; 
@$realname=$_SESSION['SESS_REALNAME']; 
$id=$_GET['id'];



//require('../e/fpdf/fpdf.php'); 

$image="/e/fpdf/img.jpg";
$header="/e/fpdf/header.png";
$footer="/e/fpdf/footer.png";



require('PHPmailertest/mc_table.php');

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


class PDF_HTML extends FPDF
{
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
	function Header()
{
    // Logo
    $this->Image('/e/fpdf/header.png',20,5,170,18);
   //Image(''.$image,10,13,25);
    // Arial bold 15
   // $this->SetFont('Arial','I',9);
    // Page number
    //$this->Cell(30,5,'PELAPORAN PERKHIDMATAN BIMBINGAN DAN KAUNSELING',0,1,'L');
    //$this->Cell(30 ,5,'',0,0);
   // $this->Cell(30,5,'SEPANJANG TEMPOH PERINTAH KAWALAN PERGERAKAN FASA 1 (18 - 31 Mac 2020)',0,1,'L');
   // $this->Cell(30,5,'HINGGA FASA 2 ( 1 -14 April 2020) ',0,1,'L');
}
	 function Footer()
 {
    // Position at 1.5 cm from bottom
    
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','B',12);
    // Page number
    $this->Cell(180,15,'1',0,0,'R');
       $this->Image('/e/fpdf/footer.png',20,280,170,5);
 }
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm


function fokus($kod){
if($kod=='PPS4')  $ret='Pengurusan Diri';
if($kod=='PPS5')  $ret='Tingkah Laku Kurang Sopan';
if($kod=='PPS1')  $ret='Hormat Menghormati';
if($kod=='PPS3')  $ret='Kepimpinan';
if($kod=='PPS2')  $ret='Kemahiran Sosial';
if($kod=='PD3')  $ret='Vandalisme';
if($kod=='PD5')  $ret='Rokok';
if($kod=='PD6')  $ret='Tidak Penting Masa';
if($kod=='PD1')  $ret='Buli';
if($kod=='PD7')  $ret='Tingkah Laku Jenayah';
if($kod=='PD4')  $ret='Ponteng';
if($kod=='PD2')  $ret='Kenakalan';
if($kod=='PD8')  $ret='Tingkah Laku Lucah';
if($kod=='PK1')  $ret='Hala Tuju Kerjaya';
if($kod=='PK4')  $ret='Pemilihan Bidang Kerjaya';
if($kod=='PK6')  $ret='Penyebaran Maklumat Kerjaya';
if($kod=='PK5')  $ret='Pengetahuan Berkaitan Kerjaya';
if($kod=='PK3')  $ret='Inventori Personaliti';
if($kod=='PK2')  $ret='Inventori Nilai Kerjaya';
if($kod=='PK7')  $ret='Ujian Minat Kerjaya';
if($kod=='PKM5')  $ret='Masalah Keluarga';
if($kod=='PKM2')  $ret='Kemahiran Belajar';
if($kod=='PKM7')  $ret='Perkauman';
if($kod=='PKM4')  $ret='Komunikasi';
if($kod=='PKM1')  $ret='Jati Diri';
if($kod=='PKM6')  $ret='Pengurusan Emosi';
if($kod=='PKM9')  $ret='Seksual';
if($kod=='PKM8')  $ret='Keremajaan';
if($kod=='PKM3')  $ret='Kerohanian';


return $ret;
}
function perkhidmatan($kod){

if($kod=='PPS')  $ret='Pembangunan Dan Perkembangan Sahsiah Diri Murid';
if($kod=='PK')  $ret='Pendidikan Kerjaya Murid';
if($kod=='PD')  $ret='Peningkatan Disiplin Diri Murid';
if($kod=='PKM')  $ret='Psikososial dan Kesejahteraan Mental Murid';


return $ret;
}
function j_murid($conn,$kodsekolah,$kaum,$jantina,$id_rekod){

$q = mysqli_query($conn,"SELECT sum(bil) as bil FROM mgkkjoho_kaunseling.`pkp_murid` where id_rekod='$id_rekod' and kaum like '$kaum%' and jantina like '$jantina%'");
 $s=mysqli_fetch_array($q);
$count = $s['bil'];        
     
 
    

return $count;
}

function logo($conn,$kodsekolah){

$q = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`pkp_logosekolah` where kodsekolah ='$kodsekolah'  AND `logo` not LIKE '%.png' ");
$count='no-logo-png-4.png';
if(mysqli_num_rows($q)!=0)
 {$s=mysqli_fetch_array($q);
$count = $s['logo'];        
 }
 
    

return $count;
}

function isu_murid($conn,$kodsekolah,$kaum,$jantina,$kategori,$id_rekod){

$q = mysqli_query($conn,"SELECT sum(bil) as bil FROM mgkkjoho_kaunseling.`pkp_isu_murid` WHERE id_rekod='$id_rekod' AND `kategori` like '$kategori%' AND `jantina` LIKE '$jantina%' AND `kaum` LIKE '$kaum%'");

 $s=mysqli_fetch_array($q);
$count = $s['bil'];     
     

    

return $count;
}





 $qp = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`pkp_program` where id='$id'");
           $sprogram=mysqli_fetch_array($qp);
           
       
           
           
$id_rekod=$sprogram['id'];
$kodsekolah=$sprogram['kodsekolah'];

 $q = mysqli_query($conn,"select * from mgkkjoho_kaunseling.tssekolah s left join mgkkjoho_kaunseling.var_ppd p on p.kodppd=s.KodPPD where s.KodSekolah='$kodsekolah'");
           $ssekolah=mysqli_fetch_array($q); 
           
$added_by=$sprogram['added_by'];           
 $gbk = mysqli_query($conn,"select * from mgkkjoho_kaunseling.gbk g left join mgkkjoho_kaunseling.users u on u.username=g.nokp where g.nokp='$added_by'");
           $sgbk=mysqli_fetch_array($gbk);    
$realname=$sgbk['nama'];           
           
$tarikh=date("d-m-Y", strtotime($sprogram['tarikh']));
$tempat=$sprogram['tempat'];
$nama_program=$sprogram['nama_program'];
$kospcg=$sprogram['kodpcg'];
$koslain=$sprogram['kodlain'];


$pengelola=$sprogram['pengelola'];


$mediasocial=$sprogram['mediasocial'];


$terlibat=$sprogram['bilpendidik'];


$objektif=$sprogram['objektif'];


$tema=$sprogram['tema'];

$kebaikan=$sprogram['kebaikan'];

$kekangan=$sprogram['kekangan'];

$penambahbaikan=$sprogram['penambaikan'];
$pengisian=$sprogram['pengisian'];




$gambar = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`pkp_program_gambar` where id_rekod='$id_rekod'");
  WHILE($shows_gambar=mysqli_fetch_array($gambar)) {
$loc[]=$shows_gambar['gambar'];
$catatan[]=$shows_gambar['catatan'];
}

$image1="images/pkp/no-logo-png-4.png";
$image2="images/pkp/no-logo-png-4.png";
$image3="images/pkp/no-logo-png-4.png";
$image4="images/pkp/no-logo-png-4.png";


if($loc[0]!='') $image1="images/pkp/".$loc[0];

if($loc[1]!='') $image2="images/pkp/".$loc[1];

if($loc[2]!='') $image3="images/pkp/".$loc[2];

if($loc[3]!='') $image4="images/pkp/".$loc[3];

$logosekolah="images/pkp/thumbs/".logo($conn,$kodsekolah);




//create pdf object
$pdf=new PDF_MC_Table();

$pdf->SetTitle('PROGRAM PKP');
$pdf->AddPage();
$pdf->Ln(10); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(178,15,'LAMPIRAN I',0,0,'R');
$pdf->Ln(20); 


$pdf->SetFont('Times','',12);
//$pdf-> Image(''.$image,10,13,25);
$pdf-> Image(''.$logosekolah,25,40,25);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(33 ,5,'',0,0);
$pdf->Cell(150 ,5,'UNIT BIMBINGAN DAN KAUNSELING',0,1,'C');
$pdf->Cell(33 ,5,'',0,0);
$pdf->Cell(150 ,5,'NAMA SEKOLAH : '.$ssekolah['NamaSekolah'],0,1,'C');
$pdf->Cell(33 ,5,'',0,0);
$pdf->Cell(150 ,5,'PPD : '.$ssekolah['ppd'],0,1,'C');
$pdf->Cell(33 ,5,'',0,0);
$pdf->Cell(150 ,5,'JPN : JABATAN PENDIDIKAN NEGERI JOHOR',0,1,'C');

$pdf->Ln(10);

$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'LAPORAN PROGRAM',0,1);
$pdf->SetFont('Times','',10);


$pdf->SetWidths(array(40,45,30,20,15,15));
$pdf->Cell(11 ,5,'',0,0);
$pdf->Row(array('FOKUS','PROGRAM','TARIKH / TEMPAT','SASARAN','KOS','CATATAN'));

$pdf->Cell(11 ,5,'',0,0);
$pdf->Row(array(perkhidmatan($sprogram['jenis_perkhidmatan']),$nama_program,$tarikh.'/'.$tempat,j_murid($conn,$kodsekolah,'','',$id_rekod).' murid',$kospcg+$koslain,''));







$pdf->Ln(10);
$pdf->SetFont('Times','',13);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'SASARAN',0,1);
$pdf->SetFont('Times','',10);

$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(45 ,5,'BANGSA / JANTINA',1,0);


$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$pdf->Cell(17 ,5,$shows_kaum['kod'],1,0,'C'); 
}
$pdf->Cell(18 ,5,'Jumlah',1,1,'C');


$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(45 ,5,'LELAKI',1,0);


$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
      
$l=j_murid($conn,$kodsekolah,$shows_kaum['kod'],'L',$id_rekod);
$j_l+=$l;
$pdf->Cell(17 ,5,$l,1,0,'C'); 
}
$pdf->Cell(18 ,5,$j_l,1,1,'C');

$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(45 ,5,'PEREMPUAN',1,0);


$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$p=j_murid($conn,$kodsekolah,$shows_kaum['kod'],'P',$id_rekod);
$j_p+=$p; 
$pdf->Cell(17 ,5,$p,1,0,'C'); 
}
$pdf->Cell(18 ,5,$j_p,1,1,'C');


$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(45 ,5,'JUMLAH',1,0);


$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
      
$t=j_murid($conn,$kodsekolah,$shows_kaum['kod'],'',$id_rekod);
$j_t+=$t;
$pdf->Cell(17 ,5,$t,1,0,'C'); 
}
$pdf->Cell(18 ,5,$j_t,1,1,'C');


$pdf->Ln(10);
$pdf->SetFont('Times','',13);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'ISU DIKENAL PASTI',0,1);
$pdf->SetFont('Times','',10);

$pdf->Cell(6 ,5,'',0,0);

$pdf->Cell(55 ,5,'ISU',1,0);
$pdf->Cell(60 ,5,'LELAKI',1,0,'C');
$pdf->Cell(60 ,5,'PEREMPUAN',1,1,'C');

$pdf->Cell(6 ,5,'',0,0);

$pdf->Cell(55 ,5,'',1,0,'C');
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$pdf->Cell(10 ,5,$shows_kaum['kod'],1,0,'C');
}
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$pdf->Cell(10 ,5,$shows_kaum['kod'],1,0,'C');
}
$pdf->Cell(11 ,5,'',0,1);





$isu = mysqli_query($conn,"select * from mgkkjoho_kaunseling.pkp_isu");
  WHILE($shows=mysqli_fetch_array($isu)) {


$pdf->Cell(6 ,5,'',0,0);
$pdf->Cell(55 ,5,$shows['tajuk'],1,0,'L');
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
      
      
   $isu_l=isu_murid($conn,$kodsekolah,$shows_kaum['kod'],'L',$shows['id'],$id_rekod); 
   $j_isu_l+=$isu_l;
$pdf->Cell(10 ,5,$isu_l,1,0,'C');
}
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
      
   $isu_p=isu_murid($conn,$kodsekolah,$shows_kaum['kod'],'P',$shows['id'],$id_rekod); 
   $j_isu_p+=$isu_p;
   
$pdf->Cell(10 ,5,$isu_p,1,0,'C');
}
$pdf->Cell(11 ,5,'',0,1);

}

$pdf->Cell(6 ,5,'',0,0);

$pdf->Cell(55 ,5,'JUMLAH',1,0,'C');
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$pdf->Cell(10 ,5,isu_murid($conn,$kodsekolah,$shows_kaum['kod'],'L','',$id_rekod),1,0,'C');
}
$kaum = mysqli_query($conn,"SELECT * FROM mgkkjoho_kaunseling.`var_sort_kaum`");
  WHILE($shows_kaum=mysqli_fetch_array($kaum)) {
$pdf->Cell(10 ,5,isu_murid($conn,$kodsekolah,$shows_kaum['kod'],'P','',$id_rekod),1,0,'C');
}
$pdf->Cell(11 ,5,'',0,1);

$pdf->Cell(6 ,5,'',0,0);

$pdf->Cell(55 ,5,'JUMLAH BESAR',1,0,'C');

$pdf->Cell(60 ,5,$j_isu_l,1,0,'C');


$pdf->Cell(60 ,5,$j_isu_p,1,0,'C');

$pdf->Cell(11 ,5,'',0,1);







$pdf->Ln(10);
$pdf->SetFont('Times','',13);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'ANGGARAN KOS',0,1);
$pdf->SetFont('Times','',10);


$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'PERUNTUKAN PCG',1,0);
$pdf->Cell(80 ,5,$kospcg,1,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'PERUNTUKAN LAIN',1,0);
$pdf->Cell(80 ,5,$koslain,1,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'JUMLAH',1,0);
$pdf->Cell(80 ,5,$kospcg+$koslain,1,1);

$pdf->Ln(5);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'Disediakan Oleh :',0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,$realname,0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'Guru Bimbingan Kaunseling',0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,$ssekolah['NamaSekolah'],0,1);




$pdf->AddPage();

$pdf->Ln(20);

$pdf->SetFont('Times','B',13);
//$pdf-> Image(''.$image,10,13,25);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'LAPORAN PROGRAM',0,1,'C');
$pdf->Cell(11 ,5,'',0,0);


$pdf->SetFont('Times','U',13);
$pdf->MultiCell(160,5,$nama_program,0,'C');
//$pdf->Cell(168 ,5,$nama_program,0,1,'C');



$pdf->Ln(5);

$pdf->SetFont('Times','',12);

$pdf->SetWidths(array(60,100));


$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('SEKOLAH',$ssekolah['NamaSekolah']));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PROGRAM / AKTIVITI',$nama_program));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('OBJEKTIF',$objektif));


$pdf->Cell(11 ,10,'',0,0);
$pdf->Cell(60 ,10,'PENGELOLA',1,0);
$pdf->Cell(100 ,10,$pengelola,1,1);
$pdf->Cell(11 ,10,'',0,0);
$pdf->Cell(60 ,10,'TARIKH',1,0);
$pdf->Cell(100 ,10,$tarikh,1,1);

$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('TEMPAT',$tempat));


$pdf->Ln(5);








$reportSubtitle='1. Limitasi data internet murid-murid.
2. Tiada inisiatif yang dapat dilakukan bagi mengatasi masalah murid yang tidak dapat dihubungi (tiada dalam group telegram)';

$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('BILANGAN WARGA PENDIDIK TERLIBAT',$terlibat));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('BILANGAN MURID TERLIBAT',j_murid($conn,$kodsekolah,'','',$id_rekod).' orang'));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('TEMA',$tema));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PENGISIAN',$pengisian));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('KEBAIKAN',$kebaikan));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('KEKANGAN',$kekangan));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PENAMBAHBAIKAN',$penambahbaikan));



//$pdf->Output("F",'uploads/'.$kodsekolah.'-LAMPIRAN I.pdf'); 

$pdf->AddPage();

$pdf->Ln(10); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(178,15,'LAMPIRAN III',0,0,'R');
$pdf->Ln(20); 

$pdf->SetFont('Arial','B',16);
$pdf->SetFont('Times','',12);
//$pdf-> Image(''.$image,10,13,25);
//$pdf-> Image(''.$image,25,40,25);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'UNIT BIMBINGAN DAN KAUNSELING',0,1,'C');
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'NAMA SEKOLAH : '.$ssekolah['NamaSekolah'],0,1,'L');
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'PPD : '.$ssekolah['ppd'],0,1,'L');
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'JPN : JABATAN PENDIDIKAN NEGERI JOHOR',0,1,'L');

$pdf->Ln(10);

$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'LAPORAN   SEBARAN MAKLUMAT MELALUI',0,1);
$pdf->SetFont('Times','',10);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'Poster/Video/Facebook/Whatapps/Instagram/Blog/Twitter dan lain-lain',0,1);



$pdf->SetWidths(array(40,45,30,20,15,15));
$pdf->Cell(11 ,5,'',0,0);
$pdf->Row(array('FOKUS','PROGRAM','TARIKH / TEMPAT','SASARAN','KOS','CATATAN'));

$pdf->Cell(11 ,5,'',0,0);
$pdf->Row(array(perkhidmatan($sprogram['jenis_perkhidmatan']),$nama_program,$tarikh.'/'.$tempat,j_murid($conn,$kodsekolah,'','',$id_rekod).' murid',$kospcg+$koslain,''));






$pdf->Ln(10);
$pdf->SetFont('Times','',13);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'ANGGARAN KOS',0,1);
$pdf->SetFont('Times','',10);


$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'PERUNTUKAN PCG',1,0);
$pdf->Cell(80 ,5,$kospcg,1,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'PERUNTUKAN LAIN',1,0);
$pdf->Cell(80 ,5,$koslain,1,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(80 ,5,'JUMLAH',1,0);
$pdf->Cell(80 ,5,$kospcg+$koslain,1,1);

$pdf->Ln(5);


$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'Disediakan Oleh :',0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,$realname,0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'Guru Bimbingan Kaunseling',0,1);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,$ssekolah['NamaSekolah'],0,1);




$pdf->AddPage();

$pdf->Ln(20);

$pdf->SetFont('Times','B',13);
//$pdf-> Image(''.$image,10,13,25);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(168 ,5,'LAPORAN',0,1,'C');
$pdf->Cell(11 ,5,'',0,0);


$pdf->SetFont('Times','U',13);
$pdf->MultiCell(160,5,$nama_program,0,'C');
//$pdf->Cell(168 ,5,$nama_program,0,1,'C');



$pdf->Ln(5);

$pdf->SetFont('Times','',12);

$pdf->SetWidths(array(60,100));


$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('SEKOLAH',$ssekolah['NamaSekolah']));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PROGRAM / AKTIVITI',$nama_program));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('OBJEKTIF',$objektif));


$pdf->Cell(11 ,10,'',0,0);
$pdf->Cell(60 ,10,'PENGELOLA',1,0);
$pdf->Cell(100 ,10,$pengelola,1,1);
$pdf->Cell(11 ,10,'',0,0);
$pdf->Cell(60 ,10,'TARIKH',1,0);
$pdf->Cell(100 ,10,$tarikh,1,1);

$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('ALAMAT FB/INSTA/BLOG/TWITTER/ YOUTUBE/DLL',$mediasocial));


$pdf->Ln(5);








$reportSubtitle='1. Limitasi data internet murid-murid.
2. Tiada inisiatif yang dapat dilakukan bagi mengatasi masalah murid yang tidak dapat dihubungi (tiada dalam group telegram)';


$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PENGISIAN',$pengisian));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('KEBAIKAN',$kebaikan));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('KEKANGAN',$kekangan));
$pdf->Cell(11 ,10,'',0,0);
$pdf->Row(array('PENAMBAHBAIKAN',$penambahbaikan));

//$pdf->Output("F",'uploads/'.$kodsekolah.'-LAMPIRAN III.pdf'); 

$pdf->AddPage();

$pdf->Ln(15); 

$pdf->SetFont('Arial','B',16);
$pdf->SetFont('Times','',12);
//$pdf-> Image(''.$image,10,13,25);
//$pdf-> Image(''.$image,25,40,25);
//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'NAMA SEKOLAH / ORGANISASI: '.$ssekolah['NamaSekolah'],0,1,'L');
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(40 ,5,'NAMA PROGRAM : ',0,0,'L');
$pdf->MultiCell(130,5,$nama_program,0,'L');

//$pdf->Cell(170 ,5,'NAMA PROGRAM : '.$nama_program,0,1,'L');
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(170 ,5,'TARIKH : '.$tarikh,0,1,'L');

$pdf->Ln(10);


$text=str_repeat('this is a word wrt ',10);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(83 ,5,$pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 83,64),0,0);
$pdf->Cell(83 ,5,$pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 83,64),0,0);
$pdf->Cell(11 ,5,'',0,1);
$pdf->Ln(60);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Cell(11 ,5,'',0,0);
$col1=$text;
$pdf->MultiCell(83, 5, $catatan[0], 0,'C');

$pdf->SetXY($x + 94, $y);

$col2=$text;
$pdf->MultiCell(83, 5, $catatan[1], 0,'C');






$pdf->Ln(20);
$pdf->Cell(11 ,5,'',0,0);
$pdf->Cell(83 ,5,$pdf->Image($image3, $pdf->GetX(), $pdf->GetY(), 80,64),0,0);
$pdf->Cell(83 ,5,$pdf->Image($image4, $pdf->GetX(), $pdf->GetY(), 80,64),0,0);
//$pdf->MultiCell(83,5,$pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 83),1,'L');
$pdf->Cell(11 ,5,'',0,1);



$pdf->Ln(60);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Cell(11 ,5,'',0,0);
$col1=$text;
$pdf->MultiCell(83, 5, $catatan[2], 0,'C');

$pdf->SetXY($x + 94, $y);

$col2=$text;
$pdf->MultiCell(83, 5, $catatan[3], 0,'C');






$pdf->Output();


?>