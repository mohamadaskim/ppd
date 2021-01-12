<?php
$kat=1;
if(isset($_GET['kat'])) $kat=$_GET['kat'];
$kuri = $PPD->prepare("SELECT * FROM `penilaian_perkara` where kategori=$kat");
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM sts2020  where  kodsekolah=? and status =0");
$kuri->execute([USER]);
$kaun = $kuri->fetch()['bil']; 