<?php

    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");

$s_pengesah=$_SESSION['PENGESAH'];
$s_pengesahj=$_SESSION['PENGESAHJ'];
    if(!isset($_GET['id'])){
       // header('Location: senarai.php');
       // exit();
    }

    $id = htmlspecialchars($_GET['id']);

    $kuri = $PPD->prepare("SELECT * FROM icakna_senarai  WHERE ID = ? LIMIT 1");
    $kuri->execute([$id]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);

    $kuri = $PPD->query("SELECT * FROM `icakna_kat`");
    $kenya = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

    $kuri = $PPD->query("SELECT * FROM sts_jawatan ");
    $keny = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

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
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">DAFTAR</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first mt-3 mt-md-0">
            <div class="sticky-filter">
                <?php include 'proc/side-menu.php'; ?>
            </div>
        </div>
        <div class="col col-md order-first order-md-last">

                <form class="card-body form-ada-proses" id="form" action="/ppdkluang/cpanel/sekolah/icakna/proc/isi.php" method="POST">
<input type="hidden" name=page value="<?= $_GET['page'] ?>">
<input type="hidden" name=view value="<?= $_GET['view'] ?>">
                    <div class="form-group form-row">

                        <div class="col-6">
                            <label for="hingga">KRITERIA</label>
 <select  <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?>  name="krateria" id="kat" class="form-control">
    <option value="" >Sila Pilih</option>
                            <?php
                            foreach($kenya as $k=>$v){
                                echo'<option value="'.$k.'" '.($d['kreteria']==$k?'selected':'').'>'.$v.'</option>';
                            }
                            ?>
                        </select>
                        </div>

                        <div class="col-6">
                            <label for="hingga">KATEGORI PEGAWAI</label>
 <select  <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?>  name="kat" id="kat" class="form-control">
<option value="" >Sila Pilih</option>
<option value="guru" <?php if($d['kategori']=='guru') echo " selected=selected  "; ?> >GURU</option>
<option value="akp" <?php if($d['kategori']=='akp') echo "  selected=selected  "; ?> >AKP</option>
                        </select>
                        </div>

                        <div class="col-12">
                            <label for="mula">No K/P</label>
                            <input  <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?>  type="text" class="form-control" value="<?= $d['nama'] ?>" name="nokp">
                        </div>

                        <div class="col-12">
                            <label for="mula">NAMA GURU/PEGAWAI</label>
                            <input <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?>  type="text" class="form-control" value="<?= $d['nama'] ?>" name="nama">
                        </div>



                    </div>


                    <div class="form-group">
                        <label for="tajuk">KETERANGAN KESIHATAN</label>
                        <textarea  <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?>  name="keterangan" rows="4" class="form-control"><?= $d['keterangan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">NYATAKAN ISU/MASALAH YANG MENYEBABKAN PRESTASI TERJEJAS</label>
                       <textarea <?php if(isset($_GET['kodsekolah'])) echo " readonly=readonly "; ?> rows="4" name="isu" class="form-control"><?= $d['isu'] ?></textarea>
                    </div>

<?php if(isset($_GET['kodsekolah'])){
?>
              <div class="form-group">
                        <label for="lokasi">ULASAN KAUNSELOR</label>
                       <textarea  rows="4" name="isu" class="form-control"><?= $d['ulasankod'] ?></textarea>
                    </div>

<?php
}
   ?>   

                    <div class="text-center">
                       
                
 <button   class="btn btn-success" name="ulasan"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN ULASAN</button>


<script>
    function submitForm() {


}

var form = document.getElementById('form');
var submitButton = document.getElementById('submit-button');
var sendButton = document.getElementById('send-button');

submitButton.addEventListener('click', send);

function send(e) {
e.preventDefault();
 var isValid = true;
    if($("#jenama").val() == ''){

        isValid = false;

    }

        if($("#model").val() == ''){

        isValid = false;

    }
if(isValid==false) alert("Sila Lengkapkan Jenama/Model Peralatan");   
if(isValid==true) $('#modalRegisterForm').modal('show');

}



</script>




                    </div>






<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">SAHKAN</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">


        <div class="md-form mb-5">

                            <label for="hingga">RUJUKAN KEPADA KAUNSELOR PENDIDIKAN DAERAH?</label>
 <select  name="tindakan" id="kat" class="form-control">
<option value="" >Sila Pilih</option>
<option value="0" >HANYA MAKLUMAN</option>
<option value="1" >PERLU SESI KAUNSELING</option>
                        </select>
        </div>

        <div class="md-form mb-5">

                            <label for="hingga">JAWATAN PENDAFTAR</label>
 <select  name="pengisi" id="kat" class="form-control">
<option value="" >Sila Pilih</option>
<option value="GB" >GURU BESAR</option>
<option value="GPK" >GURU PENOLONG KANAN</option>
                        </select>
        </div>

      </div>



      <div class="modal-body mx-3">
        <div class="md-form mb-5">

          <label data-error="wrong" data-success="right" for="orangeForm-name">Saya mengesahakan <b>Maklumat Pegawai Tersebut</b> adalah tepat dan benar</label>
                    
        </div>



      </div>
      <div class="modal-footer d-flex justify-content-center">
<input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit" name='kemaskini' class="btn btn-success">DAFTAR</button>
      </div>
    </div>
  </div>
</div>

                </form>
                
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