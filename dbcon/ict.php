<?php
$servername = "localhost";
$username = "u418527094_ict";
$password = 'vmQU6n^$GR*nIyNOMmpyH3He7';

try {
    $ICT = new PDO("mysql:host=$servername;dbname=u418527094_ict", $username, $password);
    // set the PDO error mode to exception
    $ICT->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>