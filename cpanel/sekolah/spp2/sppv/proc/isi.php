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


if(isset($_POST['simpan'])){

$tarikh = $_POST['tarikh'];
$ctarikh=$newDate = date("m", strtotime($tarikh));
$ytarikh=$newDate = date("Y", strtotime($tarikh));
    $kuri = $PPD->prepare("SELECT * FROM `spp` where year(tarikh)=? and month(tarikh)=? and kodsekolah = ?  LIMIT 1");
    $kuri->execute([$ytarikh,$ctarikh,USER]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);
if($d['tarikh']!=''){
            ?>
<script>alert("Rekod Untuk Bulan Ni Telah Wujud, Sila Semak Senarai");
window.location.href='../senarai.php';
</script>

<?php
}

$jawatan = $_POST['jawatan'];
$namapegawai = htmlspecialchars($_POST['namapegawai']);
    $x=0;
$v='("'.USER.'","'.$tarikh.'",'.$jawatan.',"'.$namapegawai.'",';
    
 foreach($_POST['peranti'] as $s){

//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$v.= '"'.$_POST['perantiu'][$x].'","'.$s.'","'.$_POST['catatan'][$x].'",';
$x++;
 }



$i=0;
$feild='(`kodsekolah`,`tarikh`,`jawatan`,`namapegawai`,';
 foreach($_POST['peranti'] as $s){
$i++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$feild.= '`u'.$i.'`,`v'.$i.'`,`catatan'.$i.'`,';

 }

$feild=rtrim($feild,',');
$feild.= ')';

 $v=rtrim($v,',');
$v.= ')';

//echo $feild;
//echo "<br>";
//echo $v;

$sql="INSERT INTO `spp` ".$feild." values ".$v."";
//echo $sql;
//$page = "?page=".$_POST['page'];
$kuri = $PPD->prepare($sql);
    if($kuri->execute([])){
$id = $PPD->lastInsertId();

        ?>
<script>alert("Direkod");
window.location.href='../cetak.php?id=<?php echo $id; ?>';
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


if(isset($_POST['kemaskini'])){




$id = $_POST['kemaskini'];

$tarikh = $_POST['tarikh'];
$jawatan = $_POST['jawatan'];
$namapegawai = htmlspecialchars($_POST['namapegawai']);




$ufeild=' tarikh = "'.$tarikh.'",jawatan='.$jawatan.',namapegawai="'.$namapegawai.'", ' ;
$i=0;
$x=0;
 foreach($_POST['peranti'] as $s){
$i++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$ufeild.= '`u'.$i.'`='.$_POST['perantiu'][$x].',`v'.$i.'`='.$s.',`catatan'.$i.'`="'.$_POST['catatan'][$x].'",';
$x++;
 }


$ufeild=rtrim($ufeild,',');
$ufeild.= '';


//echo $ufeild;
//echo "<br>";
//echo $v;

$sql="UPDATE `spp` SET  ".$ufeild." WHERE kodsekolah=? and id=?";
//echo $sql;
//$page = "?page=".$_POST['page'];
$kuri = $PPD->prepare($sql);

    if($kuri->execute([USER,$id])){
        ?>
<script>alert("Direkod");
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

    $kuri = $PPD->prepare("DELETE FROM `spp` WHERE id = ? AND kodsekolah = ?");
    if($kuri->execute([$id,USER])){
        ?>
<script>alert("Rekod dipadam");
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
