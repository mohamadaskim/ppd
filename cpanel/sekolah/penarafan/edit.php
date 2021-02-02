<?php

    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");


   // $id = htmlspecialchars($_GET['id']);


//include 'proc/query-normal.php';
$kat=1;
if(isset($_GET['kat'])) $kat=$_GET['kat'];
$sql="SELECT * FROM `penarafan_perkara` where kategori=$kat";
if(isset($_GET['id'])) $sql="SELECT * FROM `penarafan_perkara` p inner join `penarafan_data` d on d.perkara_id=p.ID WHERE kodsekolah=? and `data_id` ='$_GET[id]'";
$kuri = $PPD->prepare($sql);
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);

    $kuri = $PPD->prepare("SELECT * FROM `penarafan_bulan`  WHERE kodsekolah = ? order by ID desc LIMIT 1 ");
    $kuri->execute([USER]);
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
$dat.= '>Ada (Mematuhi)</option>';
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
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">INSTRUMEN PEMATUHAN DASAR (PENARAFAN BINTANG) <br>INSTITUSI PENDIDIKAN SWASTA </h3>
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

                        <div class="col-4">
                            <label for="hingga">TARIKH / MASA</label>
<input type="datetime-local" required class="form-control" name='tarikh' value="19/01/2021 12:20 AM" >
                        </div>


                        <div class="col-8">
                            <label for="hingga">NAMA PEGAWAI PEMERIKSA</label>
<input type="text" required class="form-control" name='pegawai' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                         <div class="col-4">
                            <label for="hingga">NAMA INSTITUSI</label>
<input type="text" required class="form-control" name='namainstitusi' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                        <div class="col-8">
                            <label for="hingga">ALAMAT INSTITUSI</label>
<input type="text" required class="form-control" name='alamatinstitusi' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                        <div class="col-2">
                            <label for="hingga">DAERAH</label>
<input type="text" required class="form-control" name='daerah' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-2">
                            <label for="hingga">NEGERI</label>
<input type="text" required class="form-control" name='negeri' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-4">
                            <label for="hingga">NO TELEFON</label>
<input type="text" required class="form-control" name='telefon' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-4">
                            <label for="hingga">EMAIL</label>
<input type="email" required class="form-control" name='email' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-5">
                            <label for="hingga">NAMA PENGERUSI</label>
<input type="text" required class="form-control" name='namapengerusi' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-2">
                            <label for="hingga">KAUM</label>
<input type="text" required class="form-control" name='kaum' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-5">
                            <label for="hingga">LOKASI</label>
<input type="text" required class="form-control" name='lokasi' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-4">
                            <label for="hingga">NAMA GURU BESAR</label>
<input type="text" required class="form-control" name='namagb' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div> 
                        <div class="col-2">
                            <label for="hingga">BIL MURID LELAKI</label>
<input type="text" required class="form-control" name='ml' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga"><small>BIL MURID PEREMPUAN</small></label>
<input type="text" required class="form-control" name='mp' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga">BIL GURU LELAKI</label>
<input type="text" required class="form-control" name='gl' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga">BIL GURU PEREMPUAN</label>
<input type="text" required class="form-control" name='gp' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>


       </div>
                        <br>
<table class="table table-striped my-lh-1 text-center mb-0" >
            <thead class="bg-warning text-light">
                <tr>
                    <th  class="d-none d-md-table-cell">#</th>
                    <th >PERKARA</th>
                    <th ></th>
<th ></th>
                </tr>
               
            </thead>
            <tbody>

<?php



         $x=0;
         $submenushow='';
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
$submenu=htmlspecialchars($s['kat_tajuk']);
                    include 'proc/kad-style.php';

                } ?>


                </tbody>
        </table>








                    <div class="text-center">
                    <a href="/ppdkluang/cpanel/sekolah/ict/<?php echo $view.$page; ?>"  ><button type="button" class="btn btn-back btn-secondary"><i class="fa fa-undo" aria-hidden="true"></i> KEMBALI</button></a>    

 <button  type="submit" class="btn btn-success" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN & CETAK</button>

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