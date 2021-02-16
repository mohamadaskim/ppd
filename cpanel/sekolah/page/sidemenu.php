<?php
//MENU LINK
$kuri = $PPD->query("SELECT `http`,tajuk FROM http WHERE unit = 'online' AND papar = 'Ya'");
$menu = $kuri->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="text-center p-4">
    <a href="."><img src="cpanel/img/logoppddark.png" alt="logoppd" class="w-100"></a>
</div>
<div class="text-orange pl-4 menu-header">PANEL KAWALAN</div>
<div id="menu-panel">
    <div>
        <a href="cpanel/sekolah/inbox" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>Surat Siaran</div>
        </a>
    </div>
    <div>
        <a href="sichek/urus" class="btn-collapse">
            <div class="menu-besau"><i class="fa fa-map-marker" aria-hidden="true"></i>Sinergi Check-In</div>
        </a>
    </div>
    <div>
        <a href="https://www.mppdm.edu.my/authsekolah/index.php" class="btn-collapse">
            <div class="menu-besau"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Dialog Prestasi</div>
        </a>
    </div>
	    <div>
        <a href="../icakna" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>icakna</div>
        </a>
    </div>
	    <div>
        <a href="../penilaian" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>penilaian</div>
        </a>
    </div>
	    <div>
        <a href="../spp2" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>spp2</div>
        </a>
    </div>
            <div>
        <a href="../penarafan" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>penarafan</div>
        </a>
    </div>
            <div>
        <a href="../kesihatan" class="btn-collapse <?= ($page=='inbox'?'btn-sidemenu-active':'') ?>">
            <div class="menu-besau"><i class="fa fa-envelope-o" aria-hidden="true"></i>kesihatan</div>
        </a>
    </div>

</div>
<div class="text-orange pl-4 menu-header mt-2">PAUTAN</div>
<div id="menu-panel">
    <div>
        <a href="#" class="btn-collapse menu-collapse">
            <div class="menu-besau"><i class="fa fa-rocket" aria-hidden="true"></i> Aplikasi Dalam Talian</div>
            <i class="fa fa-caret-right fa-ani" aria-hidden="true"></i>
        </a>
        <div class="menu-kecik">
            <?php foreach($menu as $m){ echo'
            <a href="'.$m['http'].'"><i class="fa fa-circle" aria-hidden="true"></i>'.$m['tajuk'].'</a>';
            } ?>
        </div>
    </div>
</div>
<div class="text-orange pl-4 menu-header mt-2">PENGGUNA</div>
<?php if(defined('USER')) { ?>
<nav class="nav flex-column menu-list">
    <div class="text-center profil-pic mb-2">
        <img src="<?= (LEVEL>49?'/staf/'.GAMBAR:'https://emisonline.moe.gov.my/images/GambarSekolah/JOHOR/'.USER.'_LOGO.JPG') ?>" alt="" class="pro-pic">
    </div>
    <a class="nav-link a-light text-warning font-weight-bold" href="https://<?= $_SERVER['HTTP_HOST'] ?>/auth/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Keluar</a>
</nav>
<?php } else { ?>
<nav class="nav flex-column menu-list">
    <a class="nav-link a-light font-weight-bold <?php echo ($page=='piagam'?'active':'')?>" href="https://<?= $_SERVER['HTTP_HOST'] ?>/auth/?redir=<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>"><i class="fa fa-sign-in" aria-hidden="true"></i>Log Masuk</a>
</nav>
<?php } ?>