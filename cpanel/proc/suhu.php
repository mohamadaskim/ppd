<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");
include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/pegawai.php");
include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/function.php");

if(isset($_POST['suhu'])){

    $suhu = $_POST['suhu'];

    $kuri = $PPD->prepare("INSERT INTO suhu (pegawai,suhu,masa) VALUES (?,?,?)");
    $kuri->execute([USER,$suhu,NOW]);

    header('Location: ../.');
    exit();
}