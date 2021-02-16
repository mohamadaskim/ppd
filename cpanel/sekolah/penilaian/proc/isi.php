<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");


if(isset($_GET['simpan'])){
$kat=$_GET['kat'];
$syarikat=$_GET['syarikat'];
$tempoh_mula=$_GET['tempoh_mula'];
$tempoh_tamat=$_GET['tempoh_tamat'];
$enrolmen=$_GET['enrolmen'];
$zon=$_GET['zon'];
$sql = "INSERT INTO `penilaian_bulan`( `kodsekolah`, `tarikh`, `syarikat`, `tempoh_mula`, `tempoh_tamat`, `murid`, `zon`,`kategori`) VALUES (?,'$_GET[tarikh]', ?,?,?,?,?,?)";
$kuri = $PPD->prepare($sql);
$kuri->execute([USER,$syarikat,$tempoh_mula,$tempoh_tamat,$enrolmen,$zon,$kat]);
$id = $PPD->lastInsertId();

    $x=0;
    $insert='';
 foreach($_GET['dataid'] as $s){
$x++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$insert.= '("'.USER.'",'.$id.','.$_GET['dataid'][$x].',"'.$_GET['data'][$x].'","'.$_GET['datatext'][$x].'"),';
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



$sql = "INSERT INTO penilaian_data ( `kodsekolah`, `data_id`,`perkara_id`, `value`,`ulasan`) VALUES ".$insert;

  if($kat==1) $file="cetak.php";
     if($kat==2) $file="cetak2.php";

    $kuri = $PPD->prepare($sql);

    //$kuri->bindValue(':kodsekolah', USER);
    if($kuri->execute()){
        ?>
<script>alert("Penilaian Telah Direkod");
window.location.href='../<?php echo $file; ?>?id=<?php echo $id; ?>';
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


if(isset($_GET['kemaskini'])){
    $idx=$_GET['kemaskini'];

  $kuri = $PPD->prepare("DELETE FROM `penilaian_bulan` WHERE ID = ? AND kodsekolah = ? ");  
  $kuri->execute([$idx,USER]);
    $kuri = $PPD->prepare(" DELETE FROM `penilaian_data` WHERE data_id = ? AND kodsekolah = ?");  
  $kuri->execute([$idx,USER]);
$kat=$_GET['kat'];
$syarikat=$_GET['syarikat'];
$tempoh_mula=$_GET['tempoh_mula'];
$tempoh_tamat=$_GET['tempoh_tamat'];
$enrolmen=$_GET['enrolmen'];
$zon=$_GET['zon'];
$sql = "INSERT INTO `penilaian_bulan`( `kodsekolah`, `tarikh`, `syarikat`, `tempoh_mula`, `tempoh_tamat`, `murid`, `zon`,`kategori`) VALUES (?,'$_GET[tarikh]', ?,?,?,?,?,?)";
$kuri = $PPD->prepare($sql);
$kuri->execute([USER,$syarikat,$tempoh_mula,$tempoh_tamat,$enrolmen,$zon,$kat]);
$id = $PPD->lastInsertId();

    $x=0;
    $insert='';
 foreach($_GET['dataid'] as $s){
$x++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$insert.= '("'.USER.'",'.$id.','.$_GET['dataid'][$x].',"'.$_GET['data'][$x].'","'.$_GET['datatext'][$x].'"),';
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



$sql = "INSERT INTO penilaian_data ( `kodsekolah`, `data_id`,`perkara_id`, `value`,`ulasan`) VALUES ".$insert;



    $kuri = $PPD->prepare($sql);

    //$kuri->bindValue(':kodsekolah', USER);
    if($kuri->execute()){
        ?>
<script>alert("Penilaian Telah Dikemaskini");
window.location.href='../senarai.php';
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

if(isset($_GET['buang'])){
    $id = $_GET['buang'];
    $bulan = $_GET['bulan']??'';
    $tahun = $_GET['tahun']??'';
    $view = $_GET['view'];
$page = "?page=".$_GET['page'];

    $kuri = $PPD->prepare("DELETE FROM `penilaian_bulan` WHERE ID = ? AND kodsekolah = ?");
    if($kuri->execute([$id,USER])){
$kuri = $PPD->prepare("DELETE FROM `penilaian_data` WHERE data_id = ? AND kodsekolah = ?");
        $kuri->execute([$id,USER]);
        
        ?>
<script>alert("Rekod Dipadam");
window.location.href='../senarai.php';
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