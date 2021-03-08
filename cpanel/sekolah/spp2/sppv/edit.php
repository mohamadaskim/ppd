<?php

    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");

//$s_pengesah=$_SESSION['PENGESAH'];
//$s_pengesahj=$_SESSION['PENGESAHJ'];
    if(!isset($_GET['id'])){
       // header('Location: senarai.php');
       // exit();
    }



if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);

    $kuri = $PPD->prepare("SELECT s.* FROM `spp` s left join spp_jawatan j on j.kod=s.jawatan WHERE s.ID = ? and s.kodsekolah = ?  LIMIT 1");
    $kuri->execute([$id,USER]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);

    $view = $_GET['view'];
$page = "?page=".$_GET['page'];

}
else
{
        $kuri = $PPD->prepare("SELECT s.namapegawai,s.jawatan FROM `spp` s left join spp_jawatan j on j.kod=s.jawatan WHERE s.kodsekolah = ? order by timestamp desc LIMIT 1");
    $kuri->execute([USER]);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);
}
    $kuri = $PPD->query("SELECT * FROM `spp_bulan`");
    $kenya = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

    $kuri = $PPD->query("SELECT * FROM sts_jawatan ");
    $keny = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);




?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}

</style></head>




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





                <form class="card-body form-ada-proses" id="form" action="/ppdkluang/cpanel/sekolah/spp2/proc/isi.php" method="POST">
<input type="hidden" name=page value="<?= $_GET['page'] ?>">
<input type="hidden" name=view value="<?= $_GET['view'] ?>">












                    <div class="form-group form-row">

                        <div class="col-6">
                            <label for="hingga">TARIKH</label>
<input type="date" required class="form-control" name='tarikh' value="<?= $d['tarikh'] ?>">
                        </div>



                        <div class="col-6">
                            <label for="hingga">JAWATAN</label>
<select  required name="jawatan" id="kat" class="form-control">
                        <option value=''>Sila Pilih</option>
                            <?php
                            if($d['jawatan']=='') {$val=$s_pengesahj;} else {$val=$d['jawatan'];}
                            foreach($keny  as $k=>$v){
                                echo'<option value="'.$k.'" '.($val==$k?'selected':'').'>'.$v.'</option>';
                            }
                            ?>
                        </select>
                        </div>





                    </div>

                    <div class="form-group form-row">

                        <div class="col-12">
                            <label for="hingga">NAMA PEGAWAI</label>
<input type="text" required class="form-control" name='namapegawai' value="<?php if(isset($d['namapegawai'])) echo $d['namapegawai']; ?>">
                        </div>









                    </div>
                    <div class="form-group  form-row">
                       

<?php

  for($i=1;$i<=$_SESSION['talian'];$i++){
    ?>
                            <div class="col-3">
                           <label for="hingga">PERANTI DOWNLOAD <?php echo $i; ?> (mb/s)</label>
 <input type="text" required placeholder="Contoh : 10.16" class="form-control"  name="peranti[]" value="<?php if(isset($d['v'.$i])) echo $d['v'.$i]; ?>">

                        </div>
                                                    <div class="col-3">
                           <label for="hingga">PERANTI UPLOAD <?php echo $i; ?> (mb/s)</label>
 <input type="text"  required placeholder="Contoh : 10.16" class="form-control"  name="perantiu[]" value="<?php if(isset($d['u'.$i])) echo $d['u'.$i]; ?>">

                        </div>
                         <div class="col-6">

                        <label for="tajuk">CATATAN</label>
                        <textarea   name="catatan[]" rows="2" class="form-control"><?php if(isset($d['catatan'.$i])) echo $d['catatan'.$i]; ?></textarea>

                        </div>
    <?php
} ?>

<?php

?>




                    </div>

                    <div class="form-group">

                    </div> 


                    <div class="text-center">
   
                

                        <?php if(isset($id)){ ?> <button type="submit"  class="btn btn-success" name="kemaskini" value="<?php echo $id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> KEMASKINI</button> 
                        <a  class="btn btn-danger" href="proc/isi.php?buang=<?php echo $id; ?>" >
                    
                                <i class="fa fa-pencil" ></i> PADAM
            
                        </a>
                    <?php } else { ?>  <button type="submit"  class="btn btn-success" name="simpan"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN dan CETAK</button><?php } ?>


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