<?php
$servername = "localhost";
$username = "u418527094_data";
$password = 'vmQU6n^$GR*nIyNOMmpyH3He7';

try {
    $DATA = new PDO("mysql:host=$servername;dbname=u418527094_data", $username, $password);
    // set the PDO error mode to exception
    $DATA->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>