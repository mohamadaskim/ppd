<?php
$servername = "localhost";
$username = "u418527094_splj";
$password = 'vmQU6n^$GR*nIyNOMmpyH3He7';

try {
    $SPLJ = new PDO("mysql:host=$servername;dbname=u418527094_splj", $username, $password);
    // set the PDO error mode to exception
    $SPLJ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>