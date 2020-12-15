<?php
    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");


        $view = '2';


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

    if($view=='2'||$view=='telahbaca'){
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

<table class="table table-striped my-lh-1 text-center mb-0">
            <thead class="bg-warning text-light">
                <tr>
                    <th class="d-none d-md-table-cell">#</th>
                    <th>TARIKH</th>
                    <th>NO KEWPA / DAFTAR HARTA MODAL</th>
                    <th>KATEGORI PERALATAN</th>
                    <th>TAHUN PEROLEHAN</th>
                    <th style="width:5%">TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
<?php
         $x=$offset;
                foreach($surat as $s){
$x++;
                    $id = htmlspecialchars($s['ID']);
                    $kewpa = htmlspecialchars($s['kewpa']);
                    $kategori = htmlspecialchars($s['kategori']);
                    $tahunperolehan = htmlspecialchars($s['tahunperolehan']);
                   $tarikh = htmlspecialchars($s['tarikh']);
                   $sahkan = htmlspecialchars($s['pegawai']);
                    include 'proc/kad-style.php';
                    
                } ?>

                </tbody>
        </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center flex-wrap">
                        <?php
                        $f1 = (isset($_GET['view'])?'view='.$_GET['view']:'view=primary');
                        $f2 = (isset($_GET['edaran'])?'&edaran='.$_GET['edaran']:'');
                        $f3 = (isset($_GET['keyword'])?'&keyword='.$_GET['keyword']:'');
                        $f4 = (isset($_GET['pegawai'])?'&pegawai='.$_GET['pegawai']:'');
                        $f5 = (isset($_GET['sektor'])?'&sektor='.$_GET['sektor']:'');
                        $f6 = (isset($_GET['tahun'])?'&tahun='.$_GET['tahun']:'');

                        if($jumpage>1){
                            echo'<li class="page-item '.($page==1?'disabled':'').'"><a class="page-link" href="/ppdkluang/cpanel/sekolah/ict/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page=1"><i class="fa fa-fast-backward" aria-hidden="true"></i></a></li>';
                            echo'<li class="page-item '.($page==1?'disabled':'').'"><a class="page-link" href="/ppdkluang/cpanel/sekolah/ict/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.($page-1).'"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>';
                            for($p=1;$p<=$jumpage;$p++){
                                echo'<li class="page-item '.($p==$page?'disabled':'').'"><a class="page-link" href="/ppdkluang/cpanel/sekolah/ict/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.$p.'">'.$p.'</a></li>';
                            }
                            echo'<li class="page-item '.($page==$jumpage?'disabled':'').'"><a class="page-link" href="/ppdkluang/cpanel/sekolah/ict/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.($page+1).'"><i class="fa fa-step-forward" aria-hidden="true"></i></a></li>';
                            echo'<li class="page-item '.($page==$jumpage?'disabled':'').'"><a class="page-link" href="/ppdkluang/cpanel/sekolah/ict/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.$jumpage.'"><i class="fa fa-fast-forward" aria-hidden="true"></i></a></li>';
                        }
                        ?>
                    </ul>
                </nav>
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