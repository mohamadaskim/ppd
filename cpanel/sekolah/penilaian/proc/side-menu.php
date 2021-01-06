<?php
//PASTIKAN ADA AUTH DAN FUNCTION
$kuri = $PPD->query("SELECT DISTINCT(users.sektor) as sektor FROM muatturun INNER JOIN users ON muatturun.owner = users.username ORDER BY sektor ASC");
$sect = $kuri->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="card shadow-sm">
    <div class="list-group list-group-flush inbox-menu">
        <a href="/ppdkluang/cpanel/sekolah/penilaian" class="list-group-item list-group-item-action <?= ($view=='primary'?'active-oren':'') ?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>DASHBOARD </span>
        </a>
        <a href="/ppdkluang/cpanel/sekolah/penilaian/?view=telahbaca" class="list-group-item list-group-item-action <?= ($view=='telahbaca'?'active-oren':'') ?>">
            <i class="fa fa-envelope-open" aria-hidden="true"></i> TAMBAH PENILAIAN
        </a>
        <a href="/ppdkluang/cpanel/sekolah/penilaian/?view=pkp" class="list-group-item list-group-item-action <?= ($view=='pkp'?'active-oren':'') ?>">
            <i class="fa fa-ban" aria-hidden="true"></i> SENARAI PENILAIAN
        </a>
        
    </div>
</div>
