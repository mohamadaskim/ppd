<?php
    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");

    if(isset($_GET['view'])){
        $view = htmlspecialchars($_GET['view']);
    } else {
        $view = 'primary';
    }

    if(isset($_GET['tahun'])){
        $tahunq = htmlspecialchars($_GET['tahun']);
    } else {
        $tahunq = date('Y');
    }

    if(isset($_GET['page'])){
        $page = htmlspecialchars($_GET['page']);
        $offset = (htmlspecialchars($_GET['page'])*20)-20;
    } else {
        $offset = 0;
        $page = 1;
    }

    $sektor = '%%';
    $pegawai = '%%';
    $tahun = '%'.$tahunq.'%';
    $edaran = '%%';
    $keyword = '%%';
    
    if($view=='primary'){
        $baca = '=';
    } else if($view=='telahbaca') {
        $baca = '<>';
    } else if($view=='search') {
        $sektor = ($_GET['sektor']=='all'?'%%':'%'.$_GET['sektor'].'%');
        $pegawai = ($_GET['pegawai']==''?'%%':'%'.$_GET['pegawai'].'%');
        $tahun = ($_GET['tahun']=='all'?'%%':'%'.$_GET['tahun'].'%');
        $keyword = ($_GET['keyword']==''?'%%':'%'.$_GET['keyword'].'%');
    } else if($view=='edaran') {
        $edaran = '%'.$_GET['edaran'].'%';
        $tahun = '%%';
    }

    if($view=='primary'||$view=='telahbaca'){
        include 'proc/query-normal.php';
    } else if($view=='pkp') {
        include 'proc/query-pkp.php';
    } else {
        include 'proc/query-search.php';
    }
    
    $jumpage = ceil($kaun/20);

    $kuri = $PPD->prepare("SELECT COUNT(*) AS bil FROM sts2020 WHERE kodsekolah = ? ");
    $kuri->execute([USER]);
    $xbaca = $kuri->fetch(PDO::FETCH_ASSOC)['bil'];
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
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">SENARAI PERMOHONAN STS SEKOLAH <br>(Permohonan Penyelenggaraan ICT Sekolah)</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first mt-3 mt-md-0">
            <div class="sticky-filter">
                <?php include 'proc/side-menu.php'; ?>
            </div>
        </div>
        <div class="col col-md order-first order-md-last">

                <form class="card-body form-ada-proses" action="cpanel/egerak/proc/isi.php" method="POST">
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label for="mula">MULA</label>
                            <input type="mula" class="form-control" value="<?= $d['kodsekolah'] ?>" name="mula">
                        </div>
                        <div class="col-6">
                            <label for="hingga">HINGGA</label>
                            <input type="hingga" class="form-control" value="<?= myDate($d['enddate']) ?>" name="hingga">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="masa">MASA</label>
                        <div>
                            <?php foreach($masal as $m){ ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="<?= $m ?>" name="masa" class="custom-control-input" value="<?= $m ?>" <?= ($d['masa']==$m?'checked':'') ?> required>
                                <label class="custom-control-label" for="<?= $m ?>"><?= ucwords($m) ?></label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kat">KATEGORI</label>
                        <select name="kat" id="kat" class="form-control">
                            <?php
                            foreach($keny as $k=>$v){
                                echo'<option value="'.$k.'" '.($d['kategori']==$k?'selected':'').'>'.$v.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tajuk">PROGRAM/AKTIVITI</label>
                        <input type="text" class="form-control" name="tajuk" value="<?= $d['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">LOKASI</label>
                        <input type="text" class="form-control" name="lokasi" value="<?= $d['location'] ?>">
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-back btn-secondary"><i class="fa fa-undo" aria-hidden="true"></i> KEMBALI</button>
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" class="btn btn-success" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i> KEMASKINI</button>
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