<?php
$servername = "localhost";
$username = "u418527094_bigdata";
$password = 'ppdklu@ng.J030';

try {
    $DATA = new PDO("mysql:host=$servername;dbname=u418527094_bigdata", $username, $password);
    // set the PDO error mode to exception
    $DATA->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>