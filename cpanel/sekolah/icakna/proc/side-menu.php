<?php
//PASTIKAN ADA AUTH DAN FUNCTION
$kuri = $PPD->query("SELECT DISTINCT(users.sektor) as sektor FROM muatturun INNER JOIN users ON muatturun.owner = users.username ORDER BY sektor ASC");
$sect = $kuri->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="card shadow-sm">
    <div class="list-group list-group-flush inbox-menu">
        <a href="index.php" class="list-group-item list-group-item-action <?= ($view=='1'?'active-oren':'') ?>">
            <i class="fa fa-th" aria-hidden="true"></i>
            <span>DASHBOARD </span>
        </a>
        <a href="senarai.php" class="list-group-item list-group-item-action <?= ($view=='2'?'active-oren':'') ?>">
            <i class="fa fa-list" aria-hidden="true"></i> SENARAI DIDAFTAR
        </a>
        <a href="edit.php" class="list-group-item list-group-item-action <?= ($view=='3'?'active-oren':'') ?>">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> DAFTAR
        </a>
        
    </div>
</div>
