<?php
//PASTIKAN ADA AUTH DAN FUNCTION
$kuri = $PPD->query("SELECT DISTINCT(users.sektor) as sektor FROM muatturun INNER JOIN users ON muatturun.owner = users.username ORDER BY sektor ASC");
$sect = $kuri->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="card shadow-sm">
    <div class="list-group list-group-flush inbox-menu">
        <a href="/ppdkluang/cpanel/sekolah/ict/" class="list-group-item list-group-item-action <?= ($view=='1'?'active-oren':'') ?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>DASHBOARD </span>
        </a>
        <a href="/ppdkluang/cpanel/sekolah/ict/senarai.php" class="list-group-item list-group-item-action <?= ($view=='2'?'active-oren':'') ?>">
            <i class="fa fa-envelope-open" aria-hidden="true"></i> SENARAI PERMOHONAN
        </a>
        <a href="/ppdkluang/cpanel/sekolah/ict/sah.php" class="list-group-item list-group-item-action <?= ($view=='3'?'active-oren':'') ?>">
            <i class="fa fa-ban" aria-hidden="true"></i> BELUM SAHKAN
        </a>
        
    </div>
</div>
