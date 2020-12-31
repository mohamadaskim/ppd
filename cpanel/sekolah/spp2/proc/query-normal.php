<?php
$kuri = $PPD->prepare("SELECT * FROM `icakna_senarai` s where s.kodsekolah=? LIMIT 20 OFFSET {$offset}");
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM sts2020  where  kodsekolah=? and status =0");
$kuri->execute([USER]);
$kaun = $kuri->fetch()['bil'];