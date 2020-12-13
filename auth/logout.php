<?php
session_start();
if(isset($_COOKIE['ppdktoken'])){
    
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
    
    $kuri = $conn->prepare("DELETE FROM users_token WHERE token = ?");
    $kuri->execute([$_COOKIE['ppdktoken']]);
    
    setcookie('ppdktoken','',time() - 3600,'/',null,null,TRUE);
}
unset($_SESSION['user-ppdkluang']);
session_destroy();
header('Location: https://'.$_SERVER['HTTP_HOST']);
exit();