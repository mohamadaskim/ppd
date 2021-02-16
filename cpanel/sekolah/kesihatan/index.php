

<?php

    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");

$_SESSION['redir']=$_SERVER['REQUEST_URI'];
    $id = htmlspecialchars($_GET['id']);


include 'proc/query-normal.php';


 $sql="SELECT p.*, `data_id`, `perkara_id`, `v2018`, `v2019`, `v2020` FROM `kesihatan_perkara` p left join `kesihatan_data` d on d.perkara_id=p.ID and d.kodsekolah=?";
$kuri = $PPD->prepare($sql);
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);




    $view = $_GET['view'];
$page = "?page=".$_GET['page'];


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scriptable &gt; Line | Chart.js sample</title>

    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>




<div class="main">
    <img src="/ppdkluang/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">BILANGAN PEGAWAI YANG MENGGUNAKAN KEMUDAHAN CUTI KUARANTIN MENGIKUT JENIS PENYAKIT MENGIKUT TAHUN 2018-2020<br>PEJABAT PENDIDIKAN DAERAH KLUANG</h3>
    <div class="row mt-3">

        <div class="col col-md order-first order-md-last">




                <form class="card-body form-ada-proses" id="form" action="/ppdkluang/cpanel/sekolah/kesihatan/proc/isi.php" method="GET">
<!--<input type="hidden" name=page value="<?= $_GET['page'] ?>">
<input type="hidden" name=view value="<?= $_GET['view'] ?>">
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


       </div>
                        <br>
<table class="table table-striped my-lh-1 text-center mb-0" >
            <thead class="bg-warning text-light">
                <tr>
                    <th rowspan="2" class="d-none d-md-table-cell">#</th>
                    <th rowspan="2">JENIS PENYAKIT</th>
                    <th colspan=5>TAHUN</th>
                </tr>
                <tr>


                    <th >2018</th>
                    <th>2019</th>
                    <th>2020</th>

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

if(isset($s['data_id']))
{
$v2018 = htmlspecialchars($s['v2018']);
$v2019 = htmlspecialchars($s['v2019']);
$v2020 = htmlspecialchars($s['v2020']);

//$dataulasan = htmlspecialchars($s['ulasan']);
}

$dataid=$x;
                    include 'proc/kad-style.php';

                } ?>


                </tbody>
        </table>








                    <div class="text-center">

                    <a href="https://ppdkluang.edu.my/" ><button type="button" class="btn btn-back btn-secondary"><i class="fa fa-undo" aria-hidden="true"></i> KEMBALI</button></a>    
<?php if(isset($s['data_id'])  && $s['data_id']!='') { ?><input type="hidden"  name="id" value="<?=  $s['data_id']; ?>"> <button  type="submit" class="btn btn-success" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i> KEMASKINI</button> <?php } else { ?>  <button  type="submit" class="btn btn-success" name="insert"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN</button><?php } ?>



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