<?php
    require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/auth.php");
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/sekolah.php");
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/proc/function.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <base href = "https://ppdkluang.edu.my" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Panel Pengurusan Sekolah Portal PPD Kluang">
    <meta property="og:title" content="cPanel Sekolah PPDKluang" />
    <meta property="og:url" content="https://www.ppdkluang.edu.my/cpanel" />
    <meta property="og:description" content="Panel Pengurusan Sekolah Portal PPD Kluang">
    <meta property="og:image" content="https://www.ppdkluang.edu.my/ogpic.jpg">

    <link rel="manifest" href="cpanel/sekolah/site.webmanifest?v=1">
    <link rel="apple-touch-icon" sizes="180x180" href="cpanel/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="cpanel/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="cpanel/favicon-16x16.png">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#FF7518">
    <meta name="msapplication-TileColor" content="#FF7518">
    <meta name="theme-color" content="#FF7518">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/cosmo/bootstrap.min.css" integrity="sha256-B2v3WDCH+olIjKaUMBXAZdwu1SYlEKs7eqroRv14atA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" integrity="sha256-b88RdwbRJEzRx95nCuuva+hO5ExvXXnpX+78h8DjyOE=" crossorigin="anonymous" />
    <link rel="stylesheet" href="cpanel/css/styles.css?v=1.7">
    <title>Panel Pengurusan Sekolah Portal PPD Kluang</title>
  </head>
  <body>
    <div class="sidemenu d-block d-lg-none">
      <div class="menu blackpastel shadow-lg">
          <button class="close-sidemenu"><i class="fa fa-bars" aria-hidden="true"></i></button>
          <div class="menu-wrapper">
            <?php include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/page/sidemenu.php"); ?>
          </div>
      </div>
    </div>
    <div class="wrapper">
        <div class="menu blackpastel shadow-sm d-none d-lg-block">
          <div class="menu-wrapper">
            <?php include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/page/sidemenu.php"); ?>
          </div>
        </div>