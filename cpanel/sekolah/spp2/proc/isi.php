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
$jawatan = $_POST['jawatan'];

    $x=0;
$v='("'.USER.'","'.$tarikh.'",'.$jawatan.',';
    
 foreach($_POST['peranti'] as $s){

//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$v.= '"'.$s.'","'.$_POST['catatan'][$x].'",';
$x++;
 }



$i=0;
$feild='(`kodsekolah`,`tarikh`,`jawatan`,';
 foreach($_POST['peranti'] as $s){
$i++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$feild.= '`v'.$i.'`,`catatan'.$i.'`,';

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


if(isset($_POST['kemaskini'])){




$id = $_POST['kemaskini'];

$tarikh = $_POST['tarikh'];
$jawatan = $_POST['jawatan'];





$ufeild=' tarikh = "'.$tarikh.'",jawatan='.$jawatan.', ' ;
$i=0;
$x=0;
 foreach($_POST['peranti'] as $s){
$i++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$ufeild.= '`v'.$i.'`='.$s.',`catatan'.$i.'`="'.$_POST['catatan'][$x].'",';
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
