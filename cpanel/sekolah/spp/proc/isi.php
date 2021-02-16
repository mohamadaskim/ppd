<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");


if(isset($_POST['first'])){
    $mula = myDate2us($_POST['mula']);
    if($_POST['hingga']){
        $hingga = myDate2us($_POST['hingga']);
    } else {
        $hingga = $mula;
    }
    $masa = $_POST['masa'];
    $kat = $_POST['kat'];

    if($kat=='003'||$kat=='005'){
        $stat = 1;
    } else {
        $stat = 0;
    }

    $kuri = $PPD->prepare("INSERT INTO egerak_subutama (kputama,kategori,actdate,enddate,masa,`status`) VALUES (?,?,?,?,?,?)");
    $kuri->execute([USER,$kat,$mula,$hingga,$masa,$stat]);

    if(!$stat){
        header('Location: ../.');
    } else {
        header('Location: ../senarai.php');
    }

    exit();
}

if(isset($_POST['second'])){
    $id = $_POST['id'];
    $kat = $_POST['kat'];
    $tajuk = $_POST['tajuk'];
    $lokasi = $_POST['lokasi'];

    $kuri = $PPD->prepare("UPDATE egerak_subutama SET kategori=?,title=?,`location`=?,`status`=1 WHERE id=? AND kputama=?");
    $kuri->execute([$kat,$tajuk,$lokasi,$id,USER]);

    header('Location: ../senarai.php');
    exit();
}

if(isset($_POST['kemaskini'])){

    $id = $_POST['id'];
$kewpa = $_POST['kewpa'];
$tahunperolehan = $_POST['tahunperolehan'];
$lokasi = $_POST['lokasi'];
$keterangan = $_POST['keterangan'];
$kerosakkan = $_POST['kerosakkan'];
$pegawai = $_POST['pegawai'];
$jawatan = $_POST['jawatan'];
$jenama = $_POST['jenama'];
$model = $_POST['model'];
$view = $_POST['view'];
$_SESSION['PENGESAH']=$pegawai;
$_SESSION['PENGESAHJ']=$jawatan;
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