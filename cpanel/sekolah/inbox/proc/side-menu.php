<?php
//PASTIKAN ADA AUTH DAN FUNCTION
$kuri = $PPD->query("SELECT DISTINCT(users.sektor) as sektor FROM muatturun INNER JOIN users ON muatturun.owner = users.username ORDER BY sektor ASC");
$sect = $kuri->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="card shadow-sm">
    <div class="list-group list-group-flush inbox-menu">
        <a href="cpanel/sekolah/inbox" class="list-group-item list-group-item-action <?= ($view=='primary'?'active-oren':'') ?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>SURAT MASUK <?= ($xbaca?'&ensp;<span class="badge badge-secondary rounded">'.$xbaca.'</span></span>':'') ?>
        </a>
        <a href="cpanel/sekolah/inbox/?view=telahbaca" class="list-group-item list-group-item-action <?= ($view=='telahbaca'?'active-oren':'') ?>">
            <i class="fa fa-envelope-open" aria-hidden="true"></i> TELAH BACA
        </a>
        <a href="cpanel/sekolah/inbox/?view=pkp" class="list-group-item list-group-item-action <?= ($view=='pkp'?'active-oren':'') ?>">
            <i class="fa fa-ban" aria-hidden="true"></i> SURAT SEPANJANG PKP
        </a>
        <a href="cpanel/sekolah/inbox/?view=edaran&edaran=007" class="list-group-item list-group-item-action <?= ($edaran=='%007%'?'active-oren':'') ?>">
            <i class="fa fa-certificate" aria-hidden="true"></i> PEKELILING
        </a>
        <a href="cpanel/sekolah/inbox/?view=edaran&edaran=006" class="list-group-item list-group-item-action <?= ($edaran=='%006%'?'active-oren':'') ?>">
            <i class="fa fa-cog" aria-hidden="true"></i> TANDER
        </a>
        <a href="cpanel/sekolah/inbox/?view=edaran&edaran=005" class="list-group-item list-group-item-action <?= ($edaran=='%005%'?'active-oren':'') ?>">
            <i class="fa fa-users" aria-hidden="true"></i> AWAM
        </a>
    </div>
</div>
<div class="card shadow-sm mt-3">
    <div class="card-header text-center bg-oren-grad-2"><i class="fa fa-search" aria-hidden="true"></i> CARIAN SURAT</div>
    <div class="card-body">
        <form>
            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Carian kata kunci" value="<?= @$_GET['keyword'] ?>">
            <small class="form-text text-muted">Kosongkan jika tiada</small>
            <input type="text" class="form-control mt-2" name="pegawai" id="pegawai" placeholder="Carian pegawai" value="<?= @$_GET['pegawai'] ?>">
            <small class="form-text text-muted">Kosongkan jika tiada</small>
            <select name="sektor" id="sektor" class="form-control mt-3">
                <option value="all">Semua Sektor</option>
                <?php
                foreach(array_filter($sect) as $s){
                    echo'<option '.($s==@$_GET['sektor']?'selected':'').'>'.$s.'</option>';
                }
                ?>
            </select>
            <select name="tahun" id="tapis-tahun" class="form-control mt-3">
                <option value="all">Setiap tahun</option>
                <?php for($i=2017;$i<=date('Y');$i++) {
                    echo'<option value="'.$i.'" '.($i==@$_GET['tahun']?'selected':'').'>'.$i.'</option>';
                } ?>
            </select>
            <input type="hidden" name="view" value="search">
            <button type="submit" class="btn btn-warning btn-block mt-3" id="btn-cari">CARI</button>
        </form>
    </div>
</div>