  <?php  
 //fetch.php  
$connect = mysqli_connect("localhost","mgkkjoho","k+MJX\.8)C@4vM@*","mgkkjoho_pipk");  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT *,b_tajuk as tajuk,b_isi as perkara FROM a_mohon WHERE ID = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>