<?php
session_start(); 
include('../connection.php');

$notify = mysqli_query($con,"select (select count(ID) from u_mohon) u_mohon,(select count(ID) from a_mohon) a_mohon,(select count(ID) from buletin) buletin");
$s_notify = mysqli_fetch_array($notify ,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>ePIPK - Administrator</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="css/to-do.css">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
       <?php include 'header/header.php';?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include 'header/sidebar.php';?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->


<?php 
if(isset($_POST['submit'])){
  if (is_array($_POST['checkbox'])) {
    foreach($_POST['checkbox'] as $value){
     // echo $value;
      mysqli_query($con,"UPDATE `a_mohon` SET `b_auth` = '0' WHERE `a_mohon`.`ID` = '$value'");
    }
  } else {
    $value = $_POST['checkbox'];
   // echo $value;
          mysqli_query($con,"UPDATE `a_mohon` SET `b_auth` = '0' WHERE `a_mohon`.`ID` = '$value'");
  }

}
if(isset($_GET['del'])){
  $value=$_GET['del'];
   mysqli_query($con,"DELETE FROM `a_mohon` WHERE `a_mohon`.`ID` = '$value'");
}
if(isset($_GET['sah'])){
  $value=$_GET['sah'];
   mysqli_query($con,"UPDATE `a_mohon` SET `b_auth` = '0' WHERE `a_mohon`.`ID` = '$value'");
}
?>


    <section id="main-content">

      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Senarai Permohonan Email</h3>
        <!-- SIMPLE TO DO LIST -->

        <!--  row -->
        <!-- COMPLEX TO DO LIST -->
        <div class="row mt">
          <div class="col-md-12">

<form method="POST" action="">

            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h5><i class="fa fa-tasks"></i> Permohonan Sekolah</h5>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-content">
                  <ul class="task-list">

 <?php 

$a_mohons = mysqli_query($con,"select um.b_auth,um.ID,s.NamaSekolah,b_out,um.KODSEKOLAH,u_code,SUBSTRING(b_tajuk,1,25) as b_tajuk from s_sekolah s,a_mohon um left join university u on u.ID=um.u_ID where s.KodSekolah=um.KODSEKOLAH ");

WHILE($a_show=mysqli_fetch_array($a_mohons,MYSQLI_ASSOC)){
              ?>

                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" <?php  if($a_show['b_auth']==0){ ?> disabled="disabled" <?php } ?> name="checkbox[]" class="list-child" value="<?php echo $a_show['ID']; ?>" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><a name="view" value="view" id="<?php echo $a_show['ID']; ?>" class="btn btn-info btn-xs">[<?php echo $a_show['KODSEKOLAH']; ?>]</a> <?php echo $a_show['NamaSekolah']; ?> - <?php echo $a_show['b_tajuk']; ?></span>
                        <span class="badge bg-theme"><?php echo $a_show['b_out']; ?></span>
                        <div class="pull-right hidden-phone">
                          <a  name="view" value="view" id="<?php echo $a_show['ID']; ?>" class="btn btn-success btn-xs view_data"><i class=" fa fa-check"></i></a>
                             <a  name="edit" value="Edit" id="<?php echo $a_show['ID']; ?>"  class="btn btn-primary btn-xs edit_data"><i class="fa fa-pencil"></i></a>
                          <a  onclick="return confirm('Are you sure?')" href="permohonan.php?del=<?php echo $a_show['ID']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
               


                        </div>
                      </div>
                    </li>

                  <?php } ?>
                  <!--  <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Extensive collection of plugins</span>
                        <span class="badge bg-warning">Cool</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Free updates always, no extra fees.</span>
                        <span class="badge bg-success">2 Days</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">More features coming soon</span>
                        <span class="badge bg-info">Tomorrow</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Hey, seriously, you should buy this Dashboard</span>
                        <span class="badge bg-important">Now</span>
                        <div class="pull-right">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </div>
                      </div>
                    </li>-->
                  </ul>
                </div>
                <div class=" add-task-row">
                  <input class="btn btn-success btn-sm pull-left" type="submit"   type="button" name="submit" value="Sahkan Permohonan"/>
                  
                  <a class="btn btn-default btn-sm pull-right" href="">See All </a>
                </div>
              </div>
            </section></form>
          </div>
          <!-- /col-md-12-->
        </div>
        <!-- /row -->
        <!-- SORTABLE TO DO LIST -->
        <div class="row mt mb">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h5><i class="fa fa-tasks"></i> Permohonan Buletin Institut</h5>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-content">
                  <ul id="sortable" class="task-list">


                               <?php 

$b_mohons = mysqli_query($con,"select um.ID,timstamp,u_code,SUBSTRING(b_tajuk,1,325) as b_tajuk from buletin um left join university u on u.ID=um.u_ID order by um.ID desc limit 4");

WHILE($b_show=mysqli_fetch_array($b_mohons,MYSQLI_ASSOC)){
              ?>   
                    <li class="list-primary">
                      <i class=" fa fa-ellipsis-v"></i>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="<?php echo $b_show['ID']; ?>" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><?php echo $b_show['u_code']; ?> - <?php echo $b_show['b_tajuk']; ?></span>
                        <span class="badge bg-theme"><?php echo $a_show['timstamp']; ?></span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs fa fa-check"></button>
                          <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                          <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                        </div>
                      </div>
                    </li>

             <?php } ?>          
                    <!--<li class="list-danger">
                      <i class=" fa fa-ellipsis-v"></i>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Extensive collection of plugins</span>
                        <span class="badge bg-warning">Cool</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs fa fa-check"></button>
                          <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                          <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                        </div>
                      </div>
                    </li>
                    <li class="list-success">
                      <i class=" fa fa-ellipsis-v"></i>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Free updates always, no extra fees.</span>
                        <span class="badge bg-success">2 Days</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs fa fa-check"></button>
                          <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                          <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                        </div>
                      </div>
                    </li>
                    <li class="list-warning">
                      <i class=" fa fa-ellipsis-v"></i>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">More features coming soon</span>
                        <span class="badge bg-info">Tomorrow</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs fa fa-check"></button>
                          <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                          <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                        </div>
                      </div>
                    </li>
                    <li class="list-info">
                      <i class=" fa fa-ellipsis-v"></i>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp">Hey, seriously, you should buy this Dashboard</span>
                        <span class="badge bg-important">Now</span>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs fa fa-check"></button>
                          <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                          <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                        </div>
                      </div>
                    </li>-->
                  </ul>
                </div>
                <div class=" add-task-row">
                  <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Sahkan Permohonan</a>
                  <a class="btn btn-default btn-sm pull-right" href="todo_list.html#">See All </a>
                </div>
              </div>
            </section>
          </div>
          <!--/col-md-12 -->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="todo_list.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="lib/tasks.js" type="text/javascript"></script>
  <script>
    jQuery(document).ready(function() {
      TaskList.initTaskWidget();
    });

    $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });
  </script>






<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Papar</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Papar</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Tajuk</label>  
                          <input type="text" name="tajuk" id="tajuk" class="form-control" />  
                          <br />  
                          <label>Perkara</label>  
                          <textarea name="perkara" id="perkara" class="form-control"></textarea>  
                          <br />  
                          
                          <input type="hidden" name="employee_id" id="employee_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"edit/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#tajuk').val(data.tajuk);  
                     $('#perkara').val(data.perkara);  
                     $('#employee_id').val(data.ID);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#tajuk').val() == "")  
           {  
                alert("Tajuk is required");  
           }  
           else if($('#perkara').val() == '')  
           {  
                alert("Perkara is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"edit/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');

                          //$('#employee_table').html(data);
                          location.reload();  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"edit/select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>


</body>

</html>
