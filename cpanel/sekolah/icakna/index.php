

<?php


    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");
$_SESSION['redir']=$_SERVER['REQUEST_URI'];

   $view = '1';

if(isset($_POST['kemaskini'])){

    $status=$_POST['user_id'];
$pengisi=$_POST['pengisi'];
 $kuri = $PPD->prepare("INSERT INTO `icakna_status`( `kodsekolah`, `status`, `daripada`) VALUES (?, ?, ?) on duplicate key update status=values(status),daripada=values(daripada)");
$kuri->execute([USER,$status,$pengisi]);   
}

    
$kuri = $PPD->prepare("SELECT * FROM `sts_dapat` where kodsekolah=? ");
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);


    $kuri = $PPD->prepare("SELECT status  FROM icakna_status s  WHERE s.kodsekolah = ? ");
    $kuri->execute([USER]);
    $status = $kuri->fetch(PDO::FETCH_ASSOC)['status'];
    if(isset($_SESSION['KOD'])&&$_SESSION['KOD']==1){

    }
    else
    {
   ?>
   <script>
    var popup = prompt("Password Kaunseling Daerah : ");
    if(popup =='KOD'){
<?php $_SESSION['KOD']=1; ?>
    }
    else
    {
        alert("Tiada Akses");
window.location.href='../index.php';


    }
</script>
   <?php     
    }
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
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">iCakna<br>(Aplikasi Rujukan Kesihatan Klien)</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first mt-3 mt-md-0">
            <div class="sticky-filter">
                <?php include 'proc/side-menu.php'; ?>
            </div>
        </div>
        <div class="col col-md order-first order-md-last">
   <center>         
<h5 class="card mt-4 font-weight-bold p-2 text-center bg-info text-light ">Sistem iCakna</h5>Sistem iCakna dibangunkan untuk mengumpul maklumat guru/staf daerah Kluang yang mempunyai masalah kesihatan.  Masalah kesihatan yang dirujuk adalah masalah kesihatan yang kritikal, menyebabkan cuti sakit berpanjangan dan mengganggu prestasi kerja.
<br><br>
Adakah sekolah tuan/puan mempunyai warga yang bermasalah kesihatan seperti di atas?
<br><br>

<br>
    <?php if($status==1 || $status==''){ ?> <a data-toggle="modal" data-userid="1" data-target="#modalRegisterForm"><button  id="submit-button" class="btn btn-success" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i>ADA</button></a><?php } ?>
    <?php if($status==0 || $status==''){ ?><a data-toggle="modal" data-userid="0" data-target="#modalRegisterForm"><button  id="submit-button" class="btn btn-danger" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i>TIADA</button></a><?php } ?>

</center>
 

        </div>
    </div>
</div>
<input type="hidden" id="status" value="<?= $_GET['status']??'no' ?>">

<form method="post">

<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">PENGESAHAH STATUS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

<input type="hidden" name="user_id" value="3">


        <div class="md-form mb-5">

                            <label for="hingga">JAWATAN PENGESAH</label>
 <select  name="pengisi" id="kat" class="form-control">
<option value="" >Sila Pilih</option>
<option value="GB" >GURU BESAR</option>
<option value="GPK" >GURU PENOLONG KANAN</option>
                        </select>
        </div>

      </div>




      <div class="modal-footer d-flex justify-content-center">

        <button type="submit" name='kemaskini' class="btn btn-success">SAHKAN</button>
      </div>
    </div>
  </div>
</div>
</form>


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
$('#modalRegisterForm').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('userid');
    $(e.currentTarget).find('input[name="user_id"]').val(userid);
});
    </script>




  </body>

</html>