<?php
    $page = 'egerak';
    include($_SERVER['DOCUMENT_ROOT']."/cpanel/header.php");
    $today = date('d/m/Y');

    $kuri = $PPD->prepare("SELECT id,kategori,actdate,enddate,masa FROM egerak_subutama WHERE kputama = ? AND status = 0 LIMIT 1");
    $kuri->execute([USER]);
    $ada = $kuri->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" />
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card my-4 font-weight-bold p-2 text-center bg-dark text-light">PERGERAKAN PEGAWAI</h3>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm">
                <h4 class="card-header text-center bg-oren font-weight-bold">MAKLUMAT PERGERAKAN</h4>
                <div class="card-body">
                    <?php if(!$ada){ ?>
                    <form action="cpanel/egerak/proc/isi.php" method="POST" class="form-ada-proses">
                        <div class="form-group">
                            <label for="mula">TARIKH</label>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" id="mula" class="form-control datepicker" name="mula" autocomplete="off" value="<?= $today ?>">
                                </div>
                                <div class="col-12 col-md-6 mt-2 mt-md-0">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <button class="btn btn-info btn-block" id="harini" type="button">HARI INI</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-info btn-block" id="esok" type="button">ESOK</button>
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hingga">HINGGA</label>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" id="hingga" class="form-control datepicker" name="hingga" autocomplete="off" placeholder="Kosongkan jika hari 1 hari sahaja">
                                </div>
                                <div class="col-12 col-md-6 mt-2 mt-md-0">
                                    <div class="form-row">
                                        <div class="col">
                                            <button class="btn btn-info btn-block hari-hingga" type="button" data-hari="2">2 HARI</button>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-info btn-block hari-hingga" type="button" data-hari="3">3 HARI</button>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-secondary" type="button" id="clear-hingga" data-toggle="tooltip" data-placement="top" title="Buang tarikh hingga"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori">KATEGORI</label>
                            <div class="form-row">
                                <div class="col-6 col-md-3">
                                    <button type="button" class="btn btn-warning btn-block btn-suis h-100" data-kat="001">TUGAS RASMI</button>
                                </div>
                                <div class="col-6 col-md-3">
                                    <button type="button" class="btn btn-outline-warning btn-block btn-suis h-100" data-kat="003">CUTI REHAT</button>
                                </div>
                                <div class="col-6 col-md-3 mt-2 mt-md-0">
                                    <button type="button" class="btn btn-outline-warning btn-block btn-suis h-100" data-kat="005">CUTI SAKIT</button>
                                </div>
                                <div class="col-6 col-md-3 mt-2 mt-md-0">
                                    <button type="button" class="btn btn-outline-warning btn-block btn-suis h-100" data-kat="100">LAIN-LAIN</button>
                                </div>
                                <input type="hidden" name="kat" value="001">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masa">MASA</label>
                            <div class="form-row">
                                <div class="col-12 col-md-4">
                                    <button type="button" class="btn btn-warning btn-block btn-suis" data-masa="seharian">SEHARIAN</button>
                                </div>
                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                    <button type="button" class="btn btn-outline-warning btn-block btn-suis" data-masa="pagi">PAGI</button>
                                </div>
                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                    <button type="button" class="btn btn-outline-warning btn-block btn-suis" data-masa="petang">PETANG</button>
                                </div>
                                <input type="hidden" name="masa" value="seharian">
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success" name="first"><i class="fa fa-arrow-right" aria-hidden="true"></i> TERUSKAN</button>
                        </div>
                    </form>
                    <?php } else {
                        $kuri = $PPD->query("SELECT Kategori,Keterangan FROM egerak_kenyataan");
                        $katlist = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);
                    ?>
                    <h6 class="text-center font-weight-bold">SILA LENGKAPKAN MAKLUMAT PERGERAKAN DIBAWAH</h6>
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-md-6">
                            <table style="width:100%">
                                <tr>
                                    <td>Tarikh Mula</td>
                                    <td style="width:5%">:</td>
                                    <td><?= myDate($ada['actdate']) ?></td>
                                </tr>
                                <?php if($ada['actdate']!=$ada['enddate']){ ?>
                                <tr>
                                    <td>Tarikh Hingga</td>
                                    <td>:</td>
                                    <td><?= myDate($ada['enddate']) ?></td>
                                </tr>
                                <?php } 
                                if($ada['kategori']!='100'){ ?>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td><?= $katlist[$ada['kategori']] ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>Masa</td>
                                    <td>:</td>
                                    <td><?= ucwords($ada['masa']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form action="cpanel/egerak/proc/isi.php" method="POST" class="form-ada-proses">
                        <input type="hidden" name="kat" value="<?= htmlspecialchars($ada['kategori']) ?>">
                        <?php if($ada['kategori']=='100'){ ?>
                        <div class="form-group">
                            <label for="kat">KATEGORI</label>
                            <select name="kat" id="kat" class="form-control">
                                <option value="" selected disabled>Sila Pilih...</option>
                                <?php
                                foreach($katlist as $k=>$v){
                                    if($k!='001'&&$k!='003'&&$k!='005'){
                                    echo'<option value="'.$k.'">'.$v.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div id="extra">
                            <div class="form-group">
                                <label for="tajuk">NAMA PROGRAM/AKTIVITI</label>
                                <input type="text" class="form-control extra" name="tajuk" id="tajuk" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi">LOKASI PERGERAKKAN</label>
                                <input type="text" class="form-control extra" name="lokasi" id="lokasi" required>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($ada['id']) ?>">
                            <button type="submit" class="btn btn-success" name="second"><i class="fa fa-paper-plane" aria-hidden="true"></i> KEMASKINI</button>
                            <a href="cpanel/egerak/proc/isi.php?buang=<?= htmlspecialchars($ada['id']) ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> BUANG</a>
                        </div>
                    </form>
                    <?php } ?>
                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js?v=1"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoHide: true
        });
        $('.datepicker').on('keydown',function(e){
            e.preventDefault();
        })
        $('.btn-suis').click(function(){
            $(this).closest('.form-row').find('.btn-suis').addClass('btn-outline-warning').removeClass('btn-warning');
            $(this).toggleClass('btn-outline-warning btn-warning');
            let dat = $(this).data();
            let name = Object.keys(dat)[0];
            let val = Object.values(dat)[0];
            $('[name="'+name+'"]').val(val);
        })
        $('#harini').click(function(){
            let t = new Date();
            let today = t.getDate()+'/'+(t.getMonth()+1)+'/'+t.getFullYear();
            $('[name="mula"]').val(today);
        })
        $('#esok').click(function(){
            let esok = new Date();
            esok.setDate(new Date().getDate()+1);
            let ev = esok.getDate()+'/'+(esok.getMonth()+1)+'/'+esok.getFullYear();
            $('[name="mula"]').val(ev);
        })
        $('.hari-hingga').click(function(){
            let m = $('#mula').val().split('/');
            let days = $(this).data('hari');
            let a = new Date(m[1]+'-'+m[0]+'-'+m[2]);
            a.setDate(a.getDate()+parseInt(days));
            let b = a.getDate()+'/'+(a.getMonth()+1)+'/'+a.getFullYear();
            $('[name="hingga"]').val(b);
        })
        $('#clear-hingga').click(function(){
            $('[name="hingga"]').val('');
        })
        $('#kat').change(function(){
            let text = $(this).find('option:selected').text();
            if(text.indexOf('CUTI')>=0 || text.indexOf('RUMAH')>=0){
                $('#extra').slideUp('fast');
                $('.extra').prop('required',false);
            } else {
                $('#extra').slideDown('fast');
                $('.extra').prop('required',true);
            }
        })
    </script>
  </body>
</html>