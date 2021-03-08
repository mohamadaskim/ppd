<?php  
$connect = mysqli_connect("localhost","mgkkjoho","k+MJX\.8)C@4vM@*","mgkkjoho_pipk");   
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $tajuk = mysqli_real_escape_string($connect, $_POST["tajuk"]);  
      $perkara = mysqli_real_escape_string($connect, $_POST["perkara"]);  

      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE a_mohon   
           SET b_tajuk='$tajuk',   
           b_isi='$perkara'
           WHERE ID='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO a_mohon(b_tajuk, b_isi)  
           VALUES('$tajuk', '$perkara');  
           ";  
           $message = 'Data Inserted';  
      }  
      mysqli_query($connect, $query);  
      echo $output;  
 }  
 ?>