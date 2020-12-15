<?php
$kuri = $PPD->prepare("SELECT * FROM `sts2020` s left join sts_pengesah p on p.id_rekod=s.ID where s.kodsekolah=? and status = 0 LIMIT 20 OFFSET {$offset}");
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM sts2020  where  kodsekolah=? and status =0");
$kuri->execute([USER]);
$kaun = $kuri->fetch()['bil'];