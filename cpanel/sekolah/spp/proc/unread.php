<?php
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/auth.php");
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/sekolah.php");

if(isset($_GET['id'])){
    $kuri = $PPD->prepare("UPDATE muatturun_analisis SET download = 0, baca = 0 WHERE idsurat = ? AND kodsekolah = ?");
    $kuri->execute([$_GET['id'],USER]);

    header('Location: ../.');
    exit();
}
