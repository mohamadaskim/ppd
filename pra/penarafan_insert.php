<?php




include 'sess.php';

//$cusers = count(glob(session_save_path() . '/*'));
//$cusers = count(scandir(ini_get("/var/cpanel/php/sessions/ea-php72")));
$cusers='';
//$i = 0;
//foreach (glob("var/cpanel/php/sessions/ea-php72") as $filename) {
//   $i++;
//}
//$cusers.= '-'.$i;

$kat=1;
if(isset($_GET['kat'])) $kat=$_GET['kat'];
$sql="SELECT * FROM `penarafan_perkara` where kategori=$kat";

if(isset($_GET['id'])) $sql="SELECT * FROM `penarafan_perkara` p inner join `penarafan_data` d on d.perkara_id=p.ID WHERE kodsekolah=? and `data_id` ='$_GET[id]'";
$kuri = $connect->prepare($sql);
$kuri->execute([USER]);
$surat = $kuri->fetchAll(PDO::FETCH_ASSOC);


function option1($id){


$dat="";
$dat.= '  <option value=>Sila Pilih</option>';
$dat.= '  <option ';
if($id=='1') $dat.= ' selected=selected ';
$dat.= ' value="1" ';
$dat.= '>Ada (Mematuhi)</option>';
$dat.= '  <option ';
if($id=='0') $dat.= ' selected=selected ';
$dat.= ' value="0" ';
$dat.= '>Tiada</option>';


return $dat;
}

function option2($id){

$dat="";
$dat.= '  <option  value="">Sila Pilih</option>';
$dat.= '  <option ';
if($id=='1') $dat.= ' selected=selected ';
$dat.= ' value="1" ';
$dat.= '>Perkhidmatan diteruskan</option>';
$dat.= '  <option ';
if($id=='0') $dat.= ' selected=selected ';
$dat.= ' value="0" ';
$dat.= '>Perkhidmatan ditamatkan</option>';

return $dat;

}
             ?>
  



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>eTadikaPPDKluang - Dashboard</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/cosmo/bootstrap.min.css" integrity="sha256-B2v3WDCH+olIjKaUMBXAZdwu1SYlEKs7eqroRv14atA=" crossorigin="anonymous">


  <!-- Bootstrap core CSS -->
  <?php include('include/headerp.php'); ?>


  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" integrity="sha256-b88RdwbRJEzRx95nCuuva+hO5ExvXXnpX+78h8DjyOE=" crossorigin="anonymous">

</head>

<style>

@media (min-width: 980px) {
    /*-----*/
  .hidden-desktop {
     display: none !important;
  }

}

    @media (max-width: 767px) {
  .hidden-desktop {
    display: inherit !important;
  }
  .visible-desktop {
    display: none !important;
  }
  .visible-phone {
    display: inherit !important;
  }
  .hidden-phone {
    display: none !important;
  }
}
</style>
<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <?php include('include/notify.php') ?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
     <?php include('include/menu.php') ?>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->

    <?php
  
// if(isset($_SESSION['individu_time']))
// {}
// else
// { $_SESSION['individu_time']=strtotime('now');   }
  
   
 
 

    ?>
     <section id="main-content">
      <section class="wrapper">

                <form class="card-body form-ada-proses" id="form" action="penarafan/proc/isi.php" method="GET">
                 <?php  if(isset($_GET['kat']))  {?><input type="hidden" name=kat value="<?= $_GET['kat'] ?>"> <?php } ?>
                 


    <h3 class="p-2 text-center bg-dark text-light">INSTRUMEN PEMATUHAN DASAR (PENARAFAN BINTANG) <br>INSTITUSI PENDIDIKAN SWASTA </h3>

<div class="form-group form-row">

                        <div class="col-4">
                            <label for="hingga">TARIKH / MASA</label>
<input type="datetime-local" required class="form-control" name='tarikh' value="19/01/2021 12:20 AM" >
                        </div>


                        <div class="col-8">
                            <label for="hingga">NAMA PEGAWAI PEMERIKSA</label>
<input type="text"  required  class="form-control" name='pegawai' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                         <div class="col-4">
                            <label for="hingga">NAMA INSTITUSI</label>
<input type="text"  required  class="form-control" name='namainstitusi' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; else echo $realname  ?>">
                        </div>
                        <div class="col-8">
                            <label for="hingga">ALAMAT INSTITUSI</label>
<input type="text"  required  class="form-control" name='alamatinstitusi' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div>
                        <div class="col-2">
                            <label for="hingga">DAERAH</label>
<input type="text"  required  class="form-control" name='daerah' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-2">
                            <label for="hingga">NEGERI</label>
<input type="text"  required  class="form-control" name='negeri' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-4">
                            <label for="hingga">NO TELEFON</label>
<input type="text"  required  class="form-control" name='telefon' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-4">
                            <label for="hingga">EMAIL</label>
<input type="email"  required  class="form-control" name='email' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-5">
                            <label for="hingga">NAMA PENGERUSI</label>
<input type="text"  required  class="form-control" name='namapengerusi' value="<?php if(isset($d['tempoh_mula'])) echo $d['tempoh_mula']; ?>" >
                        </div>

                        <div class="col-2">
                            <label for="hingga">KAUM</label>
<input type="text"  required  class="form-control" name='kaum' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-5">
                            <label for="hingga">LOKASI</label>
<input type="text"  required  class="form-control" name='lokasi' value="<?php if(isset($d['tempoh_tamat'])) echo $d['tempoh_tamat']; ?>" >
                        </div>
                        <div class="col-4">
                            <label for="hingga">NAMA GURU BESAR</label>
<input type="text"  required  class="form-control" name='namagb' value="<?php if(isset($d['syarikat'])) echo $d['syarikat']; ?>">
                        </div> 
                        <div class="col-2">
                            <label for="hingga">BIL MURID LELAKI</label>
<input type="text"  required  class="form-control" name='ml' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga"><small>BIL MURID PEREMPUAN</small></label>
<input type="text"  required  class="form-control" name='mp' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga">BIL GURU LELAKI</label>
<input type="text"  required  class="form-control" name='gl' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
                                                <div class="col-2">
                            <label for="hingga">BIL GURU PEREMPUAN</label>
<input type="text"  required  class="form-control" name='gp' value="<?php if(isset($d['murid'])) echo $d['murid']; ?>" >
                        </div>
<br><br><br><br><br>

    
<table class="table table-striped my-lh-1 text-center mb-0" >
            <thead class="bg-warning text-light">
                <tr>
                    <th  class="d-none d-md-table-cell">#</th>
                    <th >PERKARA</th>
                    <th ></th>
<th ></th>
                </tr>
               
            </thead>
            <tbody>

<?php





         $x=0;
         $submenushow='';


                foreach($surat as $s){
$x++;
                    $tajuk = htmlspecialchars($s['tajuk']);
                    $radio = htmlspecialchars($s['radio']);

$name = htmlspecialchars($s['ID']);
$data = htmlspecialchars($s['data']);
if(isset($s['value']))
{$datavalue = htmlspecialchars($s['value']);
$dataulasan = htmlspecialchars($s['ulasan']);
}
$dataid=$x;
$submenu=htmlspecialchars($s['kat_tajuk']);
                  //  include 'proc/kad-style.php';
?>


<?php 
if($submenushow!=$submenu) 
{$submenushow=$submenu;
    ?>
<tr>
                    <th  colspan ="4"  class="bg-info text-left align-top"><?=  substr($submenu, 3); ?></th>
                    
                </tr>
    <?php
}


if($data=='radio'){
    ?>
         <tr>
                    <th  rowspan="2"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
  for($i=1;$i<=$radio;$i++){

    ?>
    <th><label for="mula"></label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input type="radio"  required  <?php if(isset($datavalue) && $datavalue==$i) echo "checked"; ?>   name="data[<?=  $dataid; ?>]" value="<?=  $i; ?>">
        </th> 
    <?php
} ?>

<?php
}
if($data=='text'){
    ?>
         <tr>
                    <th  rowspan="2"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        
    </th> 
    <?php

}

if($data=='option1'){
    ?>
         <tr>

                    <th  rowspan="1"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
      <select name="data[<?=  $dataid; ?>]" required  class="form-control"><?php echo option1($datavalue); ?></select>  
    </th> 
    <?php

}
if($data=='option2'){
    ?>
         <tr>
                    <th  rowspan="1"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
       <select name="data[<?=  $dataid; ?>]"  class="form-control"><?php echo option2($datavalue); ?></select>   
    </th> 
    <?php

}


?>


                </tr>
                <?php if($data=='radio'){ ?>
                <tr>
                    <th  colspan="6"><textarea  placeholder="Ulasan sekiranya ada"  rows="1" name="datatext[<?=  $dataid; ?>]" class="form-control"><?php if(isset($dataulasan)) echo $dataulasan; ?></textarea> </th>
                </tr>
                <?php } ?>

                                <?php if($data=='text'){ ?>
                <tr>
                    <th  colspan="6"><input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>"><textarea  placeholder=""  rows="4" name="datatext[<?=  $dataid; ?>]" class="form-control"><?php if(isset($dataulasan)) echo $dataulasan; ?></textarea> </th>
                </tr>
                <?php } ?>


<?php



                } ?>


                </tbody>
        </table>


  
                    <div style="  margin: auto;
  width: 50%;
  padding: 10px;"><center>

                    <a href="/ppdkluang/cpanel/sekolah/ict/<?php echo $view.$page; ?>"  ><button type="button" class="btn btn-back btn-secondary"><i class="fa fa-undo" aria-hidden="true"></i> KEMBALI</button></a>    

 <button  type="submit" class="btn btn-success" name="kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i> SIMPAN & CETAK</button>
</center>
                </div>      



   </form>
        <!-- /row -->
        <!-- DATE TIME PICKERS -->
   
        <!-- row -->
        <!--  TIME PICKERS -->
        
        <!-- row -->
        <!--ADVANCED FILE INPUT-->
        
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <?php include('include/footer.php'); ?>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
<?php include('include/js.php'); ?>
  <script type="text/javascript" src="/epipk/admin/lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="/epipk/admin/lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Selamat Datang Ke eRekod!',
        // (string | mandatory) the text inside the notification
        text: '<?php echo $realname; ?>',
        // (string | optional) the image to display on the left
        image: '/e/images/profile/thumbs/<?php echo $filesession["img"]."?".Date("U"); ?>',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  
    <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'sila semak SSDM!',
        // (string | mandatory) the text inside the notification
        text: '<a href="https://ssdm.moe.gov.my"  target="_blank">klik sini</a>',
        // (string | optional) the image to display on the left
        image: 'https://www.pendidik2u.my/wp-content/uploads/2017/07/SSDM-2.0.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: true,
        // (int | optional) the time you want it to be alive for before fading out
     
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  

  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
<?php  ?>