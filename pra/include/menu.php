<?php 
if($userlevel==30) include('include/menu_pgb.php'); 
else
{
//$filename= 'basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])';
//$result1 = mysqli_query($conn,"SELECT * from users  where username='$username'");
//$filesession=mysqli_fetch_array($result1);
//if(empty($_SESSION['profile'])) $_SESSION['profile']=Date('U');

?>
<div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php">

<?php if(isset($filesession['img']) && $filesession['img']!=''){ ?><img src="images/profile/thumbs/<?php echo $filesession['img'].'?='.$_SESSION['profile'].''; ?>" class="img-circle" width="80" height="80"> <?php } else { ?><img src="images/profile/unknown.png" class="img-circle" width="80"><?php } ?>


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
              <i class="fa fa-book"></i>
              <span>Penarafan Bintang</span>
              </a>
            <ul class="sub">
              <li><a href="senarai_aktiviti.php">Semak Penarafan Bintang</a></li>
			  <li><a href="klien.php">Isi Penarafan Bintang</a></li>
			  
            </ul>
          </li>






		  
		  		            
		            <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Data Murid / Profile</span>
              </a>
            <ul class="sub">
              <li><a href="data_murid.php">Data Murid</a></li>
              <li><a href="profile.php">Profile</a></li>
			  <li><a href="tukar_katalaluan.php">Tukar Kata Laluan</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
      
      <?php } ?>