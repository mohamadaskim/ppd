<?php 
session_start();

if(isset($_SESSION['SESS_USERNAME'])&&$_SESSION['SESS_USERNAME']!=''){
    //header("location: /e/"); exit;

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
  <title>eTadikaPPDKluang - Login</title>

  <!-- Favicons -->
  <link href="../admin/img/favicon.png" rel="icon">
  <link href="../admin/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../admin/css/style.css" rel="stylesheet">
  <link href="../admin/css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login"  method="POST" action="login.php">
        <h2 class="" style="	margin: 0;
	padding: 25px 20px;
	text-align: center;
	background: #4ecdc4;
	border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	color: #fff;
	font-size: 20px;
	font-weight: 300;">eTadikaPPDKluang</h2><?php if(isset($_SESSION['ERRMSG_ARR'])) echo $_SESSION['ERRMSG_ARR']; ?>
        <div class="login-wrap">
           
          <input type="text" class="form-control" placeholder="ID Pengguna" autofocus name="pengguna" required> 
          <br>
          <input type="password" class="form-control" placeholder="Kata laluan"  name="password" required>
          <label style=" margin: 5px 20px;" class="checkbox">
            <input type="checkbox"  value="remember-me" name="remember"> Ingat Saya
            <span class="pull-right">
            <!--<a data-toggle="modal" href="login.php#myModal"> Lupa Katalaluan?</a>-->
            </span>
            </label>
          <button name="login" class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Log Masuk</button>
          
          <hr>

          <div class="registration">
          
            <a class="" href="index.php">
              Daftar Akaun
              </a>
          </div>
          
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lupa Kata Laluan ?</h4>
              </div>
              <div class="modal-body">
                <p>Masukan E-Mail anda untuk reset semula kata laluan / ataupun hubungi JU.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-theme" disabled=disabled type="button">Hantar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../admin/lib/jquery/jquery.min.js"></script>
  <script src="../admin/lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="../admin/lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("background-login.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
