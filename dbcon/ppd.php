<?php
$servername = "localhost";
$username = "root";
$password = '';

try {
    $PPD = new PDO("mysql:host=$servername;dbname=ppdkluang", $username, $password);
    // set the PDO error mode to exception
    $PPD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>