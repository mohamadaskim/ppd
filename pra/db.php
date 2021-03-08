<?php


   if($_SESSION['SESS_USERNAME']==''){
       header("location: ../pra/login/");

exit;
   }



   
   $dbselected='pra';
$conn=mysqli_connect("localhost","root","");
$dbb=mysqli_select_db($conn,$dbselected);

$connect = new PDO("mysql:host=localhost;dbname=$dbselected", "root", "")or die ("Pengkalan Data Tidak Dapat Dipilih.");  
/// session negeri
?>
