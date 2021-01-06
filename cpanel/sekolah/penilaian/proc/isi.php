<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");




if(isset($_GET['kemaskini'])){
 foreach($_GET['data'] as $s){

echo $_GET['data'][2];
 }

$page = "?page=".$_POST['page'];
    $kuri = $PPD->prepare("UPDATE sts2020 SET kewpa=?,tahunperolehan=?,lokasi=?,keterangan=?,kerosakkan=?,jenama=?,model=? WHERE id = ? AND kodsekolah = ?");
    if($kuri->execute([$kewpa,$tahunperolehan,$lokasi,$keterangan,$kerosakkan,$jenama,$model,$id,USER])){
        $a = explode('/',$_POST['mula']);

$kuri = $PPD->prepare("INSERT INTO `sts_pengesah`(`id_rekod`, `kodsekolah`, `pegawai`, `jawatan`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE pegawai=?,jawatan=? ");
$kuri->execute([$id,USER,$pegawai,$jawatan,$pegawai,$jawatan]);
        //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
?>
<script>alert("Peralatan Dikemaskini");
window.location.href='../<?php echo $view.$page; ?>';
</script>

<?php
        exit();
    } else {
        header('Location: ../.');
        exit();
    }
    
}

if(isset($_GET['buang'])){
    $id = $_GET['buang'];
    $bulan = $_GET['bulan']??'';
    $tahun = $_GET['tahun']??'';
    $view = $_GET['view'];
$page = "?page=".$_GET['page'];

    $kuri = $PPD->prepare("UPDATE sts2020 SET status=1 WHERE id = ? AND kodsekolah = ?");
    if($kuri->execute([$id,USER])){
        ?>
<script>alert("Peralatan Dipadam");
window.location.href='../<?php echo $view.$page; ?>';
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