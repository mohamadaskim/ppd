<?php 

$filename= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
$result1 = mysqli_query($conn,"SELECT g.* from mgkkjoho_kaunseling.gbk g where g.nokp='$username'");
$filesession=mysqli_fetch_array($result1);

?>
<div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php">

<?php if($filesession['img']!=''){ ?><img src="/e/images/profile/thumbs/<?php echo $filesession['img'].''; ?>" class="img-circle" width="80" height="80"> <?php } else { ?><img src="/e/images/profile/unknown.png" class="img-circle" width="80"><?php } ?>


            </a></p>
          <h5 class="centered"><?php echo $realname; ?></h5>
          <li class="mt">
            <a  href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>


          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Laporan</span>
              </a>
            <ul class="sub">
        <li><a href="laporan.php">Cetak Laporan</a></li>

			 

            </ul>
          </li>


          <li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>Analisis / Impak</span>
              </a>
            <ul class="sub">
              <li><a href="javascript:window.open('i_impak_sekolah.php','Cetak','width=840,height=600')">Impak Bimbingan Kaunseling</a></li>
              <li><a href="javascript:window.open('/erekodv2/i_analisis_gbk.php?kodjpn=&id=sekolah&kodsekolah=<?php echo $kodsekolah; ?>','Cetak','width=940,height=600')">Analisis GBK</a></li>
              <li><a href="analisis_murid.php">Analisis Murid</a></li>
            </ul>
          </li>


		  

        </ul>
        <!-- sidebar menu end-->
      </div>