<?php
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/auth.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/pegawai.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/function.php");

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
    $mula = myDate2us($_POST['mula']);
    $hingga = myDate2us($_POST['hingga']);
    $masa = $_POST['masa'];
    $kat = $_POST['kat'];
    $title = $_POST['tajuk'];
    $location = $_POST['lokasi'];
    $id = $_POST['id'];

    $kuri = $PPD->prepare("UPDATE egerak_subutama SET actdate=?,enddate=?,masa=?,kategori=?,title=?,`location`=? WHERE id = ? AND kputama = ?");
    if($kuri->execute([$mula,$hingga,$masa,$kat,$title,$location,$id,USER])){
        $a = explode('/',$_POST['mula']);
        header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
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

    $kuri = $PPD->prepare("DELETE FROM egerak_subutama WHERE id = ? AND kputama = ?");
    if($kuri->execute([$id,USER])){
        if(isset($_GET['bulan'])){
            header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            header('Location: ../.');
        }
        exit();
    } else {
        header('Location: ../.');
        exit();
    }
}