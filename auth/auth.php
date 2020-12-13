<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$_SESSION['redir'] = "/ppdkluang/cpanel/sekolah/";

//CHECK SESSION DULU
if(isset($_SESSION['user-ppdkluang'])){
    define('USER',$_SESSION['user-ppdkluang']);
}

//KALAU XDE SESSION CHECK COOKIE
else if(isset($_COOKIE['ppdktoken'])){
    
    //CONNECT KE DATABASE (TAK PERLU INCLUDE)
    $servername = "localhost";
    $username = "root";
    $password = '';
    
    try {
        $auth = new PDO("mysql:host=$servername;dbname=ppdkluang", $username, $password);
        // set the PDO error mode to exception
        $auth->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    //CONNECT KE DATABASE (TAK PERLU INCLUDE)
    
    $token = $_COOKIE['ppdktoken'];
    $kuri = $auth->prepare("SELECT username FROM users_token WHERE token = ? LIMIT 1");
    $kuri->execute([$token]);
    $check = $kuri->fetch(PDO::FETCH_ASSOC)['username'];
    if($check){
        define('USER',$check);
        $_SESSION['user-ppdkluang'] = USER;
    } else {
        setcookie('ppdktoken','',time() - 3600,'/',null,null,TRUE);
        header('Location: /ppdkluang/auth');
        exit();
    }
}
//KALAU DUA2 XDE PERGI LOGIN PAGE
else {
    header('Location: /ppdkluang/auth');
    exit();
}

//KALAU SEMUA OK PENGGUNA BOLEH GUNA CONST 'USER' UTK PANGGIL DATABASE
//SILA INCLUDE DATABASE SENDIRI SELEPAS SCRIPT INI BERJALAN