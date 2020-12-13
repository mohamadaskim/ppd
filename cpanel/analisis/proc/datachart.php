<?php
require($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/auth.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/function.php");
include($_SERVER['DOCUMENT_ROOT']."/cpanel/proc/pegawai.php");

function persen($i,$jum){
    if($i){
        return round($i/$jum*100);
    } else {
        return 0;
    }
}
function groupBy($key, $data) {
    $result = array();
    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }
    return $result;
}
$kaler = ["#FF4136", "#B10DC9","#0074D9","#2ECC40","#FFDC00","#111111"];

if(isset($_POST['cartamb'])){

    $sektor = htmlspecialchars($_POST['cartamb']);
    $tahun = htmlspecialchars($_POST['tahun']);
    $bulan = htmlspecialchars($_POST['bulan']);

    if($sektor!='all'){
        $tapis1 = "AND sektor = '{$sektor}'";
    } else {
        $tapis1 = '';
    }

    $quaterly = ['Jan-Mac'=>"'1','2','3'",'Apr-Jun'=>"'4','5','6'",'Jul-Sept'=>"'7','8','9'",'Okt-Dis'=>"'10','11','12'",];

    if($bulan=='all'){
        for($b=1;$b<=12;$b++){
            $kuri = $PPD->query("SELECT skor,COUNT(skor) AS bil FROM mbp WHERE YEAR(masa) = '{$tahun}' AND MONTH(masa) = '{$b}' {$tapis1} GROUP BY skor ORDER BY skor ASC");
            $raw = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);
            $jum = array_sum($raw);
            $datachart['Tidak Memuaskan'][] = persen($raw[1]??0,$jum);
            $datachart['Memuaskan'][] = persen($raw[2]??0,$jum);
            $datachart['Baik'][] = persen($raw[3]??0,$jum);
            $datachart['Cemerlang'][] = persen($raw[4]??0,$jum);
        }
    } else {
        foreach($quaterly as $k=>$q){
            $kuri = $PPD->query("SELECT skor,COUNT(skor) AS bil FROM mbp WHERE YEAR(masa) = '{$tahun}' AND MONTH(masa) IN ({$q}) {$tapis1} GROUP BY skor ORDER BY skor ASC");
            $raw = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);
            $jum = array_sum($raw);
            $datachart['Tidak Memuaskan'][] = persen($raw[1]??0,$jum);
            $datachart['Memuaskan'][] = persen($raw[2]??0,$jum);
            $datachart['Baik'][] = persen($raw[3]??0,$jum);
            $datachart['Cemerlang'][] = persen($raw[4]??0,$jum);
        }
    }
}

if(isset($_POST['cartaminit'])){
    $tapis = htmlspecialchars($_POST['cartaminit']);
    $tahun = htmlspecialchars($_POST['tahun']);

    if($tapis=='sektor'){
        $field = 'users.sektor';
    } else {
        $field = 'MONTH(minitsurat.masaminit)';
    }
    $kuri = $PPD->query("SELECT {$field} as tapis,minitkepada.baca,COUNT(*) as bil FROM minitkepada
                        INNER JOIN minitsurat ON minitkepada.idsurat = minitsurat.id
                        INNER JOIN users ON minitkepada.pegawai = users.username
                        WHERE YEAR(minitsurat.masaminit) = '{$tahun}' GROUP BY {$field},minitkepada.baca");
    $raw = $kuri->fetchAll(PDO::FETCH_ASSOC);

    foreach($raw as $r){
        if($r['tapis']!=''&&$r['tapis']!='Pegawai Pendidikan Daerah'){
            $dat[$r['tapis']][$r['baca']] = $r['bil'];
        }
    }

    foreach($dat as $k=>$v){
        $labels[] = ($tapis=='bulan'?myMonthName($k):$k);
        $baca[] = $v[1]??0;
        $xbaca[] = $v[0]??0;
    }

    $datachart = [
        [
            'label'=>'Telah baca',
            'backgroundColor' => '#2ECC40',
            'data' => $baca
        ],
        [
            'label'=>'Belum baca',
            'backgroundColor' => '#FF4136',
            'data' => $xbaca
        ],
        $labels
    ];   
}

header('Content-Type: application/json');
echo json_encode($datachart);