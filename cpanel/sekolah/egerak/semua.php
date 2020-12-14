<?php
    $page = 'egerak';
    include($_SERVER['DOCUMENT_ROOT']."/cpanel/header.php");
    $hari = $_GET['tarikh']??date('Y-m-d');
    
    $esok = date('Y-m-d',strtotime($hari.'+1 day'));
    $semalam = date('Y-m-d',strtotime($hari.'-1 day'));

    $kuri = $PPD->prepare("SELECT egerak_subutama.id,egerak_kenyataan.Keterangan,egerak_subutama.location,egerak_subutama.title,
                            egerak_subutama.actdate,egerak_subutama.enddate,egerak_subutama.masa,users.realname,users.jawatan,users.gambar
                            FROM egerak_subutama INNER JOIN egerak_kenyataan ON egerak_subutama.kategori = egerak_kenyataan.Kategori
                            INNER JOIN users ON egerak_subutama.kputama = users.username
                            WHERE egerak_subutama.actdate <= ? AND egerak_subutama.enddate >= ?
                            AND (egerak_subutama.enddate <> '0000-00-00' AND egerak_subutama.actdate <> '0000-00-00')
                            ORDER BY egerak_subutama.actdate ASC");
    $kuri->execute([$hari,$hari]);
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
    <h3 class="card my-4 font-weight-bold p-2 text-center bg-dark text-light">SENARAI PERGERAKAN PEGAWAI</h3>
    <div class="form-group form-row justify-content-center">
        <label for="bulan" class="col-form-label col-auto">PILIH TARIKH</label>
        <div class="col col-md-3">
            <div class="input-group shadow-sm">
                <input type="text" class="form-control datepicker" value="<?= myDate($hari) ?>">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-auto"><a href="cpanel/egerak/semua.php?tarikh=<?= $semalam ?>" class="btn btn-warning shadow-sm btn-load"><i class="fa fa-step-backward" aria-hidden="true"></i></a></div>
        <div class="col-auto"><a href="cpanel/egerak/semua.php?tarikh=<?= $esok ?>" class="btn btn-warning shadow-sm btn-load"><i class="fa fa-step-forward" aria-hidden="true"></i></a></div>
        <div class="col-auto loader align-self-center" style="display:none">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        </div>
        <div class="col-12 col-md mt-2 mt-md-0">
            <div class="form-row">
                <label for="tapis-pegawai" class="col-auto col-form-label">TAPIS PEGAWAI</label>
                <div class="col">
                    <input type="text" class="form-control shadow-sm" id="tapis-pegawai">
                </div>
            </div>
        </div>
    </div>
    <div class="card table-responsive shadow">
        <table class="table table-striped my-lh-1 text-center mb-0">
            <thead>
                <tr class="bg-warning text-light d-print-none">
                    <th class="d-none d-md-table-cell">#</th>
                    <th>PEGAWAI</th>
                    <th>TARIKH/MASA</th>
                    <th>PERGERAKAN</th>
                </tr>
                <tr class="d-print-table-row d-none bg-light">
                    <th class="d-none d-md-table-cell">#</th>
                    <th>PEGAWAI</th>
                    <th>TARIKH/MASA</th>
                    <th>PERGERAKAN</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                if($eg){
                    $b=1;
                    foreach($eg as $e){
                        echo'<tr class="satup">';
                        echo'<td class="align-middle d-none d-md-table-cell">'.$b.'</td>';
                        echo'<td class="text-left align-middle">
                            <div class="form-row align-items-center">
                                <div class="col-auto d-none d-md-block"><div style="height:40px;width:40px" class="rounded-circle overflow-hidden"><img src="staf/'.$e['gambar'].'" class="img-fluid"></div></div>
                                <div class="col">
                                    <span class="namap">'.$e['realname'].'</span><br>
                                    <span class="text-success text-sm1">'.$e['jawatan'].'</span>
                                </div>
                            </div>
                        </td>';
                        echo'<td class="align-middle my-lh-1 text-sm1">'.tasen($e['actdate'],$e['enddate']).'<br>'.($e['masa']?'<span class="text-success">('.ucwords($e['masa']).')</span>':'').'</td>';
                        echo'<td class="text-left align-middle"><span class="text-info font-weight-bold">'.$e['Keterangan'].'</span><br>
                        '.($e['title']?$e['title'].'<br>':'').'
                        '.($e['location']?'<small class="text-primary">Lokasi : '.$e['location'].'</small>':'').'
                        </td>';
                        echo'</tr>';
                        $b++;
                    }
                } else {
                    echo'<tr><td colspan="4">TIADA PERGERAKAN PEGAWAI UNTUK HARI YANG DIPILIH</td></tr>';
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
            format: 'dd/mm/yyyy',
            autoHide: true,
        });
        $('.datepicker').on('keydown',function(e){
            e.preventDefault();
        })
        $('.datepicker').on('pick.datepicker',function(e){
            if(e.view=='day'){
                $('.loader').show(0);
                let dat = e.date.getFullYear()+'-'+(e.date.getMonth()+1)+'-'+e.date.getDate();
                window.location.replace("cpanel/egerak/semua.php?tarikh="+dat);
            }
        })
        $('.btn-load').click(function(){
            $('.loader').show(0);
        })
        tapisKeyword('#tapis-pegawai','.namap','.satup');
    </script>
  </body>
</html>