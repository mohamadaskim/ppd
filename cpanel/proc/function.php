<?php
$jminit = ['Pegawai Pendidikan Daerah','Timbalan PPD Perancangan','Timbalan PPD Pembelajaran','Timbalan PPD Pengurusan Sekolah','Timbalan PPD Pembangunan Murid'];
$jcetak = ['720602015978','750422015038','810827016241','651003016454'];

define('NOW',$now = date("Y-m-d H:i:s"));

function shortName($i) {
    if(strpos($i,'SEKOLAH KEBANGSAAN')!== false) {
        return str_replace('SEKOLAH KEBANGSAAN','SK',$i);
    } elseif(strpos($i,'SEKOLAH JENIS KEBANGSAAN (CINA)')!== false) {
        return str_replace('SEKOLAH JENIS KEBANGSAAN (CINA)','SJK(C)',$i);
    } elseif(strpos($i,'SEKOLAH JENIS KEBANGSAAN (TAMIL)')!== false) {
        return str_replace('SEKOLAH JENIS KEBANGSAAN (TAMIL)','SJK(T)',$i);
    } elseif(strpos($i,'SEKOLAH MENENGAH KEBANGSAAN')!== false) {
        return str_replace('SEKOLAH MENENGAH KEBANGSAAN','SMK',$i);
    } elseif(strpos($i,'SEKOLAH MENENGAH')!== false) {
        return str_replace('SEKOLAH MENENGAH','SM',$i);
    } elseif(strpos($i,'SEKOLAH RENDAH')!== false) {
        return str_replace('SEKOLAH RENDAH','SR',$i);
    } else {
        return $i;
    }
}

function fullDate($i){
    $d = date('d',strtotime($i));
    $m = date('m',strtotime($i));
    $y = date('Y',strtotime($i));

    return $d.' '.myMonthName($m).' '.$y;
}
function myDate($i){
    return date('d/m/Y',strtotime($i));
}

function myTime($i){
    return date('h:iA',strtotime($i));
}

function myMonth($i){
    return date('m',strtotime($i));
}

function myDateNum($i){
    return date('d',strtotime($i));
}

function myDate2us($i){
    $old = explode('/',$i);
    return $old[2].'-'.$old[1].'-'.$old[0];
}

function myMonthName($i){
    if($i==1)
        return 'Januari';
    else if($i==2)
        return 'Februari';
    else if($i==3)
        return 'Mac';
    else if($i==4)
        return 'April';
    else if($i==5)
        return 'Mei';
    else if($i==6)
        return 'Jun';
    else if($i==7)
        return 'Julai';
    else if($i==8)
        return 'Ogos';
    else if($i==9)
        return 'September';
    else if($i==10)
        return 'Oktober';
    else if($i==11)
        return 'November';
    else if($i==12)
        return 'Disember';
    else
        return 'Tiada Bulan';
}

$sectcolor = [
    'Sektor Pengurusan Sekolah'=>'primary',
    'Sektor Perancangan'=>'danger',
    'Sektor Pembelajaran'=>'success',
    'Sektor Pengurusan'=>'info',
    'Sektor Pembangunan Murid'=>'warning',
    'Pegawai Pendidikan Daerah'=>'teal',
    'Kaunselor Pendidikan Daerah'=>'maroon',
    'Penilaian & Peperiksaan'=>'olive',
    ''=>'secondary'
];

require_once $_SERVER['DOCUMENT_ROOT']."/ppdkluang/htmlpurifier/HTMLPurifier.auto.php";
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

function presBar($i){
    if($i<40){
        $o = 'danger';
    } elseif ($i>=40 && $i<60) {
        $o = 'warning';
    } elseif ($i>=60 && $i<90) {
        $o = 'primary';
    } else {
        $o = 'success';
    }
    return $o;
}

function compressPic($sumber,$folder,$width){
    $source_image = imagecreatefromjpeg($sumber);
    $source_imagex = imagesx($source_image);
    $source_imagey = imagesy($source_image);
    $dest_imagex = $width;
    $dest_imagey = round($source_imagey*($dest_imagex/$source_imagex));
    $dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
    imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, 
    $dest_imagey, $source_imagex, $source_imagey);
    if(imagejpeg($dest_image,$folder,80)){
        return true;
    } else {
        return false;
    }
}

function hariDate($i){
    if($i==1){
        $o = 'isnin';
    } elseif ($i==2) {
        $o = 'selasa';
    } elseif ($i==3) {
        $o = 'rabu';
    } elseif ($i==4) {
        $o = 'khamis';
    } elseif ($i==5) {
        $o = 'jumaat';
    } elseif ($i==6) {
        $o = 'sabtu';
    } elseif ($i==7) {
        $o = 'ahad';
    } else {
        $o = 'hari tidak valid';
    }
    return $o;
}