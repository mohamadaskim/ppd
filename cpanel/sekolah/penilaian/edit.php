<?php

    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");





//include 'proc/query-normal.php';
$kat=1;
if(isset($_GET['kat'])) $kat=$_GET['kat'];

$sql="SELECT * FROM `penilaian_perkara` where kategori=$kat";
if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql="SELECT * FROM `penilaian_perkara` p inner join `penilaian_data` d on d.perkara_id=p.ID inner join penilaian_bulan b on b.ID=d.data_id WHERE b.kodsekolah=? and d.`data_id` ='$id' and b.kategori= '$_GET[kat]'";

}
$kuri = $PPD->prepare($sql);
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

    $kuri = $PPD->prepare("SELECT * FROM `penilaian_bulan`  WHERE kodsekolah = ? and kategori = ?order by ID desc LIMIT 1 ");
    $kuri->execute([USER,$_GET['kat']]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);

  //  $kuri = $PPD->prepare("SELECT * FROM `penilaian_perkara` p inner join `penilaian_data` d on d.perkara_id=p.ID WHERE kodsekolah='JBD2047' and `data_id` = 7");
  //  $kuri->execute([USER,$d['ID']]);
 //$dedit= $kuri->fetch(PDO::FETCH_ASSOC);



    $kuri = $PPD->query("SELECT kategori,kategori FROM `sts2020` group by kategori");
    $kenya = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

    $kuri = $PPD->query("SELECT * FROM sts_jawatan ");
    $keny = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

  //  $view = $_GET['view'];
//$page = "?page=".$_GET['page'];



function option1($id){


$dat="";
$dat.= '  <option>Sila Pilih</option>';
$dat.= '  <option ';
if($id=='1') $dat.= ' selected=selected ';
$dat.= ' value="1" ';
$dat.= '>Ada</option>';
$dat.= '  <option ';
if($id=='0') $dat.= ' selected=selected ';
$dat.= ' value="0" ';
$dat.= '>Tiada</option>';


return $dat;
}

function option2($id){

$dat="";
$dat.= '  <option>Sila Pilih</option>';
$dat.= '  <option ';
if($id=='1') $dat.= ' selected=selected ';
$dat.= ' value="1" ';
$dat.= '>Perkhidmatan diteruskan</option>';
$dat.= '  <option ';
if($id=='0') $dat.= ' selected=selected ';
$dat.= ' value="0" ';
$dat.= '>Perkhidmatan ditamatkan</option>';

return $dat;

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>




<div class="main">
    <img src="/ppdkluang/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">PENILAIAN SYARIKAT <br>(KEBERSIHAN DAN KESELAMATAN)</h3>
    <div class="row mt-3">

        <div class="col col-md order-first order-md-last">




                <form class="card-body form-ada-proses" id="form" action="/ppdkluang/cpanel/sekolah/penilaian/proc/isi.php" method="GET">
<input type="hidden" name=kat value="<?= $_GET['kat'] ?>">
<!--<input type="hidden" name=view value="<?= $_GET['view'] ?>">
-->
<!--<form>
<div class="form-group form-row">

                        <div class="col-6">
                            <label for="hingga">KATEGORI DINILAI</label>
 <select  name="kat" id="kat" class="form-control" onchange='this.form.submit()'>
<option value= >Pilih Syarikat</option>
<option value=1 >KEBERSIHAN</option>
<option value=2 >KESELAMATAN</option>
                        </select>
                        </div>


       </div>
</form>-->

<div class="form-group form-row">

                        <div class="col-12">
                            <label for="hingga">TARIKH PENILAIAN</label>
<input type="date" required class="form-control" name='tarikh' value="<?php echo date("Y-m-d"); ?>" >
                        </div>


                        <div class="col-12">
                            <label for="hingga">NAMA SYARIKAT</label>
<input type="text" required class="form-control" name='syarikat' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                        <div class="col-6">
                            <label for="hingga">MULA KONTRAK</label>
<input type="date" required class="form-control" name='tempoh_mula' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-6">
                            <label for="hingga">TAMAT KONTRAK</label>
<input type="date" required class="form-control" name='tempoh_tamat' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>



                        <div class="col-6">
                            <label for="hingga">ENROLMEN MURID SEMASA</label>
<input type="text" required class="form-control" name='enrolmen' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-6">
                            <label for="hingga">ZON </label>
<input type="text" class="form-control" name='zon' value="<?php if(isset($d['zon'])) echo $d['zon']; ?>" >
                        </div>

       </div>
                        <br>
<table class="table table-striped my-lh-1 text-center mb-0" >
            <thead class="bg-warning text-light">
                <tr>
                    <th rowspan="2" class="d-none d-md-table-cell">#</th>
                    <th rowspan="2">PERKARA</th>
                    <th colspan=5>SKOR PENILAIAN</th>
                </tr>
                <tr>


                    <th >1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>

<?php
         $x=0;
                foreach($surat as $s){
$x++;
                    $tajuk = htmlspecialchars($s['tajuk']);
                    $radio = htmlspecialchars($s['radio']);

$name = htmlspecialchars($s['ID']);
$data = htmlspecialchars($s['data']);
if(isset($s['value']))
{$datavalue = htmlspecialchars($s['value']);
$dataulasan = htmlspecialchars($s['ulasan']);
}
$dataid=$x;
                    include 'proc/kad-style.php';

                } ?>


                </tbody>
        </table>








                    <div class="text-center">
                        <?php if(isset($id)){ ?> <button type="submit"  class="btn btn-success" name="kemaskini" value="<?php echo $id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> KEMASKINI</button> 
                        <a  class="btn btn-danger" href="proc/isi.php?buang=<?php echo $id; ?>" >
                    
                                <i class="fa fa-pencil" ></i> PADAM
            
                        </a>
                    <?php } else { ?>  <button type="submit"  class="btn btn-success" name="simpan"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN dan CETAK</button><?php } ?>

</form>




                 








                </div>

        </div>
    </div>
</div>
<input type="hidden" id="status" value="<?= $_GET['status']??'no' ?>">

<!-- START FOOTER -->
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

        let stat = $('#status').val();
        if(stat!='no'){
            if(stat=='unread'){alert('Surat telah ditetapkan kepada status belum baca. Bil baca dan bil muat turun telah ditetapkan semula kepada 0.');}
            window.location.replace("cpanel/sekolah/inbox/");
        }
        $('#btn-cari').click(function(e){
            let a = $('#keyword').val();
            let b = $('#pegawai').val();
            let c = $('#tapis-tahun').val();
            let d = $('#sektor').val();
            if(a==''&&b==''&&c=='all'&&d=='all'){
                alert('Sila isi sekurang-kurangnya carian kata kunci atau pegawai, atau buat pilihan sektor atau tahun.');
                e.preventDefault();
            }
        })
    </script>






  </body>

</html> 