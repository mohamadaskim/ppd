<?php
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/auth.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/function.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/pegawai.php");

if(isset($_POST['bulanpie'])){
    $sektor = htmlspecialchars($_POST['cartamb']);
    $tahun = htmlspecialchars($_POST['tahun']);
    $bulan = htmlspecialchars($_POST['bulanpie']);

    if($sektor!='all'){
        $tapis1 = "AND sektor = '{$sektor}'";
    } else {
        $tapis1 = '';
    }

    if($bulan!='all'){
        $tapis2 = "AND MONTH(masa) = '{$bulan}'";
    } else {
        $tapis2 = '';
    }

    $kuri = $PPD->query("SELECT DISTINCT(aspek),COUNT(*) FROM mbp WHERE YEAR(masa) = '{$tahun}' {$tapis1} {$tapis2} GROUP BY aspek");
    $datapie = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);
    unset($datapie['']);
}

header('Content-Type: application/json');
echo json_encode($datapie);