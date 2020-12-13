<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$_SESSION['redir'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//CHECK SESSION DULU
if(isset($_SESSION['user-ppdkluang'])){
    define('USER',$_SESSION['user-ppdkluang']);
}

//KALAU XDE SESSION CHECK COOKIE
else if(isset($_COOKIE['ppdktoken'])){
    
    //CONNECT KE DATABASE (TAK PERLU INCLUDE)
    $servername = "localhost";
    $username = "u418527094_ppdkluang";
    $password = 'vmQU6n^$GR*nIyNOMmpyH3He7';
    
    try {
        $auth = new PDO("mysql:host=$servername;dbname=u418527094_ppdkluang", $username, $password);
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
    }
}
//KALAU DUA2 XDE DIA TERUS MASUK PAGE TANPA LOGIN
//KALAU SEMUA OK PENGGUNA BOLEH GUNA CONST 'USER' UTK PANGGIL DATABASE
//SILA INCLUDE DATABASE SENDIRI SELEPAS SCRIPT INI BERJALAN