<?php
$kodsekolah=USER;
if(isset($_GET['kodsekolah'])){
$kodsekolah=$_GET['kodsekolah'];
}
$kuri = $PPD->prepare("SELECT * FROM `icakna_senarai` s where s.kodsekolah=? LIMIT 20 OFFSET {$offset}");
$kuri->execute([$kodsekolah]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM sts2020  where  kodsekolah=? and status =0");
$kuri->execute([USER]);
$kaun = $kuri->fetch()['bil'];