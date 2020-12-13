<?php
$kuri = $PPD->prepare("SELECT muatturun.*,users.realname,users.gambar,users.jawatan,users.sektor FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
INNER JOIN muatturun_analisis ON muatturun.id = muatturun_analisis.idsurat
WHERE muatturun_analisis.baca $baca 0
AND YEAR(muatturun.dateadded) = ?
AND muatturun_analisis.kodsekolah = ?
AND muatturun.publish = 1
AND (muatturun.edaran = '008' OR muatturun.edaran = '007')
ORDER BY muatturun.dateadded DESC LIMIT 10 OFFSET {$offset}");
$kuri->execute([date('Y'),USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
INNER JOIN muatturun_analisis ON muatturun.id = muatturun_analisis.idsurat
WHERE muatturun_analisis.baca $baca 0
AND YEAR(muatturun.dateadded) = ?
AND muatturun_analisis.kodsekolah = ?
AND muatturun.publish = 1
AND (muatturun.edaran = '008' OR muatturun.edaran = '007')
ORDER BY muatturun.dateadded DESC");
$kuri->execute([date('Y'),USER]);
$kaun = $kuri->fetch()['bil'];