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
        header("location: /e/login")

?>
