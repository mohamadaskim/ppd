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
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Senarai Institut Rakan Strategik dan Awam</h3>
        <!-- SIMPLE TO DO LIST -->

        <!--  row -->
        <!-- COMPLEX TO DO LIST -->
        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h5><i class="fa fa-tasks"></i>Senarai Rakan Strategik</h5>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-content">
                  <ul class="task-list">

 <?php 

$a_mohons = mysqli_query($con,"SELECT * FROM `university` where u_rakan='r'");

WHILE($a_show=mysqli_fetch_array($a_mohons,MYSQLI_ASSOC)){
              ?>

                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><?php echo $a_show['u_code']; ?> - <?php echo $a_show['u_nama']; ?></span>

                          <?php 
if($a_show['u_rakan']=='r'){
$r=1;
}
else
{
$r=0;
}
if($a_show['u_cat']=='a'){
$cat='a';
}
else
{
$cat='s';
}


                          ?>
                          <?php if($r==1){ ?><span class="badge bg-theme">Rakan Strategik</span>  <?php } ?>
                          
                         <?php if($cat=='a'){ ?><span class="badge bg-warning">Awam</span> <?php }else { ?>
                         <span class="badge bg-success">Swasta</span> <?php } ?>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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
               <!-- <div class=" add-task-row">
                  <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Sahkan Permohonan</a>
                  <a class="btn btn-default btn-sm pull-right" href="todo_list.html#">See All </a>
                </div>-->
              </div>
            </section>
          </div>
          <!-- /col-md-12-->
        </div>
        <!-- /row -->

        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h5><i class="fa fa-tasks"></i>Senarai Institut Awam</h5>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-content">
                  <ul class="task-list">

 <?php 

$a_mohons = mysqli_query($con,"SELECT * FROM `university` where u_rakan is null");

WHILE($a_show=mysqli_fetch_array($a_mohons,MYSQLI_ASSOC)){
              ?>

                    <li>
                      <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="" />
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><?php echo $a_show['u_code']; ?> - <?php echo $a_show['u_nama']; ?></span>

                          <?php 
if($a_show['u_rakan']=='r'){
$r=1;
}
else
{
$r=0;
}
if($a_show['u_cat']=='a'){
$cat='a';
}
else
{
$cat='s';
}


                          ?>
                          <?php if($r==1){ ?><span class="badge bg-theme">Rakan Strategik</span>  <?php } ?>
                          
                         <?php if($cat=='a'){ ?><span class="badge bg-warning">Awam</span> <?php }else { ?>
                         <span class="badge bg-success">Swasta</span> <?php } ?>
                        <div class="pull-right hidden-phone">
                          <button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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
                <!--<div class=" add-task-row">
                  <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Sahkan Permohonan</a>
                  <a class="btn btn-default btn-sm pull-right" href="todo_list.html#">See All </a>
                </div>-->
              </div>
            </section>
          </div>
          <!-- /col-md-12-->
        </div>

        <!-- SORTABLE TO DO LIST -->
        
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

</body>

</html>
