<?php
    $page = 'egerak';
    include($_SERVER['DOCUMENT_ROOT']."/cpanel/header.php");
    $bulan = $_GET['bulan']??date('m');
    $tahun = $_GET['tahun']??date('Y');
    
    function npBulan($b,$t,$np){
        if($np=='next'){
            if($b==12){
                return 'bulan=1&tahun='.($t+1);
            } else {
                return 'bulan='.($b+1).'&tahun='.$t;
            }
        } else if($np=='prev'){
            if($b==1){
                return 'bulan=12&tahun='.($t-1);
            } else {
                return 'bulan='.($b-1).'&tahun='.$t;
            }
        } else {
            return 'error';
        }
    }

    $kuri = $PPD->prepare("SELECT egerak_subutama.id,egerak_kenyataan.Keterangan,egerak_subutama.location,egerak_subutama.title,egerak_subutama.actdate,egerak_subutama.enddate,egerak_subutama.masa,egerak_subutama.status
                            FROM egerak_subutama INNER JOIN egerak_kenyataan ON egerak_subutama.kategori = egerak_kenyataan.Kategori
                            WHERE egerak_subutama.kputama = ? AND MONTH(egerak_subutama.actdate) = ? AND YEAR(egerak_subutama.actdate) = ?
                            ORDER BY egerak_subutama.actdate ASC");
    $kuri->execute([USER,$bulan,$tahun]);
    $eg = $kuri->fetchAll(PDO::FETCH_ASSOC);

    function tasen($mula,$akhir){
        if($mula==$akhir){
            return myDate($mula);
        } else {
            return myDate($mula).'<br>hingga<br>'.myDate($akhir);
        }
    }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" />
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card my-4 font-weight-bold p-2 text-center bg-dark text-light">SENARAI PERGERAKAN PERIBADI</h3>
    <div class="form-group form-row justify-content-center">
        <label for="bulan" class="col-form-label col-auto">PILIH BULAN/TAHUN</label>
        <div class="col col-md-3">
            <div class="input-group shadow-sm">
                <input type="text" class="form-control datepicker" value="<?= $bulan.'/'.$tahun ?>">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-auto"><a href="cpanel/egerak/senarai.php?<?= npBulan($bulan,$tahun,'prev') ?>" class="btn btn-warning shadow-sm btn-load"><i class="fa fa-step-backward" aria-hidden="true"></i></a></div>
        <div class="col-auto"><a href="cpanel/egerak/senarai.php?<?= npBulan($bulan,$tahun,'next') ?>" class="btn btn-warning shadow-sm btn-load"><i class="fa fa-step-forward" aria-hidden="true"></i></a></div>
        <div class="col-auto loader align-self-center" style="display:none">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        </div>
    </div>
    <div class="card table-responsive shadow">
        <table class="table table-striped my-lh-1 text-center mb-0">
            <thead class="bg-warning text-light">
                <tr>
                    <th class="d-none d-md-table-cell">#</th>
                    <th>TARIKH/MASA</th>
                    <th>PERGERAKAN</th>
                    <th style="width:5%"><i class="fa fa-cog" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($eg){
                    $b=1;
                    foreach($eg as $e){
                        echo'<tr '.(!$e['status']?'style="background:#ffbcbc" data-toggle="tooltip" data-placement="top" title="Belum selesai isi! Anda tidak dibenarkan menambah rekod selagi rekod ini tidak dilengkapkan."':'').'>';
                        echo'<td class="align-middle d-none d-md-table-cell">'.$b.'</td>';
                        echo'<td class="align-middle my-lh-1 text-sm1">'.tasen($e['actdate'],$e['enddate']).'<br>'.($e['masa']?'<span class="text-success">('.ucwords($e['masa']).')</span>':'').'</td>';
                        echo'<td class="text-left align-middle"><span class="text-info font-weight-bold">'.$e['Keterangan'].'</span><br>
                        '.($e['title']?$e['title'].'<br>':'').'
                        '.($e['location']?'<small class="text-primary">Lokasi : '.$e['location'].'</small>':'').'
                        </td>';
                        echo'<td class="align-middle">
                        <a href="cpanel/egerak/edit.php?id='.$e['id'].'" class="btn btn-block btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="cpanel/egerak/proc/isi.php?buang='.$e['id'].'&bulan='.$bulan.'&tahun='.$tahun.'" class="buang btn btn-block btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                        echo'</tr>';
                        $b++;
                    }
                } else {
                    echo'<tr><td colspan="4">TIADA PERGERAKAN UNTUK BULAN DAN TAHUN YANG DIPILIH</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- START FOOTER -->
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js?v=1"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();

        $('.datepicker').datepicker({
            format: 'm/yyyy',
            autoHide: true,
            pick: function(){
                $('.loader').show(0);
                let ini = $(this).datepicker('getDate',true);
                let date = ini.split('/');
                window.location.replace("cpanel/egerak/senarai.php?bulan="+date[0]+"&tahun="+date[1]);
            }
        });
        $('.datepicker').on('keydown',function(e){
            e.preventDefault();
        })
        $('.btn-load').click(function(){
            $('.loader').show(0);
        })
    </script>
  </body>
</html>