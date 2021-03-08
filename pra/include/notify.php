<?php 




function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime($datetime);
    $ago = new DateTime;
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' left' : 'just now';
}



function notify($connect,$conn,$id){
 $kodsekolah=$_SESSION['SESS_KODSEKOLAH'];
 $username=$_SESSION['SESS_USERNAME'];
 $output = '';
 $bil='';
 $query = "SELECT * FROM `data_notifikasi`";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();

 foreach($result as $row)
 {
$sql=$row['select_table'];
if($row['select_where']=='kodsekolah' || $row['select_where']=='KODSEKOLAH') $sql=$row['select_table']." where ".$row['select_where']."='$kodsekolah'";
if($row['select_where']!='kodsekolah' && $row['select_where']!='' &&  $row['select_where']!='KODSEKOLAH') $sql=$row['select_table']." where ".$row['select_where']."='$username'";
$q = mysqli_query($conn,$sql);
$count = mysqli_num_rows($q);
if($count==0){
$bil+=1;

$output .= '              <li>';
$output .= '                <a href="'.$row["url"].'">';

if($row["jenis"]==3) $output .= '                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>';
if($row["jenis"]==2) $output .= '                  <span class="label label-warning"><i class="fa fa-bell"></i></span>';
if($row["jenis"]==1) $output .= '                  <span class="label label-success"><i class="fa fa-plus"></i></span>';

$output .= '                  '.$row["tajuk"].'';
$output .= '                  <span class="small italic">'. time_elapsed_string($row["masa"]).'</span>';
$output .= '                  </a>';
$output .= '              </li>';


//if($id==$row["kod"])  $output .= ' selected="selected" ';

}

 }
$header='<a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-bell-o"></i>
              <span class="badge bg-warning">'.$bil.'</span>
              </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">Notifikasi Terkini</p>
              </li>';
$footer='<li>
                <a href="index.php#">See all notifications</a>
              </li>
            </ul>';

$show=$header.$output.$footer;


 return $show;
}



function namakod($kod){
if($kod=='individu')  $ret='INDIVIDU';
if($kod=='kelompok')  $ret='KELOMPOK';
if($kod=='kelas_ganti')  $ret='KELAS GANTI';
if($kod=='konsultasi')  $ret='KONSULTASI';
if($kod=='program')  $ret='PROGRAM';
if($kod=='perhimpunan')  $ret='PERHIMPUNAN';
if($kod=='mesyuarat')  $ret='MESYUARAT';
if($kod=='lapor_sesi')  $ret='LAPOR SESI';
if($kod=='kertaskerja')  $ret='KERTAS KERJA';
if($kod=='dokumentasi')  $ret='DOKUMENTASI';
if($kod=='pengurusan_bilik')  $ret='PENGURUSAN BILIK BK';
if($kod=='lain-lain')  $ret='CUTI';
if($kod=='cakna')  $ret='ZIARAH CAKNA';
if($kod=='program_luar')  $ret='PROGRAM LUAR AGENSI';
if($kod=='program_ppd')  $ret='PROGRAM PPD';
if($kod=='program_jpn')  $ret='PROGRAM JPN';
if($kod=='program_kpm')  $ret='PROGRAM KPM';
if($kod=='lain_sumbangan')  $ret='LAIN SUMBANGAN SEKOLAH';


return $ret;
}







 ?>

      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>e<span>Tadika</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
 
          <!-- settings end -->
<?php 
function fill_log($conn,$username)
{ 
  //$kodsekolah=$_SESSION['SESS_KODSEKOLAH'];
 //$sql="SELECT *,SUBSTR(perkara, 1, 40) as perkara2 FROM `data_log` where username='$username' and `tarikh` = CURDATE()";


//$result = mysqli_query($conn,$sql);
//$count = mysqli_num_rows($result);
//if($count!=0)return $count;

}

       
    
        ?>		  
		         <!-- inbox dropdown start-->

          <!-- inbox dropdown end -->  
		  
		  
          <!-- inbox dropdown start-->
          <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-theme"><!--1--></span>
              </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green"><!--1 Message--></p>
              </li>
              <li>
                <a href="aduan.php">
                  <span class="photo"><img alt="avatar" src="https://www.pngkey.com/png/full/114-1149847_avatar-unknown-dp.png"></span>
                  <span class="subject">
                  <span class="from">Administrator-Help</span>
                  <span class="time">3/4/2020</span>
                  </span>
                  <span class="message">
                  ada error/aduan, klik sini
                  </span>
                  </a>
              </li>
              
              <li>
                <a href="mail.php">Open Inbox</a>
              </li>
            </ul>
          </li>
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
          <li id="header_notification_bar" class="dropdown">

              <?php echo notify($connect,$conn,''); ?>

          </li>
          
                    <li id="header_notification_bar" class="dropdown">

                        

          </li>
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>

      
      <div class="top-menu">
          

          
        <ul class="nav pull-right top-menu">
 
          <li><a class="logout" href="login/logout.php">Logout</a></li>
        </ul>
      </div>
      
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   function history(){
       var selectBox = document.getElementById("historyy");
       var selectedValue = selectBox.options[selectBox.selectedIndex].value;

var tahun=selectedValue;
        $.ajax({
            type : "GET",
            url : "year.php",
            data : {year: tahun},
            cache : false,
            success : function(html)
            {
               //alert(html);
            }
        });

document.location.reload(true);
  } 

</script>