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
        $offset = (htmlspecialchars($_GET['page'])*10)-10;
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
    
    $jumpage = ceil($kaun/10);

    $kuri = $PPD->prepare("SELECT COUNT(*) AS bil FROM muatturun_analisis
                            INNER JOIN muatturun ON muatturun_analisis.idsurat = muatturun.id
                            WHERE muatturun_analisis.kodsekolah = ? AND muatturun_analisis.baca = 0 AND muatturun.publish = 1");
    $kuri->execute([USER]);
    $xbaca = $kuri->fetch(PDO::FETCH_ASSOC)['bil'];
?>
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">PETI SURAT PPD KLUANG</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first mt-3 mt-md-0">
            <div class="sticky-filter">
                <?php include 'proc/side-menu.php'; ?>
            </div>
        </div>
        <div class="col col-md order-first order-md-last">
            <?php
            if($surat){
                if($view=='pkp'){echo'<p class="text-center">Bahagian ini diwujudkan untuk sekolah maklum dengan surat yang di muat naik sepanjang PKP berlangsung. Bahagian ini akan di buang selepas sebulan tamat PKP.</p>';}
                foreach($surat as $s){
                    $color = $sectcolor[$s['sektor']];
                    $gambar = htmlspecialchars($s['gambar']);
                    $id = htmlspecialchars($s['id']);
                    $sektor = $s['sektor'];
                    $rujukan = htmlspecialchars($s['idberita']);
                    $tajuk = htmlspecialchars($s['penerangan']);
                    $pegawai = htmlspecialchars($s['realname']);
                    $jawatan = htmlspecialchars($s['jawatan']);
                    $masa = date('d/m/Y g:iA',strtotime($s['dateadded']));
                    $editkad = ($view=='telahbaca'?true:false);
                    include 'proc/kad-style.php';
                } ?>
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
                            echo'<li class="page-item '.($page==1?'disabled':'').'"><a class="page-link" href="cpanel/sekolah/inbox/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page=1"><i class="fa fa-fast-backward" aria-hidden="true"></i></a></li>';
                            echo'<li class="page-item '.($page==1?'disabled':'').'"><a class="page-link" href="cpanel/sekolah/inbox/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.($page-1).'"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>';
                            for($p=1;$p<=$jumpage;$p++){
                                echo'<li class="page-item '.($p==$page?'disabled':'').'"><a class="page-link" href="cpanel/sekolah/inbox/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.$p.'">'.$p.'</a></li>';
                            }
                            echo'<li class="page-item '.($page==$jumpage?'disabled':'').'"><a class="page-link" href="cpanel/sekolah/inbox/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.($page+1).'"><i class="fa fa-step-forward" aria-hidden="true"></i></a></li>';
                            echo'<li class="page-item '.($page==$jumpage?'disabled':'').'"><a class="page-link" href="cpanel/sekolah/inbox/?'.$f1.$f2.$f3.$f4.$f5.$f6.'&page='.$jumpage.'"><i class="fa fa-fast-forward" aria-hidden="true"></i></a></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <?php
            } else {
                if($view=='primary'){
                    echo'<div class="text-center d-flex flex-column justify-content-center align-items-center" style="height:50vh">
                    <h2 class="m-0 font-weight-bold text-muted">SEMUA SURAT PADA TAHUN INI TELAH DIBACA</h2>
                    <h5>Perhatian! Gunakan carian surat untuk melihat surat pada sistem lama dan tahun-tahun lepas.</h5>
                    <a href="cpanel/sekolah/inbox/?view=telahbaca" class="btn btn-secondary">SURAT TELAH DIBACA</a>
                    </div>';
                } else if($view=='telahbaca') {
                    echo'<div class="text-center d-flex flex-column justify-content-center align-items-center" style="height:50vh">
                    <h2 class="m-0 font-weight-bold text-muted">TIADA SURAT TELAH DIBACA UNTUK TAHUN INI</h2>
                    <h5>Perhatian! Gunakan carian surat untuk melihat surat pada sistem lama dan tahun-tahun lepas.</h5>
                    </div>';
                } else if($view=='search') {
                    echo'<div class="text-center d-flex flex-column justify-content-center align-items-center" style="height:50vh">
                    <h2 class="m-0 font-weight-bold text-muted">TIADA HASIL CARIAN</h2>
                    </div>';
                } else {
                    echo'<div class="text-center d-flex flex-column justify-content-center align-items-center" style="height:50vh">
                    <h2 class="m-0 font-weight-bold text-muted">TIADA MAKLUMAT DALAM PAPARAN INI</h2>
                    </div>';
                }
            }
            ?>
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