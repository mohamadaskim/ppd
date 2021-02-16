<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");




if(isset($_GET['insert'])){

//$syarikat=$_GET['syarikat'];
//$tempoh_mula=$_GET['tempoh_mula'];
//$tempoh_tamat=$_GET['tempoh_tamat'];
//$enrolmen=$_GET['enrolmen'];
//$zon=$_GET['zon'];
$sql = "INSERT INTO `kesihatan_bulan`( `kodsekolah`, `tarikh`) VALUES (?,NOW())";
$kuri = $PPD->prepare($sql);
$kuri->execute([USER]);
$id = $PPD->lastInsertId();

    $x=0;
    $insert='';
 foreach($_GET['data2018'] as $s){
$x++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$insert.= '("'.USER.'",'.$id.','.$_GET['dataid'][$x].','.$_GET['data2018'][$x].','.$_GET['data2019'][$x].','.$_GET['data2020'][$x].'),';
 }

 $insert=rtrim($insert,',');
//echo $insert.'<br>';

//$x=0;
//$aktiviti_murid = [];
            //    foreach($_GET['data'] as $key => $value)
             //   {
              //      $x++;
               //     $aktiviti_murid[] = [
               //         'kodsekolah' => USER,

               //     ];
              //  }

//echo json_encode($aktiviti_murid);



$sql = "INSERT INTO kesihatan_data ( `kodsekolah`, `data_id`,`perkara_id`, `v2018`, `v2019`, `v2020`) VALUES ".$insert;



    $kuri = $PPD->prepare($sql);

    //$kuri->bindValue(':kodsekolah', USER);
    if($kuri->execute()){
        ?>
<script>alert("Rekod Disimpan");
window.location.href='../index.php';
</script>

<?php
        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    } else {
       // header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        exit();
    }
}





if(isset($_GET['kemaskini'])){

//$syarikat=$_GET['syarikat'];
//$tempoh_mula=$_GET['tempoh_mula'];
//$tempoh_tamat=$_GET['tempoh_tamat'];
//$enrolmen=$_GET['enrolmen'];
//$zon=$_GET['zon'];

$id = $_GET['id'];
$kuri = $PPD->prepare("DELETE FROM `kesihatan_data` WHERE `kodsekolah`=? and `data_id` =?");
$kuri->execute([USER,$id]);
    $x=0;
    $insert='';
 foreach($_GET['data2018'] as $s){
$x++;
//echo $x.'-'.$_GET['data'][$x].'- data-'.$s.'<br>';
$insert.= '("'.USER.'",'.$id.','.$_GET['dataid'][$x].','.$_GET['data2018'][$x].','.$_GET['data2019'][$x].','.$_GET['data2020'][$x].'),';
 }

 $insert=rtrim($insert,',');
//echo $insert.'<br>';

//$x=0;
//$aktiviti_murid = [];
            //    foreach($_GET['data'] as $key => $value)
             //   {
              //      $x++;
               //     $aktiviti_murid[] = [
               //         'kodsekolah' => USER,

               //     ];
              //  }

//echo json_encode($aktiviti_murid);



$sql = "INSERT INTO kesihatan_data ( `kodsekolah`, `data_id`,`perkara_id`, `v2018`, `v2019`, `v2020`) VALUES ".$insert;



    $kuri = $PPD->prepare($sql);

    //$kuri->bindValue(':kodsekolah', USER);
    if($kuri->execute()){
        ?>
<script>alert("Kemaskini Berjaya");
window.location.href='../index.php';
</script>

<?php
        if(isset($_GET['bulan'])){
            //header('Location: ../senarai.php?bulan='.$bulan.'&tahun='.$tahun);
        } else {
            //header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        }
        exit();
    } else {
       // header('Location: ../senarai.php?bulan='.$a[1].'&tahun='.$a[2]);
        exit();
    }
}





