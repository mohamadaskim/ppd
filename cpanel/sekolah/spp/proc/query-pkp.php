<?php
$kuri = $PPD->prepare("SELECT muatturun.*,users.realname,users.gambar,users.jawatan,users.sektor FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
WHERE (muatturun.dateadded BETWEEN '2020-03-18' AND '2020-06-09')
AND muatturun.publish = 1
ORDER BY muatturun.dateadded DESC LIMIT 10 OFFSET {$offset}");
$kuri->execute();
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

//utk pagination
$kuri = $PPD->prepare("SELECT COUNT(*) AS bil FROM muatturun
INNER JOIN users ON muatturun.owner = users.username
WHERE (muatturun.dateadded BETWEEN '2020-03-18' AND '2020-06-09')
AND muatturun.publish = 1
ORDER BY muatturun.dateadded DESC");
$kuri->execute();
$kaun = $kuri->fetch()['bil'];