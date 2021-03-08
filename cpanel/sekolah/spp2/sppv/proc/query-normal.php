<?php
$kuri = $PPD->prepare("SELECT * FROM `spp` s left join sts_jawatan j on j.kod=s.jawatan  where s.kodsekolah=? order by tarikh");
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM sts2020  where  kodsekolah=? and status =0");
$kuri->execute([USER]);
$kaun = $kuri->fetch()['bil'];