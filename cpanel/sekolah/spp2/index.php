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

$kuri = $PPD->prepare("SELECT * FROM `spp_isp` where KODSEKOLAH='JBD2048' ");
$kuri->execute([USER]);
//$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);
 $d = $kuri->fetch(PDO::FETCH_ASSOC);
$_SESSION['talian']=$d['TALIAN'];


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
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">SIJIL PENGUJIAN DAN PENTAULIAHAN TALIAN INTERNET INTRIM</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first mt-3 mt-md-0">
            <div class="sticky-filter">
                <?php include 'proc/side-menu.php'; ?>
            </div>
        </div>
        <div class="col col-md order-first order-md-last">

<div class="card shadow-sm mb-3 setiap-kad">
    <div class="card-topline bg-<?= $color ?>"></div>
    <div class="card-body">
        <div class="form-row">
            <div class="col-auto">

            </div>
            <div class="col">
                <div class="row justify-content-between kad-list--sektor-tarikh">
                    <div class="col-12 col-md-auto text-<?= $sectcolor[$sektor] ?>"><i class="fa fa-flag" aria-hidden="true"></i>&ensp;</div>
                    <div class="col-12 col-md-auto"></div>
                </div>
                <div class="kad-list--body mt-2">
                    <h5 class="m-0 tajuk"><a href="cpanel/sekolah/inbox/preview.php?surat=<?= $id ?>"></a></h5>

<canvas id="canvas" style="display: block; width: 678px; height: 339px;" width="678" height="339" class="chartjs-render-monitor"></canvas>


                </div>
            </div>
        </div>
    </div>
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

<?php function get_bulan($PPD,$bulan,$peranti){

    $kuri = $PPD->prepare("SELECT `$peranti` AS bil FROM spp WHERE KODSEKOLAH = ? and MONTH(tarikh)=$bulan");
    $kuri->execute([USER]);
    $xbaca = $kuri->fetch(PDO::FETCH_ASSOC)['bil'];
return $xbaca;
}
?>
<script>
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'PERANTI 1',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: [
                    <?php echo get_bulan($PPD,1,'v1'); ?>,
                    <?php echo get_bulan($PPD,2,'v1'); ?>,
                    <?php echo get_bulan($PPD,3,'v1'); ?>,
                    <?php echo get_bulan($PPD,4,'v1'); ?>,
                    <?php echo get_bulan($PPD,5,'v1'); ?>,
                    <?php echo get_bulan($PPD,6,'v1'); ?>,
                    <?php echo get_bulan($PPD,7,'v1'); ?>
                ]
            }, {
                label: 'PERANTI 2',
                backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                    <?php echo get_bulan($PPD,1,'v2'); ?>,
                    <?php echo get_bulan($PPD,2,'v2'); ?>,
                    <?php echo get_bulan($PPD,3,'v2'); ?>,
                    <?php echo get_bulan($PPD,4,'v2'); ?>,
                    <?php echo get_bulan($PPD,5,'v2'); ?>,
                    <?php echo get_bulan($PPD,6,'v2'); ?>,
                    <?php echo get_bulan($PPD,7,'v2'); ?>
                ]
            }, {
                label: 'PERANTI 3',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                    <?php echo get_bulan($PPD,1,'v3'); ?>,
                    <?php echo get_bulan($PPD,2,'v3'); ?>,
                    <?php echo get_bulan($PPD,3,'v3'); ?>,
                    <?php echo get_bulan($PPD,4,'v3'); ?>,
                    <?php echo get_bulan($PPD,5,'v3'); ?>,
                    <?php echo get_bulan($PPD,6,'v3'); ?>,
                    <?php echo get_bulan($PPD,7,'v3'); ?>
                ]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                        scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true
          }
        }
      ]
    },
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'GRAF'
                    }
                }
            });

        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            var zero = Math.random() < 0.2 ? true : false;
            barChartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return zero ? 0.0 : randomScalingFactor();
                });

            });
            window.myBar.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            var colorName = colorNames[barChartData.datasets.length % colorNames.length];
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + (barChartData.datasets.length + 1),
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                barChartData.labels.push(month);

                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    // window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            barChartData.datasets.pop();
            window.myBar.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function(dataset) {
                dataset.data.pop();
            });

            window.myBar.update();
        });
    </script>


  </body>

</html>