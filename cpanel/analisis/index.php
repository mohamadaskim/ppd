<?php
    $page = 'analisis';
    include("/ppdkluang/cpanel/header.php");

    $sektor = [
        'spu' => 'SEKTOR PENGURUSAN',
        'spr' => 'SEKTOR PERANCANGAN',
        'spb' => 'SEKTOR PEMBELAJARAN',
        'sps' => 'SEKTOR PENGURUSAN SEKOLAH',
        'spm' => 'SEKTOR PEMBANGUNAN MURID',
        'kod' => 'PSIKOLOGI & KAUNSELING',
        'exam' => 'PENTAKSIRAN & PEPERIKSAAN',
        'pejabat' => 'PEJABAT PPD',
        'll' => 'SEKTOR/UNIT LAIN-LAIN'
    ];
    $kaler = ["#FF4136", "#B10DC9","#0074D9","#2ECC40","#FFDC00","#111111"];
?>
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">ANALISIS SISTEM PPD KLUANG</h3>
    <div class="card shadow-sm mt-4">
        <h5 class="card-header text-center font-weight-bold bg-oren-grad-2">MAKLUM BALAS PELANGGAN</h5>
        <div class="form-row justify-content-around">
            <div class="col-12 col-md-7">
                <div class="card-body">
                    <h6 class="card-title">PERATUS MAKLUM BALAS PELANGGAN</h6>
                    <div class="tapis-mb">
                        <div class="form-row">
                            <div class="col-6">
                                <select name="sektor-mbp" id="sektor-mbp" class="form-control">
                                    <option value="all">Semua Sektor</option>
                                    <?php foreach($sektor as $k=>$s){
                                        echo'<option value="'.$k.'">'.$s.'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="tahun-mbp" id="tahun-mbp" class="form-control">
                                    <?php for($x=2020;$x<=date('Y');$x++){
                                        echo'<option value="'.$x.'" '.($x==date('Y')?'selected':'').'>'.$x.'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="bulan-mbp" id="bulan-mbp" class="form-control">
                                    <option value="all">Sepanjang Tahun</option>
                                    <option value="quaterly">Suku Tahun</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="graf-mb">
                        <canvas id="carta-mb" width="100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mt-3 mt-md-0">
                <div class="card-body">
                    <h6 class="card-title">ASPEK TIDAK MEMUASKAN</h6>
                    <select name="bulan-aspek-mbp" id="bulan-aspek-mbp" class="form-control">
                        <option value="all">Sepanjang Tahun</option>
                        <?php
                        for($i=1;$i<=12;$i++){
                            echo'<option value="'.$i.'">'.myMonthName($i).'</option>';
                        }
                        ?>
                    </select>
                    <div class="mt-3 p-2">
                        <canvas id="pie-mb" width="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mt-4">
        <h5 class="card-header text-center font-weight-bold bg-oren-grad-2">MINIT ATAS TALIAN</h5>
        <div class="card-body">
            <div class="form-row">
                <label for="tapis-minit" class="col-auto col-form-label">LIHAT IKUT</label>
                <div class="col-12 col-md">
                    <select name="tapis-minit" id="tapis-minit" class="form-control">
                        <option value="sektor">SEKTOR</option>
                        <option value="bulan">BULAN</option>
                    </select>
                </div>
                <label for="tahun-minit" class="col-auto col-form-label">TAHUN</label>
                <div class="col-12 col-md-2">
                    <select name="tahun-minit" id="tahun-minit" class="form-control">
                        <?php for($x=2019;$x<=date('Y');$x++){
                            echo'<option value="'.$x.'" '.($x==date('Y')?'selected':'').'>'.$x.'</option>';
                        } ?>
                    </select>
                </div>
            </div>
            <div class="carta-minit-wrapper">
                <canvas id="carta-minit" width="100%"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- START FOOTER -->
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-3kSXcicezu2sKkkqQae/hgspQC+t6zkOA0rS7QtlSyE=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js"></script>
    <script src="cpanel/analisis/function.js?v=3.2"></script>
    <script>
        var chartmb;
        var piemb;
        var chartminit;
        var kaler = ["#FF4136", "#B10DC9","#0074D9","#2ECC40","#FFDC00","#111111"];
        var kaler2 = ['#001f3f','#39CCCC','#FFDC00','#FF4136','#B10DC9','#AAAAAA','#0074D9','#3D9970','#FF851B','#85144b','#F012BE','#DDDDDD','#7FDBFF','#01FF70','#111111'];
        
        Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
            color: '#FFFFFF',
            font : {
                size : '9',
                weight : 'bold'
            },
            textShadowColor: '#111111',
            textShadowBlur: 4
        });
        //UBAH CARTA MAKLUM BALAS
        $('#sektor-mbp,#tahun-mbp,#bulan-mbp,#bulan-aspek-mbp').change(function(){
            let sek = $('#sektor-mbp').val();
            let tahun = $('#tahun-mbp').val();
            let bulan = $('#bulan-mbp').val();
            let bulanpie = $('#bulan-aspek-mbp').val();
            genMb(true,sek,tahun,bulan);
            genMbPie(true,sek,tahun,bulanpie);
        });

        //UBAH CARTA MINIT
        $('#tapis-minit,#tahun-minit').change(function(){
            let tapisminit = $('#tapis-minit').val();
            let tahunminit = $('#tahun-minit').val();
            genMinit(true,tahunminit,tapisminit);
        })

        //GEN FIRST GRAPH
        var sek = $('#sektor-mbp').val();
        var tahun = $('#tahun-mbp').val();
        var bulan = $('#bulan-mbp').val();
        var bulanpie = $('#bulan-aspek-mbp').val();
        var tapisminit = $('#tapis-minit').val();
        var tahunminit = $('#tahun-minit').val();

        if ($(window).width() < 960) {
            var bar = 'horizontalBar';
        } else {
            var bar = 'bar';
        }

        genMb(false,sek,tahun,bulan,bar);
        genMbPie(false,sek,tahun,bulanpie);
        genMinit(false,tahunminit,tapisminit,bar);
    </script>
  </body>
</html>