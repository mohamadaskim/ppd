<?php
include 'sess.php';
             ?><!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    if(isset($_SESSION['YEAR']) && $_SESSION['YEAR']!=date('Y')){

?>
<script>
    alert("anda berada di dalam arkib <?php echo $_SESSION['YEAR']; ?>, sila kembali kepada 2021 untuk rekod aktiviti")
    window.location.href = 'index.php';
</script>
<?php

}
    
    ?> 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>eRekod - Bimbingan Dan Kaunseling</title>

  <!-- Favicons -->

<?php include('include/header.php'); ?>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->

  <script>

function showUserx(id,dddd) {
var a=showUserr(id);
document.getElementById(dddd).innerHTML =id+" - "+a;
}
function showUserr(id) {
   //line added for the var that will have the result

    var result = false;
    $.ajax({
        type: "GET",
        url: 'test/get_murid2.php',
        data: ({ term : id}),
        dataType: "html",
        //line added to get ajax response in sync
        async: false,
        success: function(data) {
            //line added to save ajax response in var result
            result = data;
        },
        error: function() {
            alert('Error occured');
        }
    });
    //line added to return ajax response
    return result.trim();

}
</script>
</head>
<?php 




function kategori($id){

$output ='';
  $output .=  '<option ';
  if($id=='i') $output .= ' selected="selected" ';
  $output .=  'value="i">Individu</option>';
  $output .=  '<option ';
  if($id=='k') $output .= ' selected="selected" ';
  $output .=  'value="k">Kelompok</option>';
  $output .=  '<option ';
  if($id=='p') $output .= ' selected="selected" ';
  $output .=  'value="p">Program</option>';
  $output .=  '<option ';
  if($id=='g') $output .= ' selected="selected" ';
  $output .=  'value="g">Kelas Ganti</option>';
  $output .=  '<option ';
  if($id=='kon') $output .= ' selected="selected" ';
  $output .=  'value="kon">Konsultasi</option>';
  $output .=  '<option ';
  if($id=='cakna') $output .= ' selected="selected" ';
  $output .=  'value="cakna">Ziarah Cakna</option>';
    return $output;
}
function jenis($connect,$id,$kat){

if($kat=='i') $a='individu';
if($kat=='k') $a='kelompok';
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT jenis as nama, jenis as kod FROM `var_jenissesi` where individu_kelompok='$a'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;

}

function sasaran($kat,$id){




  $output='';
  $output.='<option value="">Sila Pilih</option>';

if($kat=='g'){
  $output.='<option value="biasa"';
      if($id=='biasa') $output.=' selected="selected"  ';
  $output.='>Biasa</option>';
  $output.='<option value="rujukan"';
      if($id=='rujukan') $output.=' selected="selected"  ';
  $output.='>Rujukan</option>';
}

if($kat=='i'){

  $output.='<option value="Murid Dirujuk"';
    if($id=='Murid Dirujuk') $output.=' selected="selected"  ';
  $output.='>Murid dirujuk</option>';

  $output.='<option value="Murid Dipanggil"';
    if($id=='Murid Dipanggil') $output.=' selected="selected"  ';
  $output.='>Murid dipanggil</option>';

  $output.='<option value="Sukarela"';
    if($id=='Sukarela') $output.=' selected="selected"  ';
  $output.='>Sukarela</option>';
  
  
    $output.='<option value="ssdm"';
    if($id=='ssdm') $output.=' selected="selected"  ';
  $output.='>Rujukan SSDM</option>';
}


  return $output;



}


function pendekatan($id){


  $output='';
  
  $output.='<option value="">Sila Pilih</option>';
  
    $output.='<option value="pencegahan"';
  if($id=='pencegahan') $output.=' selected="selected"  ';
  $output.='>Pencegahan</option>';
  
  
  $output.='<option value="perkembangan"';
  if($id=='perkembangan') $output.=' selected="selected"  ';
  $output.='>Perkembangan</option>';
  
  
  
  
  $output.='<option value="pemulihan"';
  if($id=='pemulihan') $output.=' selected="selected"  ';
  $output.='>Pemulihan</option>';

  
  $output.='<option value="krisis"';
  if($id=='krisis') $output.=' selected="selected"  ';
  $output.='>Krisis</option>';







  return $output;
}
function klien($id){

  $output='';
  $output.='<option value="">Sila Pilih</option>';
  $output.='<option value="pelajar"';
    if($id=='pelajar') $output.=' selected="selected"  ';
  $output.='>Murid</option>';
  $output.='<option value="penjaga"';
    if($id=='penjaga') $output.=' selected="selected"  ';
  $output.='>Ibu Bapa/Penjaga</option>';
  $output.='<option value="guru"';
    if($id=='guru') $output.=' selected="selected"  ';
  $output.='>Guru</option>';
  $output.='<option value="alumni"';
    if($id=='alumni') $output.=' selected="selected"  ';
  $output.='>Alumni</option>';
  $output.='<option value="agensiluar"';
    if($id=='agensiluar') $output.=' selected="selected"  ';
  $output.='>Agensi Luar</option>';




  return $output;




}

function program($id){



                  $output.='<option value="mentor"';
    if($id=='mentor') $output.=' selected="selected"  ';                  
                  $output.='>Mentor Mentee</option>';
                  $output.='<option value="prs"';
    if($id=='prs') $output.=' selected="selected"  ';
                  $output.='>Pembimbing Rakan Sebaya</option>';
                  
                    $output.='<option value="dwen"';
    if($id=='dwen') $output.=' selected="selected"  ';
                  $output.='>Dasar Warga Emas Negara</option>';                
       
                      $output.='<option value="agp"';
    if($id=='agp') $output.=' selected="selected"  ';
                  $output.='>Amalan Guru Penyayang</option>';   
                  
                  
                 // $output.='<option value="kunjungbantu"';
   // if($id=='kunjungbantu') $output.=' selected="selected"  ';
    //              $output.='>Ziarah Cakna</option>';
                  $output.='<option value="lain"';
    if($id=='lain') $output.=' selected="selected"  ';
                  $output.='>Lain Lain</option>';

  return $output;


}                 

function ganti($id){



                   $output.='<option value="aktiviti_bk"';
    if($id=='aktiviti_bk') $output.=' selected="selected"  ';
                   $output.='>Menjalankan Aktiviti Bimbingan dan Kaunseling</option>';
                   $output.='<option value="aktiviti_lain"';
    if($id=='aktiviti_lain') $output.=' selected="selected"  ';
                   $output.='>Menjalankan Aktiviti Selain Bimbingan dan Kaunseling</option>';
                   $output.='<option value="bahan"';
    if($id=='bahan') $output.=' selected="selected"  ';                   
                   $output.='>Menggunakan Bahan Guru Yang Diganti</option>';
                   $output.='<option value="periksa"';
    if($id=='periksa') $output.=' selected="selected"  ';                   
                   $output.='>Menjaga Kelas Peperiksaan</option>';


  return $output;




} 

 function waktu($id){
$dat ='';
             for($a=1;$a<=10;$a++) {
                    $dat .= "<option value=\"$a\"";
                    if($id==$a) $dat.=' selected="selected"  ';
                    $dat .= ">$a</option>";

             }
  return $dat;
}


function intervensi($connect,$pendekatan,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT *,intervensi as nama,ID as kod FROM mgkkjoho_var.`var_pendekatan` where pendekatan like '%$pendekatan%' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}



function tingkatan($connect,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT nama_tingkatan as nama, nama_tingkatan as kod FROM `tingkatan` where kodsekolah='$_SESSION[SESS_KODSEKOLAH]'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}
function kelas($connect,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT kelas as nama, kelas as kod FROM `kelas` where kodsekolah='$_SESSION[SESS_KODSEKOLAH]'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}
function perkhidmatan($connect,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT perkhidmatan as nama, singkatan as kod FROM `var_perkhidmatan`";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}
function fokus($connect,$k,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT *,fokus as nama, singkatan as kod FROM mgkkjoho_var.`var_fokus` where perkhidmatan='$k'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}


function pd($connect,$k,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT nama as nama, kod as kod FROM mgkkjoho_var.`var_PD` where fokus='$k'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}


function kategoriziarah($connect,$id){
 $output = '<option value="">Sila Pilih</option>';
 $query = "SELECT nama as nama, code as kod FROM `var_ziarah`";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kod"].'" ';
if($id==$row["kod"])  $output .= ' selected="selected" ';
   $output .= '">'.$row["nama"].'</option>';

 }
 return $output;
}


function impakziarah($id){



                   $output.='<option value="tidakterlibat"';
    if($id=='tidakterlibat') $output.=' selected="selected"  ';
                   $output.='>Tidak Terlibat</option>';
                   $output.='<option value="berisiko"';
    if($id=='berisiko') $output.=' selected="selected"  ';
                   $output.='>Berisiko Cicir</option>';
                   $output.='<option value="cicir"';
    if($id=='cicir') $output.=' selected="selected"  ';                   
                   $output.='>Cicir</option>';


  return $output;




} 

?>
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <?php include('include/notify.php') ?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
       <?php include('include/menu.php') ?>
    </aside>
<?php

if(isset($_POST['id'])){
$id=$_POST['id'];

$kategori=$_POST['kategori'];
$j_sesi=$_POST['j_sesi'];

$pendekatan=$_POST['pendekatan'];
$j_perkhidmatan=$_POST['j_perkhidmatan'];
$j_fokus=$_POST['j_fokus'];
$tarikh=date("Y-m-d", strtotime($_POST['tarikh']));
//$waktu_mula=date("h:i A", strtotime($_POST['waktu_mula']));
//$waktu_tamat=date("h:i A", strtotime($_POST['waktu_tamat']));

//$waktu_mula=date("h:i A", strtotime($_POST['waktu_mula']));
//$waktu_tamat=date("h:i A", strtotime($_POST['waktu_tamat']));

//$waktu_mula2=strtotime($_POST['waktu_mula']);
//$waktu_tamat2=strtotime($_POST['waktu_tamat']);

$waktu_mula=$_POST['waktu_mula'];
$waktu_tamat=$_POST['waktu_tamat'];
$txt=$_POST['txt'];
$perkara=mysqli_real_escape_string($conn,$_POST['perkara']);
$persoalan=mysqli_real_escape_string($conn,$_POST['persoalan']);
$tindakan=mysqli_real_escape_string($conn,$_POST['tindakan']);

$tindakanintervensi=mysqli_real_escape_string($conn,$_POST['tindakanintervensi']);
$rumusanintervensi=mysqli_real_escape_string($conn,$_POST['rumusanintervensi']);

$pd_1=$_POST['pd_1'];
$pd_2=$_POST['pd_2'];

$berfokus='';
if(isset($_POST['berfokus'])){
  $berfokus=1;
}
$b_cicir='';
if(isset($_POST['b_cicir'])){
  $b_cicir=1;
}


if($kategori=='i'){
$sasaran=$_POST['sasaran'];




$query="UPDATE `data_individu` SET `sasaran`='$sasaran',`jenis`='$j_sesi',`jenis_perkhidmatan`='$j_perkhidmatan',`fokus`='$j_fokus',`pendekatan`='$pendekatan',`tarikh`='$tarikh',`perkara`='$perkara',`persoalan`='$persoalan',`tindakan`='$tindakan',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2' WHERE id='$id' and username='$username'";




}

if($kategori=='k'){

$query="UPDATE `data_individu` SET `jenis`='$j_sesi',`jenis_perkhidmatan`='$j_perkhidmatan',`fokus`='$j_fokus',`pendekatan`='$pendekatan',`tarikh`='$tarikh',`perkara`='$perkara',`persoalan`='$persoalan',`tindakan`='$tindakan',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2' WHERE id='$id' and username='$username'";


}


if($kategori=='p'){

$programlain=$_POST['programlain'];
$j_program=$_POST['j_program'];
$tajuk_program=mysqli_real_escape_string($conn,$_POST['tajuk_program']);

$rumusanprogram	=mysqli_real_escape_string($conn,$_POST['rumusanprogram']);
$objektif=mysqli_real_escape_string($conn,$_POST['objektif']);
$programsasaran=mysqli_real_escape_string($conn,$_POST['programsasaran']);
$kelebihan=mysqli_real_escape_string($conn,$_POST['kelebihan']);
$kelemahan=mysqli_real_escape_string($conn,$_POST['kelemahan']);
$penambaikkan=mysqli_real_escape_string($conn,$_POST['penambaikkan']);


$query="UPDATE `data_program` SET `jenis_perkhidmatan`='$j_perkhidmatan',`fokus`='$j_fokus',`pendekatan`='$pendekatan',`tajuk`='$tajuk_program',`jenis_program`='$j_program',`program_lain`='$programlain',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2',rumusanprogram='$rumusanprogram',objektif='$objektif',programsasaran='$programsasaran',kelebihan='$kelebihan',kelemahan='$kelemahan',penambaikkan='$penambaikkan' WHERE id='$id' and username='$username'";


}


if($kategori=='g'){
$sasaran=$_POST['sasaran'];
$kelas_ganti=$_POST['kelas_ganti'];
$tingkatan=$_POST['tingkatan'];
$kelas=$_POST['kelas'];
$bil_waktu=$_POST['bil_waktu'];



$query="UPDATE `data_kelasganti` SET `sasaran`='$sasaran',`klasifikasi`='$kelas_ganti',`tingkatan`='$tingkatan',`kelas`='$kelas',`jenis_perkhidmatan`='$j_perkhidmatan',`fokus`='$j_fokus',`bil_waktu`='$bil_waktu',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2' WHERE id='$id' and username='$username'";


}

if($kategori=='kon'){
$kategori_klien=$_POST['kategori_klien'];
$nama_klien=mysqli_real_escape_string($conn,$_POST['nama_klien']);

if($kategori_klien=='guru') $column='namaguru';
if($kategori_klien=='penjaga') $column='namapenjaga';
if($kategori_klien=='alumni') $column='namaalumni';
if($kategori_klien=='agensiluar') $column='namaagensi';
if($kategori_klien=='pelajar') {
  $column='nokp_pelajar';
$nama_klien=$_POST["s_klien"][0];
}



$query="UPDATE `data_konsultasi` SET `kategori`='$kategori_klien',$column='$nama_klien',`nama_konsultasi`='$nama_klien',`jenis_perkhidmatan`='$j_perkhidmatan',`fokus`='$j_fokus',`pendekatan`='$pendekatan',`perkara`='$perkara',`persoalan`='$persoalan',`tindakan`='$tindakan',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2' WHERE id='$id' and username='$username'";


}



if($kategori=='cakna'){

$nama_klien=mysqli_real_escape_string($conn,$_POST['nama_klien']);

$impakziarah=$_POST['impakziarah'];
$kategoriziarah=$_POST['kategoriziarah'];



$query="UPDATE `data_ziarah` SET `kategori`='$kategoriziarah',penjaga='$nama_klien',`impak`='$impakziarah',`added_by`='$username',`perkara`='$perkara',`persoalan`='$persoalan',`tindakan`='$tindakan',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',
`m`='$_POST[m]', `c`='$_POST[c]', `i`='$_POST[i]', `sb`='$_POST[sb]', `sw`='$_POST[sw]', `ll`='$_POST[ll]',`pm`='$_POST[pm]', `pc`='$_POST[pc]', `pi`='$_POST[pi]', `psb`='$_POST[psb]', `psw`='$_POST[psw]', `pll`='$_POST[pll]' ,`tindakanintervensi`='$tindakanintervensi',`rumusanintervensi`='$rumusanintervensi',pd_1='$pd_1',pd_2='$pd_2' WHERE id='$id' and added_by='$username'";


}


mysqli_query($conn,$query);
$id_rekod = mysqli_insert_id($conn);

if($kategori=='i') {
  $jenis_data='individu';

mysqli_query($conn,"DELETE FROM `data_individu_murid` WHERE id_rekod='$id'");
mysqli_query($conn,"DELETE FROM `data_mpd` WHERE id_rekod='$id'");


$insert="INSERT INTO `data_individu_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES ";
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];
                mysqli_query($conn,"INSERT INTO data_individu_murid (id_rekod,nokp, kodsekolah, jenis, jenis_perkhidmatan, fokus, individu_kelompok,tarikh, waktu_mula, waktu_tamat,pd_1,pd_2,pendekatan)
                   VALUES ('$id','$nokpp', '$kodsekolah', '$j_sesi', '$j_perkhidmatan', '$j_fokus', 'individu' , '$tarikh', '$waktu_mula', '$waktu_tamat','$pd_1','$pd_2','$pendekatan')");
                   
 $insert.="('$id','$nokpp', '$kodsekolah') ,";     
     
     
                     if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }   
                                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                                        mysqli_query($conn,"insert into `murid_cicir` (NOKP,KODSEKOLAH,STATUSCICIR,`NAMA`,`ALAMATMURID`) SELECT m.nokp,m.kodsekolah,'BERISIKO CICIR',m.nama,m.alamat FROM murid m where m.nokp='$nokpp' ON DUPLICATE KEY UPDATE `NAMA` = values(NAMA),`KODSEKOLAH` = values(KODSEKOLAH)");

                                                                
                                                            }
                   
}
$insert=rtrim($insert,",");
mysqli_query($conn,$insert);

if($j_sesi!="Bimbingan Kelompok" && $j_sesi!="Bimbingan Individu"){
  for($count = 0; $count < count($_POST["s_klien"]); $count++)
 {  
$nokpp=$_POST["s_klien"][$count];
            mysqli_query($conn,"INSERT INTO data_mpd (nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,sasaran,added_by,status,individu_kelompok,id_rekod)
               VALUES ('$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$sasaran','$username','aktif','individu','$id')");



 mysqli_query($conn,"INSERT INTO data_mpd_unik (nokp,nama,kodsekolah,status,added_by)
                     VALUES ('$nokpp','$nama','$kodsekolah','aktif','$username') ON DUPLICATE KEY UPDATE `kodsekolah`=values(kodsekolah),status = 'aktif'");



 }   
}

 
 
}
if($kategori=='k') {
  $jenis_data='kelompok';
mysqli_query($conn,"DELETE FROM `data_individu_murid` WHERE id_rekod='$id'");
mysqli_query($conn,"DELETE FROM `data_mpd` WHERE id_rekod='$id'");
$insert="INSERT INTO `data_individu_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES ";
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];
                mysqli_query($conn,"INSERT INTO data_individu_murid (id_rekod,nokp, kodsekolah, jenis, jenis_perkhidmatan, fokus, individu_kelompok,tarikh, waktu_mula, waktu_tamat,pd_1,pd_2,pendekatan)
                   VALUES ('$id','$nokpp', '$kodsekolah', '$j_sesi', '$j_perkhidmatan', '$j_fokus', 'kelompok' , '$tarikh', '$waktu_mula', '$waktu_tamat','$pd_1','$pd_2','$pendekatan')");
                   
                   
                  $insert.="('$id','$nokpp', '$kodsekolah') ,";  
                  
                  
                                       if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }  
                                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    mysqli_query($conn,"insert into `murid_cicir` (NOKP,KODSEKOLAH,STATUSCICIR,`NAMA`,`ALAMATMURID`) SELECT m.nokp,m.kodsekolah,'BERISIKO CICIR',m.nama,m.alamat FROM murid m where m.nokp='$nokpp' ON DUPLICATE KEY UPDATE `NAMA` = values(NAMA),`KODSEKOLAH` = values(KODSEKOLAH)");

                                                                
                                                                
                                                            }
}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);


if($j_sesi!="Bimbingan Kelompok" && $j_sesi!="Bimbingan Individu"){
 for($count = 0; $count < count($_POST["s_klien"]); $count++)
 {  
$nokpp=$_POST["s_klien"][$count];
            mysqli_query($conn,"INSERT INTO data_mpd (nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,sasaran,added_by,status,individu_kelompok,id_rekod)
               VALUES ('$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$sasaran','$username','aktif','kelompok','$id')");



 mysqli_query($conn,"INSERT INTO data_mpd_unik (nokp,nama,kodsekolah,status,added_by)
                     VALUES ('$nokpp','$nama','$kodsekolah','aktif','$username') ON DUPLICATE KEY UPDATE `kodsekolah`=values(kodsekolah),status = 'aktif'");


 }
}
}
if($kategori=='p') {
  $jenis_data='program';
  mysqli_query($conn,"DELETE FROM `data_program_murid` WHERE id_rekod='$id'");


$insert="INSERT INTO `data_program_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES ";
    for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];

                        mysqli_query($conn,"INSERT INTO data_program_murid (id_rekod,nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,tarikh,waktu_mula,waktu_tamat)
                    VALUES ('$id','$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$tarikh','$waktu_mula','$waktu_tamat')");
                    
                    $insert.="('$id','$nokpp', '$kodsekolah') ,";  
                    
                    
                                         if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);

mysqli_query($conn,"insert into murid (nokp,nama,kodsekolah) select d.nokp,c.NAMA,d.kodsekolah from data_program_murid d left join murid m on m.nokp=d.nokp left join murid_cicir c on c.NOKP=d.nokp where id_rekod='$id' and m.id is null and d.kodsekolah='$kodsekolah'");



}
if($kategori=='g') {
  $jenis_data='kelas_ganti';
  $perkara=$tingkatan . '-' . $kelas;
  
  mysqli_query($conn,"delete from `data_kelasganti_murid` where id_rekod='$id' and kodsekolah='$kodsekolah'");

 $insert="INSERT INTO `data_kelasganti_murid`( `nokp`, `id_rekod`, `kodsekolah`) VALUES "; 
    for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];


            $insert.="('$nokpp','$id', '$kodsekolah') ,";  
            

}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);


 //   mysqli_query($conn,"INSERT INTO `data_kelasganti_murid`( `nokp`, `id_rekod`, `kodsekolah`) select nokp,'$id','$kodsekolah' from murid where tingkatan='$tingkatan' and nama_kelas='$kelas' and kodsekolah='$kodsekolah'");

}
if($kategori=='kon') {
  $jenis_data='konsultasi';

    mysqli_query($conn,"DELETE FROM `data_konsultasi_murid` WHERE `data_id`='$id'");
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];

                          mysqli_query($conn,"INSERT INTO data_konsultasi_murid (nokp_pelajar,data_id,kodsekolah)
               VALUES ('$nokpp','$id', '$kodsekolah')");
               
                                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }  
                                                       if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
          }

}

if($kategori=='cakna') {
  $jenis_data='cakna';

    mysqli_query($conn,"DELETE FROM `data_ziara_murid` WHERE `data_id`='$id'");
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];

      mysqli_query($conn,"INSERT INTO `data_ziara_murid` ( `nokp_pelajar`, `data_id`,kodsekolah) VALUES ( '$nokpp', '$id', '$kodsekolah')");
      
                           if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }  
                                              if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
          }

}


if($tajuk_program!=''){
  $perkara=$tajuk_program;
}

   mysqli_query($conn,"UPDATE `data_aktiviti` SET `perkara`='$perkara',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat' WHERE data_id='$id' and username='$username' and `jenis_data`='$jenis_data'");  


    mysqli_query($conn,"UPDATE `data_log` SET `perkara`='$perkara',`tarikh`='$tarikh',`waktu_mula`='$waktu_mula',`waktu_tamat`='$waktu_tamat',`kategori`='$jenis_data' WHERE data_id='$id' and username='$username' and `kategori`='$jenis_data'");  





    ?>
<script>
 alert("Kemaskini Berjaya");
   //alert("Login first");
window.location.href = '" . base_url() . "';
  window.location.href='senarai_aktiviti.php';
  </script>
<?php
}



if(isset($_POST['data']) && $_POST['data']=='simpan'){


$kategori=$_POST['kategori'];
$j_sesi=$_POST['j_sesi'];

$pendekatan=$_POST['pendekatan'];
$j_perkhidmatan=$_POST['j_perkhidmatan'];
$j_fokus=$_POST['j_fokus'];
$tarikh=date("Y-m-d", strtotime($_POST['tarikh']));
//$waktu_mula=date("h:i A", strtotime($_POST['waktu_mula']));
//$waktu_tamat=date("h:i A", strtotime($_POST['waktu_tamat']));

//$waktu_mula=date("h:i A", strtotime($_POST['waktu_mula']));
//$waktu_tamat=date("h:i A", strtotime($_POST['waktu_tamat']));

//$waktu_mula2=strtotime($_POST['waktu_mula']);
//$waktu_tamat2=strtotime($_POST['waktu_tamat']);

$waktu_mula=$_POST['waktu_mula'];
$waktu_tamat=$_POST['waktu_tamat'];
$txt=$_POST['txt'];
$perkara=mysqli_real_escape_string($conn,$_POST['perkara']);
$persoalan=mysqli_real_escape_string($conn,$_POST['persoalan']);
$tindakan=mysqli_real_escape_string($conn,$_POST['tindakan']);

$pd_1=$_POST['pd_1'];
$pd_2=$_POST['pd_2'];

$tindakanintervensi=mysqli_real_escape_string($conn,$_POST['tindakanintervensi']);
$rumusanintervensi=mysqli_real_escape_string($conn,$_POST['rumusanintervensi']);
$berfokus='';
if(isset($_POST['berfokus'])){
  $berfokus=1;
}
$b_cicir='';
if(isset($_POST['b_cicir'])){
  $b_cicir=1;
}

if($kategori=='i'){
$sasaran=$_POST['sasaran'];
$query="INSERT INTO data_individu (username,kodsekolah,waktu_mula,waktu_tamat,tarikh,perkara,persoalan,tindakan,jenis,jenis_perkhidmatan,fokus,individu_kelompok,pendekatan,sasaran,tindakanintervensi,rumusanintervensi,pd_1,pd_2)
  VALUES ('$username','$kodsekolah','$waktu_mula','$waktu_tamat','$tarikh','$perkara','$persoalan','$tindakan','$j_sesi','$j_perkhidmatan','$j_fokus', 'individu', '$pendekatan','$sasaran','$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2')";




}

if($kategori=='k'){

$query="INSERT INTO data_individu (username,kodsekolah,waktu_mula,waktu_tamat,tarikh,perkara,persoalan,tindakan,jenis,jenis_perkhidmatan,fokus,individu_kelompok,pendekatan,tindakanintervensi,rumusanintervensi,pd_1,pd_2)
  VALUES ('$username','$kodsekolah','$waktu_mula','$waktu_tamat','$tarikh','$perkara','$persoalan','$tindakan','$j_sesi','$j_perkhidmatan','$j_fokus', 'kelompok', '$pendekatan','$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2')";


}


if($kategori=='p'){

$programlain=$_POST['programlain'];
$j_program=$_POST['j_program'];
$tajuk_program=mysqli_real_escape_string($conn,$_POST['tajuk_program']);


$rumusanprogram	=mysqli_real_escape_string($conn,$_POST['rumusanprogram']);
$objektif=mysqli_real_escape_string($conn,$_POST['objektif']);
$programsasaran=mysqli_real_escape_string($conn,$_POST['programsasaran']);
$kelebihan=mysqli_real_escape_string($conn,$_POST['kelebihan']);
$kelemahan=mysqli_real_escape_string($conn,$_POST['kelemahan']);
$penambaikkan=mysqli_real_escape_string($conn,$_POST['penambaikkan']);



$query="INSERT INTO data_program (username,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,tarikh,waktu_mula,waktu_tamat,tajuk,jenis_program,program_lain,tindakanintervensi,rumusanintervensi,pd_1,pd_2,`rumusanprogram`, `objektif`, `programsasaran`, `kelebihan`, `kelemahan`, `penambaikkan`)
                 VALUES ('$username','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$tarikh','$waktu_mula','$waktu_tamat','$tajuk_program','$j_program','$programlain','$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2','$rumusanprogram', '$objektif', '$programsasaran', '$kelebihan', '$kelemahan', '$penambaikkan')";


}


if($kategori=='g'){
$sasaran=$_POST['sasaran'];
$kelas_ganti=$_POST['kelas_ganti'];
$tingkatan=$_POST['tingkatan'];
$kelas=$_POST['kelas'];
$bil_waktu=$_POST['bil_waktu'];



$query="INSERT INTO data_kelasganti (username,kodsekolah,sasaran,klasifikasi,tingkatan,kelas,jenis_perkhidmatan,fokus,bil_waktu,waktu_mula,waktu_tamat,tarikh,tindakanintervensi,rumusanintervensi,pd_1,pd_2)
                VALUES ('$username','$kodsekolah','$sasaran','$kelas_ganti','$tingkatan','$kelas','$j_perkhidmatan','$j_fokus','$bil_waktu','$waktu_mula','$waktu_tamat','$tarikh','$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2')";


}

if($kategori=='kon'){
$kategori_klien=$_POST['kategori_klien'];
$nama_klien=mysqli_real_escape_string($conn,$_POST['nama_klien']);

if($kategori_klien=='guru') $column='namaguru';
if($kategori_klien=='penjaga') $column='namapenjaga';
if($kategori_klien=='alumni') $column='namaalumni';
if($kategori_klien=='agensiluar') $column='namaagensi';
if($kategori_klien=='pelajar') {
  $column='nokp_pelajar';
$nama_klien=$_POST["s_klien"][0];
}

$query="INSERT INTO data_konsultasi (username,kodsekolah,perkara,persoalan,tindakan,kategori,jenis_perkhidmatan,fokus,fokus_lain,pendekatan,tarikh,waktu_mula,waktu_tamat,$column,nama_konsultasi,tindakanintervensi,rumusanintervensi,pd_1,pd_2)
               VALUES ('$username','$kodsekolah','$perkara','$persoalan','$tindakan','$kategori_klien','$j_perkhidmatan','$j_fokus','$fokus_lain','$pendekatan','$tarikh','$waktu_mula','$waktu_tamat','$nama_klien','$nama_klien','$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2')";


}



if($kategori=='cakna'){

$nama_klien=mysqli_real_escape_string($conn,$_POST['nama_klien']);

$impakziarah=$_POST['impakziarah'];
$kategoriziarah=$_POST['kategoriziarah'];


$query="INSERT INTO `data_ziarah`(`tarikh`, `kodsekolah`, `kategori`, `impak`, `guru`,  `waktu_mula`, `waktu_tamat`, `added_by`, `perkara`, `persoalan`, `tindakan`,`penjaga`, `m`, `c`, `i`, `sb`, `sw`, `ll`,`pm`, `pc`, `pi`, `psb`, `psw`, `pll`,tindakanintervensi,rumusanintervensi,pd_1,pd_2)
               VALUES ('$tarikh','$kodsekolah','$kategoriziarah','$impakziarah','$guru','$waktu_mula','$waktu_tamat','$username','$perkara','$persoalan','$tindakan','$nama_klien', $_POST[m], $_POST[c], $_POST[i], $_POST[sb], $_POST[sw], $_POST[ll], $_POST[pm], $_POST[pc], $_POST[pi], $_POST[psb], $_POST[psw], $_POST[pll],'$tindakanintervensi','$rumusanintervensi','$pd_1','$pd_2')";


}


mysqli_query($conn,$query);
$id_rekod = mysqli_insert_id($conn);

if($kategori=='i') {
  $jenis_data='individu';
  
 $insert="INSERT INTO `data_individu_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES "; 
 
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];
                mysqli_query($conn,"INSERT INTO data_individu_murid (id_rekod,nokp, kodsekolah, jenis, jenis_perkhidmatan, fokus, individu_kelompok,tarikh, waktu_mula, waktu_tamat,status,berfokus,sasaran,pd_1,pd_2,pendekatan,b_cicir)
                   VALUES ('$id_rekod','$nokpp', '$kodsekolah', '$j_sesi', '$j_perkhidmatan', '$j_fokus', 'individu' , '$tarikh', '$waktu_mula', '$waktu_tamat','aktif','$berfokus','$sasaran','$pd_1','$pd_2','$pendekatan','$b_cicir')");
                   
                   
                    $insert.="('$id_rekod','$nokpp', '$kodsekolah') ,";  
                    
                    
                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                        if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                                                            mysqli_query($conn,"insert into `murid_cicir` (NOKP,KODSEKOLAH,STATUSCICIR,`NAMA`,`ALAMATMURID`) SELECT m.nokp,m.kodsekolah,'BERISIKO CICIR',m.nama,m.alamat FROM murid m where m.nokp='$nokpp' ON DUPLICATE KEY UPDATE `NAMA` = values(NAMA),`KODSEKOLAH` = values(KODSEKOLAH)");

                                            
                                        }
                    
}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);
if($j_sesi!="Bimbingan Kelompok" && $j_sesi!="Bimbingan Individu"){
 for($count = 0; $count < count($_POST["s_klien"]); $count++)
 {  
$nokpp=$_POST["s_klien"][$count];
            mysqli_query($conn,"INSERT INTO data_mpd (nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,sasaran,added_by,status,individu_kelompok,berfokus,id_rekod,cicir)
               VALUES ('$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$sasaran','$username','aktif','individu','$berfokus','$id_rekod','$b_cicir')");



 
 $queryc = "SELECT * FROM data_mpd_unik WHERE nokp='$nokpp' and added_by='$username'";
               $resultc = mysqli_query($conn,$queryc);
               $adeke = mysqli_num_rows($resultc);
                 if($adeke==0) {
                   mysqli_query($conn,"INSERT INTO data_mpd_unik (nokp,nama,kodsekolah,status,added_by)
                     VALUES ('$nokpp','$nama','$kodsekolah','aktif','$username') ");
                 } else {
                   mysqli_query($conn,"UPDATE data_mpd_unik SET status='aktif' WHERE nokp='$nokpp'");
                 }


 }
 
}
}
if($kategori=='k') {
  $jenis_data='kelompok';
 $insert="INSERT INTO `data_individu_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES "; 
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];
                mysqli_query($conn,"INSERT INTO data_individu_murid (id_rekod,nokp, kodsekolah, jenis, jenis_perkhidmatan, fokus, individu_kelompok,tarikh, waktu_mula, waktu_tamat,status,berfokus,sasaran,pd_1,pd_2,pendekatan,b_cicir)
                   VALUES ('$id_rekod','$nokpp', '$kodsekolah', '$j_sesi', '$j_perkhidmatan', '$j_fokus', 'kelompok' , '$tarikh', '$waktu_mula', '$waktu_tamat','aktif','$berfokus','$sasaran','$pd_1','$pd_2','$pendekatan','$b_cicir')");
                   
                   
    $insert.="('$id_rekod','$nokpp', '$kodsekolah') ,";  
    
                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                                                          mysqli_query($conn,"insert into `murid_cicir` (NOKP,KODSEKOLAH,STATUSCICIR,`NAMA`,`ALAMATMURID`) SELECT m.nokp,m.kodsekolah,'BERISIKO CICIR',m.nama,m.alamat FROM murid m where m.nokp='$nokpp' ON DUPLICATE KEY UPDATE `NAMA` = values(NAMA),`KODSEKOLAH` = values(KODSEKOLAH)");

                    }
}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);
if($j_sesi!="Bimbingan Kelompok" && $j_sesi!="Bimbingan Individu"){
 for($count = 0; $count < count($_POST["s_klien"]); $count++)
 {  
$nokpp=$_POST["s_klien"][$count];
            mysqli_query($conn,"INSERT INTO data_mpd (nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,sasaran,added_by,status,individu_kelompok,berfokus,id_rekod,cicir)
               VALUES ('$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$sasaran','$username','aktif','kelompok','$berfokus','$id_rekod','$b_cicir')");



 
 $queryc = "SELECT * FROM data_mpd_unik WHERE nokp='$nokpp'  and added_by='$username'";
               $resultc = mysqli_query($conn,$queryc);
               $adeke = mysqli_num_rows($resultc);
                 if($adeke==0) {
                   mysqli_query($conn,"INSERT INTO data_mpd_unik (nokp,nama,kodsekolah,status,added_by)
                     VALUES ('$nokpp','$nama','$kodsekolah','aktif','$username')");
                 } else {
                   mysqli_query($conn,"UPDATE data_mpd_unik SET status='aktif' WHERE nokp='$nokpp'");
                 }


 }
}
}
if($kategori=='p') {
  $jenis_data='program';


 $insert="INSERT INTO `data_program_murid_optimize`( `id_rekod`, `nokp`, `kodsekolah`) VALUES "; 
    for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];

                        mysqli_query($conn,"INSERT INTO data_program_murid (id_rekod,nokp,kodsekolah,jenis_perkhidmatan,fokus,pendekatan,tarikh,waktu_mula,waktu_tamat)
                    VALUES ('$id_rekod','$nokpp','$kodsekolah','$j_perkhidmatan','$j_fokus','$pendekatan','$tarikh','$waktu_mula','$waktu_tamat')");
                    
                    
            $insert.="('$id_rekod','$nokpp', '$kodsekolah') ,";  
            
                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);

mysqli_query($conn,"insert into murid (nokp,nama,kodsekolah) select d.nokp,c.NAMA,d.kodsekolah from data_program_murid d left join murid m on m.nokp=d.nokp left join murid_cicir c on c.NOKP=d.nokp where id_rekod='$id_rekod' and m.id is null and d.kodsekolah='$kodsekolah'");
}
if($kategori=='g') {
  $jenis_data='kelas_ganti';
  $perkara=$tingkatan . '-' . $kelas;


 $insert="INSERT INTO `data_kelasganti_murid`( `nokp`, `id_rekod`, `kodsekolah`) VALUES "; 
    for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];


                    
            $insert.="('$nokpp','$id_rekod', '$kodsekolah') ,";  
            

}

$insert=rtrim($insert,",");
mysqli_query($conn,$insert);


//  mysqli_query($conn,"INSERT INTO `data_kelasganti_murid`( `nokp`, `id_rekod`, `kodsekolah`) select nokp,'$id_rekod','$kodsekolah' from murid where tingkatan='$tingkatan' and nama_kelas='$kelas' and kodsekolah='$kodsekolah'");

}
if($kategori=='kon') {
  $jenis_data='konsultasi';
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];

                          mysqli_query($conn,"INSERT INTO data_konsultasi_murid (nokp_pelajar,data_id,kodsekolah)
               VALUES ('$nokpp','$id_rekod', '$kodsekolah')");
               
                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                                            if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
               
          }

}

if($kategori=='cakna') {
  $jenis_data='cakna';
for($count = 0; $count < count($_POST["s_klien"]); $count++) {
              //echo "$klien[$a]<br />";
      $nokpp=$_POST["s_klien"][$count];
      mysqli_query($conn,"INSERT INTO `data_ziara_murid` ( `nokp_pelajar`, `data_id`,kodsekolah) VALUES ( '$nokpp', '$id_rekod', '$kodsekolah')");


                    if($berfokus==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_berfokus`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
                                        if($b_cicir==1){
                     mysqli_query($conn,"INSERT INTO `data_murid_b_cicir`(`id_rekod`, `nokp`, `kodsekolah` ) VALUES ( '$id_rekod','$nokpp', '$kodsekolah') ON DUPLICATE KEY UPDATE `id_rekod` = values(id_rekod) ");   
                    }
          }

}



if($tajuk_program!=''){
  $perkara=$tajuk_program;
}
mysqli_query($conn,"INSERT INTO data_aktiviti (username,kodsekolah,jenis_data,data_id,tarikh,waktu_mula,perkara)
                   VALUES ('$username','$kodsekolah','$jenis_data','$id_rekod','$tarikh','$waktu_mula','$perkara')");

mysqli_query($conn,"INSERT INTO `data_log`( `username`, `kodsekolah`, `perkara`, `tarikh`, `waktu_mula`, `waktu_tamat`, `kategori`,data_id) VALUES ('$username','$kodsekolah','$perkara','$tarikh','$waktu_mula','$waktu_tamat','$jenis_data','$id_rekod')");





    ?>
<script>
 alert("Aktiviti Direkod");
   //alert("Login first");
window.location.href = '" . base_url() . "';
  window.location.href='<?php echo $filename; ?>';
  </script>
<?php
}

?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
 



<?php




 $id='i';
 $id2=''; 
if(isset($_GET['data'])){
  if(isset($_GET['kategori'])) $id2=$_GET['kategori'];
   if(isset($_POST['kategori']))  $id2=$_POST['kategori'];
 
 $id=$_GET['data']; 
}


if(isset($_GET['id'])&&$_GET['id']!=''&&$_GET['id']!=0){
$data_id=$_GET['id'];
if($id2=='p') $sql="select * from data_program where id='$data_id'";
if($id2=='i' || $id2=='k') $sql="select * from data_individu where id='$data_id'";
if($id2=='kon' ) $sql="select * from data_konsultasi where id='$data_id'";
if($id2=='g' ) $sql="select * from data_kelasganti where id='$data_id'";
if($id2=='cakna' ) $sql="select *,kategori as kategoriziarah,impak as impakziarah from data_ziarah where id='$data_id'";
$i_data= mysqli_query($conn,$sql);
$s_data=mysqli_fetch_array($i_data);

$_POST['kategori']=$_GET['kategori'];
$_POST['j_program']=$s_data['jenis_program'];
$_POST['programlain']=$s_data['program_lain'];
$_POST['j_perkhidmatan']=$s_data['jenis_perkhidmatan'];
$_POST['j_fokus']=$s_data['fokus'];
$_POST['pendekatan']=$s_data['pendekatan'];

$_POST['tarikh']=date("d-m-Y", strtotime($s_data['tarikh']));
$_POST['waktu_mula']=$s_data['waktu_mula'];
$_POST['waktu_tamat']=$s_data['waktu_tamat'];


$_POST['tajuk_program']=$s_data['tajuk'];

if($id2=='p'){
    
    
 
$_POST['rumusanprogram']=$s_data['rumusanprogram'];
$_POST['objektif']=$s_data['objektif'];
$_POST['programsasaran']=$s_data['programsasaran'];
$_POST['kelebihan']=$s_data['kelebihan'];
$_POST['kelemahan']=$s_data['kelemahan'];
$_POST['penambaikkan']=$s_data['penambaikkan'];   
}


$_POST['perkara']=$s_data['perkara'];
$_POST['persoalan']=$s_data['persoalan'];
$_POST['tindakan']=$s_data['tindakan'];


$_POST['j_sesi']=$s_data['jenis'];
$_POST['sasaran']=$s_data['sasaran'];


$_POST['kelas_ganti']=$s_data['klasifikasi'];
$_POST['tingkatan']=$s_data['tingkatan'];
$_POST['kelas']=$s_data['kelas'];
$_POST['bil_waktu']=$s_data['bil_waktu'];


$_POST['kategori_klien']=$s_data['kategori'];
$_POST['nama_klien']=$s_data['nama_konsultasi'];

$_POST['tindakanintervensi']=$s_data['tindakanintervensi'];
$_POST['rumusanintervensi']=$s_data['rumusanintervensi'];
$_POST['pd_1']=$s_data['pd_1'];


if($id2=='cakna' ){
$_POST['kategoriziarah']=$s_data['kategoriziarah'];
$_POST['impakziarah']=$s_data['impakziarah'];
 $_POST['nama_klien']=$s_data['penjaga']; 

$m =$s_data[m];
$c=$s_data[c];
$i=$s_data[i];
$sb=$s_data[sb];
$sw=$s_data[sw];
$ll=$s_data[ll];
$pm=$s_data[pm];
$pc=$s_data[pc];
$pi=$s_data[pi];
$psb=$s_data[psb];
$psw=$s_data[psw];
$pll=$s_data[pll];


}
if($s_data['nama_konsultasi']=='')
if($s_data['kategori']=='penjaga') $_POST['nama_klien']=$s_data['namapenjaga'];
if($s_data['kategori']=='guru') $_POST['nama_klien']=$s_data['namaguru'];
if($s_data['kategori']=='alumni') $_POST['nama_klien']=$s_data['namaguru'];
if($s_data['kategori']=='agensiluar') $_POST['nama_klien']=$s_data['namaagensi'];
}

 if($id=="update") { ?>
<form method="post" action="">
  <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Kemaskini</h3>


  <div class="row mt hidden-phone">
          <div class="col-lg-4">
            <!--  BASIC BUTTONS -->
            <div class="showback">
              <h5><i class="fa fa-angle-right"></i>Kategori</h5>
              <input type="hidden" name="kategori" value="<?php echo $id2;?>">
              <select  disabled name="" class="form-control" id=kodnegeri >

<?php echo kategori($id2); ?>
                </select>
<?php if($id2!='kon' && $id2!='g'  && $id2!='p'  && $id2!='cakna'){ ?>
              <h5><i class="fa fa-angle-right"></i>Jenis</h5>
              <select name="j_sesi" class="form-control" id=kodnegeri >

<?php echo jenis($connect,$_POST['j_sesi'],$_POST['kategori']); ?>
                </select>

 <?php } ?>
     
<?php if($id2=='p' ){ ?>
              <h5><i class="fa fa-angle-right"></i>Jenis Program</h5>
              <select name="j_program" class="form-control"  id=j_programshow onchange="programshow(this)">

  <?php echo program($_POST['j_program']); ?>
                </select>
                <?php if(isset($_POST['programlain'])){ ?>
  <div id="programlain" class="hidden"><input placeholder="nyatakan nama program lain lain" class="form-control" type="text" name="programlain" value="<?php echo $_POST['programlain']; ?>" /></div>
<?php } ?>

<?php } ?>


<?php if($id2=='i' || $id2=='g'){ ?>
              <h5><i class="fa fa-angle-right"></i>Sasaran</h5>
              <select name="sasaran" class="form-control" id=kodnegeri >

<?php echo sasaran($id2,$_POST['sasaran']); ?>
                </select>
<?php } ?>
            </div>

          </div>

          <div class="col-lg-4 col-md-4 col-sm-12">
            <!--  BASIC BUTTONS -->
            <div class="showback">



<?php if($id2=='cakna'){ ?>

              <h5><i class="fa fa-angle-right"></i>Kategori Ziarah</h5>
              <select name="kategoriziarah" class="form-control" id=impakziarah >
<?php echo kategoriziarah($connect,$_POST['kategoriziarah']); ?>

                </select>


              <h5><i class="fa fa-angle-right"></i>Impak/Status</h5>
              <select name="impakziarah" class="form-control" id=impakziarah >
<?php echo impakziarah($_POST['impakziarah']); ?>

                </select>



       <?php } ?>   

<?php if($id2!='g' && $id2!='cakna'){ ?>
              <h5><i class="fa fa-angle-right"></i>Pendekatan</h5>
              <select name="pendekatan" class="form-control" id=kodnegeri >

  <?php echo pendekatan($_POST['pendekatan']); ?>
                </select>

       <?php } ?>    

<?php if($id2!='cakna' && $_POST['j_perkhidmatan']!='' ){ ?>

              <h5><i class="fa fa-angle-right"></i>Perkhidmatan </h5>
             <select name="j_perkhidmatan" class="form-control" id=kodnegeri onchange="khidmat(this);">

<?php echo perkhidmatan($connect,$_POST['j_perkhidmatan']); ?>
                </select>
              <h5><i class="fa fa-angle-right"></i>Fokus</h5>
              <div id=fokus>
                
              <select name="j_fokus" class="form-control" id=kodnegeri >

<?php echo fokus($connect,$_POST['j_perkhidmatan'],$_POST['j_fokus']); ?>
                </select>
                 </div>
                 <?php if($_POST['j_perkhidmatan']=='PD'){ ?>
              <h5><i class="fa fa-angle-right"></i>Kes</h5>
              <div id=get_pd>
                
              <select name="pd_1" class="form-control" id=kodnegeri >

<?php echo pd($connect,$_POST['j_fokus'],$_POST['pd_1']); ?>
                </select>
                 </div>
                 <?php } ?>
        <?php } ?>                  
            </div>

          </div>

                   <div class="col-lg-4 col-md-4 col-sm-12">
            <!--  BASIC BUTTONS -->
            <div class="showback">
              <h5><i class="fa fa-angle-right"></i>Tarikh</h5>
              <input required class="form-control form-control-inline input-medium default-date-picker " name="tarikh" size="16" type="text" value="<?php echo $_POST['tarikh']; ?>">
              <h5><i class="fa fa-angle-right"></i>Waktu Mula</h5>
              <div class="input-group bootstrap-timepicker">
                      <input required name="waktu_mula" type="time" class="form-control  "  value="<?php echo $_POST['waktu_mula']; ?>">
                    
                    </div>
              <h5><i class="fa fa-angle-right"></i>Waktu Tamat</h5>
              <div class="input-group bootstrap-timepicker">
                      <input required name="waktu_tamat" type="time" class="form-control" value="<?php echo $_POST['waktu_tamat']; ?>">
                      
                    </div>
            </div>

          </div>
  </div>

<?php //if($id2!='g'){ ?> 
           
<?php include 'semuacari.php'; ?>

<?php

if($data_id!=''&&$data_id!=0){
    
if($id2=='g') $sql2="select * from data_kelasganti_murid where id_rekod='$data_id'  and kodsekolah='$kodsekolah'";
if($id2=='p') $sql2="select * from data_program_murid where id_rekod='$data_id'  and kodsekolah='$kodsekolah'";
if($id2=='i' || $id2=='k') $sql2="select * from data_individu_murid where id_rekod='$data_id' and kodsekolah='$kodsekolah'";
if($id2=='kon' ) $sql2="select *,nokp_pelajar as nokp from data_konsultasi_murid where data_id='$data_id' and kodsekolah='$kodsekolah' ";
if($id2=='cakna' ) $sql2="select *,nokp_pelajar as nokp from data_ziara_murid where data_id='$data_id' and kodsekolah='$kodsekolah'";
           $result2 = mysqli_query($conn,$sql2);
           WHILE($rows2=mysqli_fetch_array($result2)) {
?>
<script>
  clientkp.push('<?php echo $rows2[nokp]; ?>');
</script>
<?php

           }
}    
           
           ?>
<script>
 showfor();
</script>




<?php //} ?>
        <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
              <div  class="form-horizontal style-form">


<?php if($id2=='g'){ ?> 



                <div class="form-group">
                  <label class="control-label col-md-3">Klasifikasi Kelas Ganti</label>
                  <div class="col-md-9 col-xs-11">
                
 <select required name="kelas_ganti" class="form-control" id=kodnegeri >
                  <option value="">Sila Pilih</option>
<?php echo ganti($_POST['kelas_ganti']); ?>
                </select>
                 
                   
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Tingkatan/Tahun</label>
                  <div class="col-md-9 col-xs-11">
                
<select required name="tingkatan" class="form-control" id=kodnegeri onchange="tingkatanshow(this)">

<?php echo tingkatan($connect,$_POST['tingkatan']); ?>
                </select>
                 
                   
                  </div>
                </div>


               <div class="form-group">
                  <label class="control-label col-md-3">Kelas</label>
                  <div class="col-md-9 col-xs-11">
                
<select required name="kelas" class="form-control" id=kelasshow >

<?php echo kelas($connect,$_POST['kelas']); ?>
                </select>
                 
                   
                  </div>
                </div>

               <div class="form-group">
                  <label class="control-label col-md-3">Bilangan Waktu</label>
                  <div class="col-md-9 col-xs-11">
                
<select required name="bil_waktu" class="form-control" id=kodnegeri >
                  <option value="">Sila Pilih</option>
<?php echo waktu($_POST['bil_waktu']); ?>
                </select>
                 
                   
                  </div>
                </div>

<?php }  else if($id2=='kon') { ?> 



 <?php  ?>               

                <div class="form-group">
                  <label class="control-label col-md-3">Kategori Klien</label>
                  <div class="col-md-9 col-xs-11">
                
<select required name="kategori_klien" <?php if(isset($_POST['kategori_klien'])) { echo " disabled ";} ?> class="form-control" id=kodnegeri >
<?php echo klien($_POST['kategori_klien']); ?>
                </select>
                 
                    <input type="hidden" name="kategori_klien" value="<?php echo $_POST['kategori_klien']; ?>"/>
                  </div>
                </div>



<?php if($_POST['kategori_klien']!='pelajar') { ?>
                  <div class="form-group">
                  <label class="control-label col-md-3">Nama <?php echo $_POST['kategori_klien']; ?></label>
                  <div class="col-md-9 col-xs-11">
                
              
                     <input required name="nama_klien" class="form-control form-control-inline input-medium  " size="16" type="text" value="<?php if(isset($_POST['nama_klien'])) echo $_POST['nama_klien']; ?>">
                 
                   
                  </div>
                </div>
<?php } ?> 

<?php } ?> 




<?php if($id2=='p'){ ?>
                <div class="form-group">
                  <label class="control-label col-md-3">Tajuk Program</label>
                  <div class="col-md-9 col-xs-11">
                     <input required name="tajuk_program" class="form-control form-control-inline input-medium  " size="16" type="text" value="<?php echo $_POST['tajuk_program']; ?>">
                  </div>
                </div>
                                <div class="form-group">
                  <label class="control-label col-md-3">Rumusan Program</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control "   rows="5" id="ccomment" name="rumusanprogram" required ><?php if(isset($_POST['rumusanprogram'])) echo $_POST['rumusanprogram']; ?></textarea>
                  
                  </div>
                </div>
                
                                              <div class="form-group">
                  <label class="control-label col-md-3">Objektif</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control "   rows="5" id="ccomment" name="objektif" required ><?php if(isset($_POST['objektif'])) echo $_POST['objektif']; ?></textarea>
                  
                  </div>
                </div>  
                
                               <div class="form-group">
                  <label class="control-label col-md-3">Sasaran</label>
                  <div class="col-md-9 col-xs-11">
                     <input required name="programsasaran" class="form-control form-control-inline input-medium  " size="16" type="text" value="<?php echo $_POST['programsasaran']; ?>">
                  </div>
                </div> 
                
                                                              <div class="form-group">
                  <label class="control-label col-md-3">Kelebihan</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control "   rows="3" id="ccomment" name="kelebihan" required ><?php if(isset($_POST['kelebihan'])) echo $_POST['kelebihan']; ?></textarea>
                  
                  </div>
                </div>
                
                                                              <div class="form-group">
                  <label class="control-label col-md-3">Kelemahan</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control "   rows="3" id="ccomment" name="kelemahan" required ><?php if(isset($_POST['kelemahan'])) echo $_POST['kelemahan']; ?></textarea>
                  
                  </div>
                </div>
                                                              <div class="form-group">
                  <label class="control-label col-md-3">Penambahbaikkan</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control "   rows="3" id="ccomment" name="penambaikkan" required ><?php if(isset($_POST['penambaikkan'])) echo $_POST['penambaikkan']; ?></textarea>
                  
                  </div>
                </div>
                
<?php } ?>

<?php if($id2=='i' || $id2=='k' || $id2=='kon'){ ?>
                <div class="form-group">
                  <label class="control-label col-md-3">Perkara</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control " onclick="daktif();"  rows="5" id="ccomment" name="perkara" required ><?php if(isset($_POST['perkara'])) echo $_POST['perkara']; ?></textarea>
                  
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Persoalan</label>
                  <div class="col-md-9 col-xs-11">
                
<textarea class="form-control " rows="5" id="ccomment" name="persoalan" required><?php if(isset($_POST['persoalan'])) echo $_POST['persoalan']; ?></textarea>
                   
                   
                  </div>
                </div>
    <!--            <div class="form-group">
                  <label class="control-label col-md-3">Tindakan</label>
                  <div class="col-md-9 col-xs-11">
                
<textarea class="form-control " rows="5" id="ccomment" name="tindakan" required><?php //if(isset($_POST['tindakan'])) echo $_POST['tindakan']; ?></textarea>
                   
                   
                  </div>
                </div>-->

    <?php } ?>  


<?php if($id2=='cakna' ){







function terlibat($id){
            for($x=0;$x<=10;$x++){
             echo "<option  value=\"$x\"";
             if($id==$x) echo " selected=selected ";
             echo ">$x</option>";

        }
}

 ?>




                <div class="form-group">
                  <label class="control-label col-md-2">Guru Terlibat</label>
                  <div class="col-md-9 col-xs-11">
<table width="100%" border="0">
  <tr>
    <td width="16%" align="center">&nbsp;</td>
    <td width="16%" align="center">M</td>
    <td width="16%" align="center">C</td>
    <td width="16%" align="center">I</td>
    <td width="16%" align="center">SB</td>
    <td width="16%" align="center">SW</td>
    <td width="20%" align="center">LL</td>
  </tr>
  <tr>
    <td align="center" >L</td>
    <td align="center"><select style='text-align-last:center;' name="m" id="m">
        <?php echo terlibat($m);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="c" id="c">
         <?php echo terlibat($c);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="i" id="i">
         <?php echo terlibat($i);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="sb" id="sb">
         <?php echo terlibat($sb);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="sw" id="sw">
         <?php echo terlibat($sw);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="ll" id="ll">
         <?php echo terlibat($ll);?>
    </select></td>
  </tr>
    <tr>
      <td align="center">P</td>
    <td align="center"><select style='text-align-last:center;' name="pm" id="m">
        <?php echo terlibat($pm);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="pc" id="c">
         <?php echo terlibat($pc);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="pi" id="i">
         <?php echo terlibat($pi);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="psb" id="sb">
         <?php echo terlibat($psb);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="psw" id="sw">
         <?php echo terlibat($psw);?>
    </select></td>
    <td align="center"><select style='text-align-last:center;'  name="pll" id="ll">
         <?php echo terlibat($pll);?>
    </select></td>
  </tr>
  
</table>
                  
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Nama Penjaga Murid</label>
                  <div class="col-md-9 col-xs-11">
                
                 <input required name="nama_klien" class="form-control form-control-inline input-medium  " size="16" type="text" value="<?php  echo $_POST['nama_klien']; ?>">
                   
                   
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Perkara</label>
                  <div class="col-md-9 col-xs-11">
<textarea class="form-control " onclick="daktif();"  rows="5" id="ccomment" name="perkara" required ><?php if(isset($_POST['perkara'])) echo $_POST['perkara']; ?></textarea>
                  
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Persoalan</label>
                  <div class="col-md-9 col-xs-11">
                
<textarea class="form-control " rows="5" id="ccomment" name="persoalan" required><?php if(isset($_POST['persoalan'])) echo $_POST['persoalan']; ?></textarea>
                   
                   
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Tindakan</label>
                  <div class="col-md-9 col-xs-11">
                
<textarea class="form-control " rows="5" id="ccomment" name="tindakan" required><?php if(isset($_POST['tindakan'])) echo $_POST['tindakan']; ?></textarea>
                   
                   
                  </div>
                </div>





    <?php } ?> 



                <div class="form-group">
                  <label class="control-label col-md-3">Tindakan/Intervensi </label>
                  <div class="col-md-9 col-xs-11">
                
<select required name="tindakanintervensi"  class="form-control"  >
<?php echo intervensi($connect,$_POST['pendekatan'],$_POST['tindakanintervensi']); ?>
                </select>
                 
                    
                  </div>
                </div>




                <div class="form-group">
                  <label class="control-label col-md-3">Huraian Tindakan / Intervensi</label>
                  <div class="col-md-9 col-xs-11">
                
<textarea class="form-control " rows="5" id="rumusanintervensi" name="rumusanintervensi" required><?php if(isset($_POST['rumusanintervensi'])) echo $_POST['rumusanintervensi']; ?></textarea>
                   
                   
                  </div>
                </div>




  <?php if($id2!='g' && $id2!='kon' && $id2!='cakna'){ ?>           
                <div class="form-group">
                  <label class="control-label col-md-3">Berfokus</label>
                  <div class="col-md-9 col-xs-11">
                
<input type="checkbox" style="width: 20px" class="checkbox form-control" id="berfokus"  name="berfokus" />
                   
                   
                  </div>
                </div>
    <?php } ?> 


  <?php if($id2=='p' || $id2=='i' || $id2=='k' ){ ?>           
                <div class="form-group">
                  <label class="control-label col-md-3">Berisiko Cicir</label>
                  <div class="col-md-9 col-xs-11">
                
<input type="checkbox" style="width: 20px" class="checkbox form-control"  name="b_cicir" />
                   
                   
                  </div>
                </div>
    <?php } ?> 
  



                                  <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                <?php 
if(isset($_GET['id'])&&$_GET['id']!=''&&$_GET['id']!=0){
  ?>
                      <button class="btn btn-theme" name="id" value="<?php echo $_GET['id']; ?>" type="submit">Kemaskini</button>
  <?php
} else {
  ?>
  <button class="btn btn-theme" name="data" value="simpan" type="submit">Simpan</button>
  <?php
}
                ?>
                      <button class="btn btn-theme04" type="button">Cancel</button>
                    </div>
                  </div>




                </div>



              </div>
            </div>
       
            <!-- /form-panel -->
          </div>


           



   
        <!-- /row -->
        <!-- DATE TIME PICKERS -->
   
        <!-- row -->
        <!--  TIME PICKERS -->
        
        <!-- row -->
        <!--ADVANCED FILE INPUT-->
        
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>
   </form>
  <?php }  else { ?>
   
   <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Lapor Aktiviti Bimbingan Dan Kaunseling</h3>

 <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
              <form  class="form-horizontal style-form">
                
                <div class="form-group">
                  <label class="control-label col-md-3">Kategori Sesi</label>
                  <div class="col-md-3 col-xs-11">
                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
<select name="data" class="form-control" id=kodnegeri onchange="this.form.submit()">

<?php echo kategori($id); ?>
                </select>
                    </div>
                   
                  </div>
                </div>

                
                

                

                

              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
 <form method="post" action="kaunseling.php?data=update">
        <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
              <div action="#" class="form-horizontal style-form">
                <div class="form-group">
                  <label class="control-label col-md-3">Tarikh Mula</label>
                  <div class="col-md-3 col-xs-11">
                    <input required class="form-control form-control-inline input-medium default-date-picker "  autocomplete="off" name="tarikh" size="16" type="text" value="<?php echo date("d-m-Y"); ?>">
                  
                  </div>
                </div>


<?php if($id=='i'){ ?>

                <div class="form-group">
                  <label class="control-label col-md-3">Jenis Sesi</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="j_sesi" class="form-control" id=kodnegeri >
<?php echo jenis($connect,'','i'); ?>
                </select>
                   
                   
                  </div>
                </div>

  


                <div class="form-group">
                  <label class="control-label col-md-3">Sasaran</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="sasaran" class="form-control" id=kodnegeri >
<?php echo sasaran('i',''); ?>
                </select>
                 
                   
                  </div>
                </div>

<?php } ?> 

<?php if($id=='k'){ ?>

                <div class="form-group">
                  <label class="control-label col-md-3">Jenis Sesi</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="j_sesi" class="form-control" id=kodnegeri >
<?php echo jenis($connect,'','k'); ?>
                  
                </select>
                   
                   
                  </div>
                </div>

  



<?php } ?> 

 <?php if($id=='kon'){ ?>               

                <div class="form-group">
                  <label class="control-label col-md-3">Kategori Klien</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="kategori_klien" class="form-control" id=kodnegeri >
<?php echo klien(''); ?>
                </select>
                 
                   
                  </div>
                </div>
<?php } ?> 
 <?php if($id=='p'){ ?> 


                <div class="form-group">
                  <label class="control-label col-md-3">Jenis Program</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="j_program" class="form-control" id=j_programshow onchange="programshow(this)" >
                  <option value="">Sila Pilih</option>
<?php echo program(''); ?>
                </select>
                 
                   <div id="programlain"></div>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3">Tajuk Program</label>
                  <div class="col-md-7 col-xs-11">
                
 <input required name="tajuk_program" class="form-control form-control-inline input-medium  " size="16" type="text" value="">
                 
                   
                  </div>
                </div>






<?php } ?> 

<?php if($id=='g'){ ?> 

                <div class="form-group">
                  <label class="control-label col-md-3">Sasaran</label>
                  <div class="col-md-3 col-xs-11">
                
 <select required name="sasaran" class="form-control" id=kodnegeri >
<?php echo sasaran('g',''); ?>
                  
                </select>
                 
                   
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Klasifikasi Kelas Ganti</label>
                  <div class="col-md-3 col-xs-11">
                
 <select required name="kelas_ganti" class="form-control" id=kelas_ganti onchange="fungsi_kelas_ganti(this)" >
                  <option value="">Sila Pilih</option>
<?php echo ganti(''); ?>
                </select>
                 
                   
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Tingkatan/Tahun</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="tingkatan" class="form-control" id=kodnegeri onchange="tingkatanshow(this)">

<?php echo tingkatan($connect,''); ?>
                </select>
                 
                   
                  </div>
                </div>


               <div class="form-group">
                  <label class="control-label col-md-3">Kelas</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="kelas" class="form-control" id=kelasshow >

<?php echo kelas($connect,''); ?>
                </select>
                 
                   
                  </div>
                </div>

               <div class="form-group">
                  <label class="control-label col-md-3">Bilangan Waktu</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="bil_waktu" class="form-control" id=kodnegeri >
                  <option value="">Sila Pilih</option>
<?php echo waktu(''); ?>
                </select>
                 
                   
                  </div>
                </div>

<?php } ?> 
<?php if($id!='g' && $id!='cakna'){ ?> 

                <div class="form-group">
                  <label class="control-label col-md-3">Pendekatan</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="pendekatan" class="form-control" id=kodnegeri >
<?php echo pendekatan($id); ?>
                </select>
                
                   
                  </div>
                </div>

<?php } ?>        
<?php if($id!='cakna'){ ?> 

<div id=s_kelas_ganti>
                <div class="form-group">
                  <label class="control-label col-md-3">Jenis Perkhidmatan</label>
                  <div class="col-md-3 col-xs-11">
 
   
<select required name="j_perkhidmatan" class="form-control" id=kodnegeri onchange="khidmat(this);">
                  <?php echo perkhidmatan($connect,''); ?>
                </select>

                </div>

                

              </div>
 <div class="form-group">
                  <label class="control-label col-md-3">Fokus</label>
                  <div class="col-md-3 col-xs-11">
 
   <div id=fokus>
<select required name="j_fokus" class="form-control" id=kodnegeri >
                  <option value=''>Sila Pilih Perkhidmatan</option>
                </select>
                </div>

      <div id=get_pd class="hidden">
<select  name="pd_1" class="form-control" id=kodnegeri >
                  <option value=''>Sila Pilih Fokus</option>
                </select>
                </div>                
                  </div>
                </div>               
</div>
 <?php } ?>             
 <?php if($id=='cakna'){ ?> 


                <div class="form-group">
                  <label class="control-label col-md-3">Kategori</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="kategoriziarah" class="form-control"   >
<?php echo kategoriziarah($connect,''); ?>
                </select>
                 
                   
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Impak</label>
                  <div class="col-md-3 col-xs-11">
                
<select required name="impakziarah" class="form-control"   >
                  <option value="">Sila Pilih</option>
<?php echo impakziarah(''); ?>
                </select>
                 
                   
                  </div>
                </div>




<?php } ?> 

            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
        <!-- DATE TIME PICKERS -->
   
        <!-- row -->
        <!--  TIME PICKERS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <div class="form-horizontal  style-form" >
                <div class="form-group">
                  <label class="control-label col-md-3">Waktu Mula</label>
                  <div class="col-md-3">
                    <div class="input-group bootstrap-timepicker">
                      <input required name="waktu_mula" type="time" class="form-control ">
                      
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Waktu Tamat</label>
                  <div class="col-md-3">
                    <div class="input-group bootstrap-timepicker">
                      <input required  name="waktu_tamat" type="time" class="form-control">
                      
                    </div>
                  </div>
                </div>
<input type="hidden" name="kategori" value="<?php echo $id; ?>"/>
                                  <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                      <button class="btn btn-theme" name="data" value="update" type="submit">Teruskan</button>
                      <button class="btn btn-theme04" type="button">Cancel</button>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
          </form>
        <!-- row -->
        <!--ADVANCED FILE INPUT-->
        
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>

  <?php } ?>

    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
<?php include('include/footer.php'); ?>
    </footer>
    <!--footer end-->
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php include('include/js.php'); ?>

         <script>
        function khidmat(e){
    
        $.ajax({
          type: 'GET',
          url: 'get/khidmat.php',
          data: 'term='+e.value,
          dataType: 'json',
          success : function(json) {

            if(json){
                if(e.value=='PD'){
                        var insDetails = '<select required name="j_fokus" class="form-control" onchange="khidmat_pd(this);">';
                }
                else
                {
                 var insDetails = '<select required name="j_fokus" class="form-control" >';   
                }
              
               insDetails += '<option value="">Pilih Fokus</option>';
              $.each(json, function(i, data) {
                
                  //logo path


                  insDetails +='<option value="'+data.kod+'" > '+data.nama+'</option>';
                });
              insDetails +="</select>";
            }

            document.getElementById("fokus").innerHTML=insDetails;
              // $(".dropdown-menu").css("display", "none");
              // $("#selSearchText").trigger('click');
              
              if(e.value=='PD'){
                  
      var insDetails2 = '<select required name="j_fokus" class="form-control" onchange="khidmat_pd(this);">';
       insDetails2 += '<option value="">Pilih Fokus</option>';
       insDetails2 +="</select>";           
                  
    $('#get_pd').removeClass('hidden');               
   document.getElementById("get_pd").innerHTML=insDetails2; 
   
  
   
}
else
{
    
                
    $('#get_pd').addClass('hidden');
    
      var insDetails3 = '<select name="pd_1" class="form-control" ></select>';
    document.getElementById("get_pd").innerHTML=insDetails3;
    
}
              
            }
            
            
            
          });


        }
        
        
         function khidmat_pd(e){
    


        $.ajax({
          type: 'GET',
          url: 'get/disiplin.php',
          data: 'term='+e.value,
          dataType: 'json',
          success : function(json) {

            if(json){
              var insDetails = '<select required name="pd_1" class="form-control" >';
               insDetails += '<option value="">Pilih Kes</option>';
              $.each(json, function(i, data) {
                
                  //logo path


                  insDetails +='<option value="'+data.kod+'" > '+data.nama+'</option>';
                });
              insDetails +="</select>";
            }

            document.getElementById("get_pd").innerHTML=insDetails;
              // $(".dropdown-menu").css("display", "none");
              // $("#selSearchText").trigger('click');
              

              
            }
            
            
            
          });
          
          
        }       
        
function fungsi_kelas_ganti(e){
  if(e.value!='aktiviti_bk' && e.value!=''){
  document.getElementById("s_kelas_ganti").innerHTML='';
}
else
{
    if(document.getElementById("s_kelas_ganti").innerHTML=='' ) window.location.reload(true);
}

}

function programshow(e){
    
    //if(e.value=='dwen'){
        
    //      window.location.href='/e/lpbk/j_i.php?lk1';
        
    //}
   // if(e.value=='agp'){
        
   //       window.location.href='/e/lpbk/j_e.php?lg1';
        
    //}
    
    
  if(e.value=='lain'){
  document.getElementById("programlain").innerHTML='<input placeholder="nyatakan nama program lain lain" class="form-control" required type="text" name="programlain"  />';
}
else
{
  document.getElementById("programlain").innerHTML='';
}
$('#programlain').removeClass('hidden');
}


        function tingkatanshow(e){

    var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
        $.ajax({
          type: 'GET',
          url: 'test/get_kelas.php',
          data: 'tahun='+e.value+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {

            if(json){
              var insDetails = '<select required name="kelas" class="form-control">';
               insDetails += '<option value="">Pilih Kelas</option>';
              $.each(json, function(i, data) {
                
                  //logo path


                  insDetails +='<option value="'+data.kod+'" > '+data.nama+'</option>';
                });
              insDetails +="</select>";
            }

            document.getElementById("kelasshow").innerHTML=insDetails;
              // $(".dropdown-menu").css("display", "none");
              // $("#selSearchText").trigger('click');
            }
          });


        }

       </script> 


</body>

</html>
