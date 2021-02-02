<?php
$kuri = $PPD->prepare("SELECT muatturun.*,users.realname,users.gambar,users.jawatan,users.sektor FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
WHERE muatturun.penerangan LIKE ?
AND users.sektor LIKE ?
AND users.realname LIKE ?
AND YEAR(muatturun.dateadded) LIKE ?
AND muatturun.edaran LIKE ?
AND muatturun.publish = 1
ORDER BY muatturun.dateadded DESC LIMIT 10 OFFSET {$offset}");
$kuri->execute([$keyword,$sektor,$pegawai,$tahun,$edaran]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) as bil FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
WHERE muatturun.penerangan LIKE ?
AND users.sektor LIKE ?
AND users.realname LIKE ?
AND YEAR(muatturun.dateadded) LIKE ?
AND muatturun.edaran LIKE ?
AND muatturun.publish = 1
ORDER BY muatturun.dateadded DESC");
$kuri->execute([$keyword,$sektor,$pegawai,$tahun,$edaran]);
$kaun = $kuri->fetch()['bil'];