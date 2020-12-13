<?php

//DATA
require('../dbcon/data.php');
require('../dbcon/ppd.php');

$tahun = date('Y');
$bulan = date('m');
$harini = date('Y-m-d');
$username = USER;

//DATA INFO TERKINI
$kuri = $PPD->query("SELECT muatturun.id,muatturun.penerangan,muatturun.dateadded,users.gambar,users.realname FROM muatturun
                    INNER JOIN users ON muatturun.owner = users.username
                    ORDER BY muatturun.dateadded DESC LIMIT 50");
$infosekolah = $kuri->fetchAll(PDO::FETCH_ASSOC);


//TAKWIM
//$kuri = $PPD->query("SELECT tajuk,dari,hingga,tempat,pembekal FROM takwim WHERE DATE(dari) >= '$harini' ORDER BY dari DESC");
//$takwim = $kuri->fetchAll(PDO::FETCH_ASSOC);

//DATA EGERAK
$kuri = $PPD->query("SELECT Kategori,Keterangan FROM egerak_kenyataan");
$egkat = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);
$kuri = $PPD->query("SELECT egerak_subutama.kategori,egerak_subutama.location,egerak_subutama.title,egerak_subutama.actdate,users.realname,users.gambar FROM egerak_subutama
                    INNER JOIN users ON egerak_subutama.kputama = users.username WHERE egerak_subutama.actdate <= '$harini' AND egerak_subutama.enddate >= '$harini'
                    ORDER BY egerak_subutama.actdate ASC");
$egerak = $kuri->fetchAll(PDO::FETCH_ASSOC);

//DATA TEMPAH DEWAN
$kuri = $PPD->query("SELECT kodbilik.namabilik as tempat2,bilik.masa2,bilik.tajuk,users.realname,users.gambar,bilik.dari FROM bilik
                    INNER JOIN kodbilik ON bilik.tempat = kodbilik.kod
                    INNER JOIN users ON bilik.owner = users.username WHERE bilik.dari <= '$harini' AND bilik.hingga >= '$harini'
                    ORDER BY bilik.dari ASC");
$bilik = $kuri->fetchAll(PDO::FETCH_ASSOC);

//DATA MINIT
$kuri = $PPD->query("SELECT minitsurat.id,minitsurat.tajuk,minitsurat.masaminit as tarikh,minitsurat.dahminit,users.realname,users.gambar
                    FROM minitkepada INNER JOIN minitsurat ON minitkepada.idsurat = minitsurat.id
                    INNER JOIN users ON minitsurat.oleh = users.username
                    WHERE minitkepada.pegawai = '$username' AND minitkepada.baca = 0 ORDER BY minitsurat.masaminit DESC");
$minit = $kuri->fetchAll(PDO::FETCH_ASSOC);

//DATA TAKWIM
$kuri = $PPD->query("SELECT takwim.id,takwim.tajuk,takwim.tempat,takwim.target,takwim.dari,users.realname,users.gambar
                    FROM takwim INNER JOIN users ON takwim.owner = users.username
                    WHERE takwim.dari <= '$harini' AND takwim.hingga >= '$harini' ORDER BY takwim.dari ASC");
$takwim = $kuri->fetchAll(PDO::FETCH_ASSOC);