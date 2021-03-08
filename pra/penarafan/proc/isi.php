<?php
require("../../sess.php");




if(isset($_GET['kemaskini'])){
$kat=$_GET['kat'];
$tarikh=$_GET['tarikh'];
$pegawai=$_GET['pegawai'];
$namainstitusi=$_GET['namainstitusi'];
$alamatinstitusi=$_GET['alamatinstitusi'];
$daerah=$_GET['daerah'];
$negeri=$_GET['negeri'];


$telefon=$_GET['telefon'];
$email=$_GET['email'];
$namapengerusi=$_GET['namapengerusi'];
$kaum=$_GET['kaum'];

$lokasi=$_GET['lokasi'];
$namagb=$_GET['namagb'];
$ml=$_GET['ml'];
$mp=$_GET['mp'];
$gl=$_GET['gl'];
$gp=$_GET['gp'];

$sql = "INSERT INTO `penarafan_bulan`( `kodsekolah`, `tarikh`, `pegawai`, `namainstitusi`, `alamatinstitusi`, `daerah`, `negeri`, `telefon`, `email`, `namapengerusi`, `kaum`, `lokasi`, `namagb`, `ml`, `mp`, `gl`, `gp`) VALUES (?,'$_GET[tarikh]', ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$kuri = $connect->prepare($sql);
$kuri->execute([USER,$pegawai,$namainstitusi,$alamatinstitusi,$daerah,$negeri,$telefon,$email,$namapengerusi,$kaum,$lokasi,$namagb,$ml,$mp,$gl,$gp]);


$id = $connect->lastInsertId();
echo $id.$sql;
    $x=0;
    $insert='';
 foreach($_GET['dataid'] as $s){
$x++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$insert.= '("'.USER.'",'.$id.','.$_GET['dataid'][$x].',"'.$_GET['data'][$x].'",""),';
 }

 $insert=rtrim($insert,',');
//echo $insert.'<br>';

//$x=0;
//$aktiviti_murid = [];
            //    foreach($_GET['data'] as $key => $value)
             //   {
              //      $x++;
               //     $aktiviti_murid[] = [
               //         'kodsekolah' => USER,

               //     ];
              //  }

//echo json_encode($aktiviti_murid);



$sql = "INSERT INTO penarafan_data ( `kodsekolah`, `data_id`,`perkara_id`, `value`,`ulasan`) VALUES ".$insert;



    $kuri = $connect->prepare($sql);

    //$kuri->bindValue(':kodsekolah', USER);
    if($kuri->execute()){
        ?>
<script>//alert("");
//window.location.href='../../index.php';
</script>

<?php
 echo $sql; 

        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    } else {
       // header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        exit();
    }
}

if(isset($_GET['buang'])){
    $id = $_GET['buang'];
    $bulan = $_GET['bulan']??'';
    $tahun = $_GET['tahun']??'';
    $view = $_GET['view'];
$page = "?page=".$_GET['page'];

    $kuri = $connect->prepare("DELETE FROM `penilaian_bulan` WHERE ID = ? AND kodsekolah = ?");
    if($kuri->execute([$id,USER])){
$kuri = $connect->prepare("DELETE FROM `penilaian_data` WHERE data_id = ? AND kodsekolah = ?");
        $kuri->execute([$id,USER]);
        
        ?>
<script>alert("Rekod Dipadam");
window.location.href='../../senarai.php';
</script>

<?php
        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    } else {
       // header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        exit();
    }
} 