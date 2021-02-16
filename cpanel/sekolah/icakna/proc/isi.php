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
$krateria = $_POST['krateria'];
$kat = $_POST['kat'];
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$isu = $_POST['isu'];
$tindakan = $_POST['tindakan'];
$pengisi = $_POST['pengisi'];

$page = "?page=".$_POST['page'];
    $kuri = $PPD->prepare("INSERT INTO `icakna_senarai`(`kodsekolah`, `nama`, `kreteria`, `kategori`, `keterangan`, `isu`, `tindakan`, `pengisi`) VALUES (?,?,?,?,?,?,?,?)");
    if($kuri->execute([USER,$nama,$krateria,$kat,$keterangan,$isu,$tindakan,$pengisi])){
        ?>
<script>alert("Tambah senarai berjaya");
window.location.href='../senarai.php';
</script>

<?php
        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    }else {
       // header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        exit();
    }
    
}


if(isset($_POST['ulasan'])){

    $id = $_POST['ulasan'];
$ulasan = $_POST['ulasankod'];
$kodsekolah=$_POST['kodsekolah'];

$page = "?page=".$_POST['page'];
    $kuri = $PPD->prepare("UPDATE `icakna_senarai` SET `ulasankod` = ?,ulasandari=? WHERE kodsekolah=? and `ID` = ?");
    if($kuri->execute([$ulasan,USER,$kodsekolah,$id])){
        ?>
<script>alert("Ulasan Disimpan");
window.location.href='../sekolah.php';
</script>

<?php
        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    }else {
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

    $kuri = $PPD->prepare("DELETE from icakna_senarai  WHERE id = ? AND kodsekolah = ?");
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