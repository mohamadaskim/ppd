<?php
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/auth.php");
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/sekolah.php");

if(isset($_GET['id'])){
    if($_GET['c']!==''){
        $count = $_GET['c'] + 1;
        $kuri = $PPD->prepare("UPDATE muatturun_analisis SET download = ? WHERE idsurat = ? AND kodsekolah = ?");
        $kuri->execute([$count,$_GET['id'],USER]);
    }
    
    $kuri = $PPD->prepare("SELECT namasebenar FROM muatturun WHERE id = ? LIMIT 1");
    $kuri->execute([$_GET['id']]);
    $nama = $kuri->fetch(PDO::FETCH_ASSOC)['namasebenar'];

    header('Location: ../../../../lampiran/'.$nama);
    exit();
}

