<?php
    $page = 'egerak';
    include($_SERVER['DOCUMENT_ROOT']."/cpanel/header.php");

    if(!isset($_GET['id'])){
        header('Location: senarai.php');
        exit();
    }

    $id = htmlspecialchars($_GET['id']);

    $kuri = $PPD->prepare("SELECT * FROM egerak_subutama WHERE id = ? AND kputama = ? LIMIT 1");
    $kuri->execute([$id,USER]);
    $d = $kuri->fetch(PDO::FETCH_ASSOC);

    $kuri = $PPD->query("SELECT * FROM egerak_kenyataan");
    $keny = $kuri->fetchAll(PDO::FETCH_KEY_PAIR);

    $masal = ['seharian','pagi','petang'];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" />
<div class="main">
    <img src="/cpanel/img/toptitle.png" alt="Top Title" class="w-100">
    <h3 class="card my-4 font-weight-bold p-2 text-center bg-dark text-light">KEMASKINI PERGERAKAN</h3>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <form class="card-body form-ada-proses" action="cpanel/egerak/proc/isi.php" method="POST">
                    <div class="form-group form-row">
                        <div class="col-6">
                            <label for="mula">MULA</label>
                            <input type="mula" class="form-control" value="<?= myDate($d['actdate']) ?>" name="mula">
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
        
    </script>
  </body>
</html>