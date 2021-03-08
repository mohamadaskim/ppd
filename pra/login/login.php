<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$url = $_SESSION['redir'] ?? '';
$now = date("Y-m-d H:i:s");
$servername = "localhost";
$username = "root";
$password = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=pra", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['pengguna']);
    $password = htmlspecialchars($_POST['password']);

    //CHECK TABLE PEGAWAI
    $kuri = $conn->prepare("SELECT username,nama FROM users WHERE username = ? AND password = ? LIMIT 1");
    $kuri->execute([$username,$password]);
    $user = $kuri->fetch(PDO::FETCH_ASSOC);
        if(!$user){
            //TAK JUMPA USER
                   $error = "<font color=\"#ff000\">* Ralat : Kombinasi ID Pengguna dan Kata Laluan salah</font>";
     $_SESSION['ERRMSG_ARR'] = $error;
            header('Location: ../login');
            exit();
        }
    //KALAU INGAT SAYA
$_SESSION['ERRMSG_ARR'] = "";
    $_SESSION['SESS_USERNAME'] = $user['username'];
    $_SESSION['SESS_KODSEKOLAH'] = $user['username'];
    $_SESSION['SESS_REALNAME'] = $user['nama'];
    $_SESSION['SESS_USERLEVEL'] = 10;
 
header('Location: /ppdkluang/pra');

    exit();
}

?>