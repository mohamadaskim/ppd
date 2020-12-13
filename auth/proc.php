<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$url = $_SESSION['redir'] ?? '';
$now = date("Y-m-d H:i:s");
$servername = "localhost";
$username = "root";
$password = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=ppdkluang", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['pengguna']);
    $password = md5(htmlspecialchars($_POST['password']));

    //CHECK TABLE PEGAWAI
    $kuri = $conn->prepare("SELECT username FROM users WHERE username = ? AND password = ? LIMIT 1");
    $kuri->execute([$username,$password]);
    $user = $kuri->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        // CHECK SEKOLAH KALAU BUKAN PEGAWAI
        $kuri = $conn->prepare("SELECT username FROM users_sekolah WHERE username = ? AND password = ? LIMIT 1");
        $kuri->execute([$username,$password]);
        $user = $kuri->fetch(PDO::FETCH_ASSOC);
        if(!$user){
            //TAK JUMPA USER
            header('Location: .');
            exit();
        }
    }
    //KALAU INGAT SAYA
    if(isset($_POST['ingat'])){
        $uid = uniqid(md5($user['username']));
        setcookie('ppdktoken',$uid,time() + (86400 * 90),'/',null,null,TRUE);
        $ins = $conn->prepare("INSERT INTO users_token (token,username,gentime) VALUES (?,?,?)");
        $ins->execute([$uid,$user['username'],$now]);
    }
    $_SESSION['user-ppdkluang'] = $user['username'];

    if(isset($_SESSION['redir'])){
        unset($_SESSION['redir']);
        header('Location: '.$url);
    } else {
        header('Location: /ppdkluang/cpanel/sekolah/');
    }
    exit();
}