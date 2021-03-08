<?php
	session_start();
     //   include 'db.php';
	    unset($_SESSION['SESS_USERNAME']);
	    unset($_SESSION['SESS_USERLEVEL']);
       	unset($_SESSION['SESS_REALNAME']);
        unset($_SESSION['SESS_KODSEKOLAH']);
        unset($_SESSION['SESS_KODPPD']);
        unset($_SESSION['SESS_KODNEGERI']);
        unset($_SESSION['SESS_NEGERI']);
        unset($_SESSION['YEAR']);
        unset($_SESSION['versi']);
        unset($_SESSION['individu_time']);
        unset($_SESSION['klien']);
        unset($_SESSION['jpn_time']);
         unset($_SESSION['SESS_DB']);
         unset($_SESSION['SESS_NEGERI2']);
        //header("location: index.php")


setcookie("SESS", "", time() - 3600,'/',null,null,TRUE);  /* expire in 1 hour */
unset( $_COOKIE["SESS"] );
?>

<script>
 alert("You Are Logout");
   //alert("Login first");
window.location.href = '" . base_url() . "';
  window.location.href='index.php';
  </script>