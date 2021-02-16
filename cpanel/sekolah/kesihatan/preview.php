<?php
$page = 'inbox';
include($_SERVER['DOCUMENT_ROOT']."/cpanel/sekolah/header.php");

if(!isset($_GET['surat'])){
    exit();
}

$id = $_GET['surat'];

//UPDATE BACA
$kuri = $PPD->prepare("SELECT baca,download FROM muatturun_analisis WHERE idsurat = ? AND kodsekolah = ? LIMIT 1");
$kuri->execute([$id,USER]);
$initial = $kuri->fetch(PDO::FETCH_ASSOC);

$fin = @$initial['baca']+1;

$kuri = $PPD->prepare("UPDATE muatturun_analisis SET baca = ? WHERE idsurat =? AND kodsekolah = ?");
$kuri->execute([$fin,$id,USER]);

//DATA SURAT
$kuri = $PPD->prepare("SELECT * FROM muatturun WHERE id = ? LIMIT 1");
$kuri->execute([$id]);
$d = $kuri->fetch(PDO::FETCH_ASSOC);
if(strtotime($d['dateadded'])>strtotime('2020-05-07')){$old=1;}else{$old=0;}

//DATA ANALISIS
$kuri = $PPD->prepare("SELECT muatturun_analisis.kodsekolah,users_sekolah.realname,muatturun_analisis.baca,muatturun_analisis.download FROM muatturun_analisis
INNER JOIN users_sekolah ON muatturun_analisis.kodsekolah = users_sekolah.username WHERE muatturun_analisis.idsurat = ?");
$kuri->execute([$id]);
$sekar = $kuri->fetchAll(PDO::FETCH_ASSOC);

$jumsek = count($sekar);
$baca=0; $download=0;
foreach($sekar as $s){
    if($s['baca']){$baca++;}
    if($s['download']){$download++;}
}
if($jumsek){
    $presbaca = round(($baca/$jumsek)*100);
    $presdownload = round(($download/$jumsek)*100);
} else {
    $presbaca = 0;
    $presdownload = 0;
}

//DATA PEGAWAI
$kuri = $PPD->prepare("SELECT realname,jawatan,email,gambar FROM users WHERE username = ? LIMIT 1");
$kuri->execute([$d['owner']]);
$pegawai = $kuri->fetch(PDO::FETCH_ASSOC);

$id = $_GET['surat'];
$rujukan = $d['idberita'];
$edaran = $d['edaran'];
$kepada = $d['kepada'];
$tajuk = $d['penerangan'];
$terbit = $d['publish'];
$karang = $d['isikandungan'];
$tarikh = $d['dateadded'];
$lampiran = $d['lampiran'];

$pgb = [
    'all'=> "Pengetua dan Guru Besar,<br>Sekolah-sekolah Daerah Kluang",
    'sr'=> "Guru Besar,<br>Sekolah-sekolah Daerah Kluang",
    'sm'=> "Pengetua,<br>Sekolah-sekolah Daerah Kluang",
    'srxj'=> "Guru Besar,<br>SK, SRK, SRA Daerah Kluang",
    'sjkc'=> "Guru Besar,<br>SJK(C) Daerah Kluang",
    'sjkt'=> "Guru Besar,<br>SJK(T) Daerah Kluang",
    'custom'=> "Pengetua/Guru Besar,",
];

?>
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">LIHAT SURAT</h3>
    <div class="row mt-3">
        <div class="col-12 col-md-3 order-last order-md-first" id="main-menu">
            <div class="sticky-filter">
                <div class="card shadow-sm">
                    <h6 class="bg-oren-grad-2 text-center card-header m-0">MAKLUMAT SURAT</h6>
                    <div class="text-center profil-pic">
                        <img src="/staf/<?= htmlspecialchars($pegawai['gambar']) ?>" alt="" class="pro-pic">
                    </div>
                    <div class="card-body text-center">
                        <ul class="list-unstyled info-surat-list my-lh-1">
                            <li>
                                <small class="font-weight-bold">DISEDIAKAN OLEH</small>
                                <p><?= htmlspecialchars($pegawai['realname']).'<br><small>'.htmlspecialchars($pegawai['jawatan']) ?></small></p>
                            </li>
                            <li>
                                <small class="font-weight-bold">MASA HANTAR</small>
                                <p><?= date('d/m/Y g:iA',strtotime($d['dateadded'])) ?></p>
                            </li>
                            <li>
                                <small class="font-weight-bold">CADANGAN MINIT</small>
                                <p><?= ($d['minit']?htmlspecialchars($d['minit']):'PGB TETAPKAN') ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php if($old){ ?>
                <div class="card shadow-sm mt-3">
                    <h6 class="card-header bg-oren-grad-2 text-center m-0">ANALISIS</h6>
                    <div class="p-3 text-center my-lh-11">
                        <div class="card border-<?= presBar($presbaca) ?> office-pattern">
                            <div class="p-2">
                                <small class="text-small">PRESTASI BACA</small>
                                <h1 class="m-0 text-<?= presBar($presbaca) ?>"><?= $presbaca ?>%</h1>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?= presBar($presbaca) ?>" role="progressbar" style="width: <?= $presbaca ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <?php if($lampiran=='Y'){ ?>
                        <div class="card border-<?= presBar($presdownload) ?> office-pattern mt-3">
                            <div class="p-2">
                                <small class="text-small">PRESTASI MUAT TURUN</small>
                                <h1 class="m-0 text-<?= presBar($presdownload) ?>"><?= $presdownload ?>%</h1>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?= presBar($presdownload) ?>" role="progressbar" style="width: <?= $presdownload ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <?php } ?>
                        <button type="button" id="btn-modal-sekolah" class="mt-3 btn btn-warning btn-block">SENARAI SEKOLAH</button>
                    </div>
                </div>
                <?php } ?>
                <div class="operasi mt-3">
                    <?php if($lampiran=='Y'){ ?>
                    <a href="cpanel/sekolah/inbox/proc/download.php?id=<?= $id ?>&c=<?= $initial['download'] ?>" target="_blank" class="btn btn-success d-flex align-items-center shadow-sm btn-lampiran">
                        <div style="width:40px"><i class="fa fa-download" aria-hidden="true"></i></div>
                        <div class="d-flex justify-content-between flex-fill align-items-center">
                            <span>MUAT TURUN</span>
                            <?= ($old?'<span class="badge badge-light rounded downloaded">'.$initial['download'].'</span>':'') ?>
                        </div> 
                    </a>
                    <?php } ?>
                    <?php if($d['isikandungan']&&$old){ ?>
                    <a href="cpanel/inbox/cetak.php?surat=<?= htmlspecialchars($d['id']) ?>" target="_blank" class="btn btn-info d-flex align-items-center mt-2 shadow-sm">
                        <div style="width:40px"><i class="fa fa-print" aria-hidden="true"></i></div>
                        <div class="d-flex justify-content-between flex-fill align-items-center text-left">
                            <span>CETAK SURAT IRINGAN</span>
                        </div> 
                    </a>
                    <?php } ?>
                    <button type="button" class="btn btn-secondary d-flex align-items-center mt-2 shadow-sm btn-back w-100">
                        <div style="width:40px"><i class="fa fa-reply" aria-hidden="true"></i></div>
                        <div class="d-flex justify-content-between flex-fill align-items-center">
                            <span>KEMBALI</span>
                        </div> 
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 col-md mt-3 mt-md-0 text-justify order-first order-md-last" id="main-preview">
            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if($d['isikandungan']){ ?>
                    <img src="cpanel/img/suratheader.jpg" alt="header surat" class="w-100">
                    <div class="preview-surat px-3">
                        <div class="sinergi-tag">“SYNERGY IN ACTION - Let’s Synergize”</div>
                        <div class="row no-gutters justify-content-end">
                            <div class="col-12 col-md-5">
                                <table style="width:100%">
                                    <tr>
                                        <td style="width:30%">Ruj. Kami</td>
                                        <td style="width:10%" class="text-center">:</td>
                                        <td class="rujukan-show"><?= htmlspecialchars($rujukan) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tarikh</td>
                                        <td class="text-center">:</td>
                                        <td><?=  fullDate(htmlspecialchars($tarikh)) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="kepada-show mt-4">
                            <p class="m-0 pgb">
                            <?php
                            if($edaran=='006'||$edaran=='005'){
                                echo'Kepada Sesiapa Yang Berkenaan';
                            } elseif ($edaran=='008') {
                                echo $pgb[$kepada];
                            } else {
                                echo $pgb['all'];
                            }
                            ?>
                            </p>
                            <ul class="list-unstyled list-custom-sekolah">
                                <?php
                                if($kepada=='custom'){   
                                    if(count($sekar)<11){                         
                                        foreach($sekar as $d){
                                            echo'<li>'.$d['realname'].'</li>';
                                        }
                                    } else {
                                        echo'<li>Seperti Lampiran</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="tuan mt-4">Tuan,</div>
                        <p class="mt-4 font-weight-bold"><?= htmlspecialchars($tajuk) ?></p>
                        <p class="my-4">Dengan segala hormatnya perkara di atas adalah dirujuk.</p>
                        <div><?= $purifier->purify($karang) ?></div>
                        <p class="mt-4">Sekian, terima kasih.</p>
                        <p class="font-weight-bold">"BERKHIDMAT UNTUK NEGARA"</p>
                        <p>Saya yang menjalankan amanah,</p>
                        <p class="mt-5">
                            <b>(<?= $pegawai['realname'] ?>)</b><br>
                            <?= $pegawai['jawatan'] ?><br>
                            Pejabat Pendidikan Daerah Kluang<br>
                            b.p. Pegawai Pendidikan Daerah Kluang
                        </p>
                    </div>
                    <?php } else {
                            $mime = mime_content_type($_SERVER['DOCUMENT_ROOT'].'/lampiran/'.$d['namasebenar']);
                            if($mime=='application/pdf'||$mime=='image/jpeg'||$mime=='image/png'){
                                if($mime=='application/pdf'){ echo'
                                    <iframe src="pdfjs/web/vplain.html?file=../../lampiran/'.$d['namasebenar'].'" style="width:100%;height:1000px;" frameBorder="0"></iframe>';
                                } else {
                                    echo'<img src="lampiran/'.$d['namasebenar'].'" class="w-100">';
                                }
                            } else {
                                echo'<div class="text-center d-flex justify-content-center align-items-center" style="height:50vh"><h2 class="m-0 font-weight-bold text-muted">TIADA PRA TONTON DOKUMEN. SILA MUAT TURUN LAMPIRAN.</h2></div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div> 

<div id="modal-analisis" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header back-pattern">
                <h5 class="modal-title" id="modal-analisis-title">ANALISIS MENGIKUT SEKOLAH</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-sm table-striped">
                    <thead class="text-center bg-warning text-light">
                        <tr>
                            <th>#</th>
                            <th>NAMA SEKOLAH</th>
                            <th data-toggle="tooltip" data-placement="top" title="Jumlah Baca"><i class="fa fa-eye" aria-hidden="true"></i></th>
                            <th data-toggle="tooltip" data-placement="top" title="Jumlah Muat Turun" class="<?= ($lampiran=='T'?'d-none':'') ?>><i class="fa fa-download" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                    $bil = 1;
                    foreach($sekar as $a){
                        echo'
                        <tr>
                            <td>'.$bil.'</td>
                            <td class="text-left">'.$a['realname'].'</td>
                            <td>'.$a['baca'].'</td>
                            <td class="'.($lampiran=='T'?'d-none':'').'">'.$a['download'].'</td>
                        </tr>';$bil++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="id" value="<?= $id ?>">
<!-- START FOOTER -->
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js?v=1.1"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        $('#btn-modal-sekolah').click(function(){
            $('#modal-analisis').modal('show');
        })
    </script>
  </body>
</html>