<div class="card shadow-sm mb-3 setiap-kad">
    <div class="card-topline bg-<?= $color ?>"></div>
    <div class="card-body">
        <div class="form-row">
            <div class="col-auto">
                <div class="d-flex flex-column">
                    <div class="kad-list--nombor mb-2">
                        <img src="staf/<?= $gambar ?>" alt="Pengguna" class="kad-list--gambar">
                    </div>
                    <!-- BUTANG OPERASI -->
                    <?php if($editkad) { ?>
                    <ul class="list-unstyled nav-kad text-center m-0">
                        <li data-toggle="tooltip" data-placement="left" title="Tukar kepada belum baca">
                            <a href="cpanel/sekolah/inbox/proc/unread.php?id=<?= $id ?>" class="btn btn-sm rounded-circle btn-primary" onclick="return confirm('Proses ini akan menetapkan semula bilangan baca dan muat turun surat kepada 0. Teruskan?');">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col">
                <div class="row justify-content-between kad-list--sektor-tarikh">
                    <div class="col-12 col-md-auto text-<?= $sectcolor[$sektor] ?>"><i class="fa fa-flag" aria-hidden="true"></i>&ensp;<?= $sektor ?></div>
                    <div class="col-12 col-md-auto"><?= $rujukan ?></div>
                </div>
                <div class="kad-list--body mt-2">
                    <h5 class="m-0 tajuk"><a href="cpanel/sekolah/inbox/preview.php?surat=<?= $id ?>"><?= $tajuk ?></a></h5>
                    <div class="kad-list--body-info">
                        <ul class="list-unstyled m-0">
                            <li>
                                <div class="icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                <span data-toggle="tooltip" data-placement="right" title="Dikarang Oleh"><?= $pegawai ?></span>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-black-tie" aria-hidden="true"></i></div>
                                <span data-toggle="tooltip" data-placement="right" title="Jawatan"><?= $jawatan ?></span>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                <span data-toggle="tooltip" data-placement="right" title="Masa Karang"><?= $masa ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>