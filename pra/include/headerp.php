<?php
//session_start(); 
include 'db.php'; 
@$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; 
@$username=$_SESSION['SESS_USERNAME']; 
@$userlevel=$_SESSION['SESS_USERLEVEL']; 
@$realname=$_SESSION['SESS_REALNAME']; 

?>


  <link href="admin/img/favicon.png" rel="icon">
  <link href="admin/img/apple-touch-icon.png" rel="apple-touch-icon">


<link href="admin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="admin/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="admin/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="admin/css/style.css" rel="stylesheet">
  <link href="admin/css/style-responsive.css" rel="stylesheet">