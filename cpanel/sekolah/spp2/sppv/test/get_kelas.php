<?php session_start();  @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>
 <?php  
  $connect = mysqli_connect("localhost", "mgkkjoho", "k+MJX\.8)C@4vM@*", "mgkkjoho_kaunseling"); 
 
 if(isset($_SESSION['SESS_NEGERI'])){
    if($_SESSION['SESS_NEGERI']!=1){
 $connect = mysqli_connect("localhost", "mgkkjoho", "k+MJX\.8)C@4vM@*", "mgkkjoho_kaunselingother"); 
    }
    else
    {
        
        
    }
 }
 
 




if(isset($_GET["tahun"])){
 ?>  


[

 <?php  
  

      $output = '';  
      $query = "SELECT kelas as nama, kelas as kod FROM `kelas` WHERE `nama_tingkatan` LIKE '".$_GET["tahun"]."' and kodsekolah= '".$_SESSION["SESS_KODSEKOLAH"]."' ";  
      $result = mysqli_query($connect, $query);  
      $output = '';  

 
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
           {  
	

	                   $output .= '{"kod":"'.$row['kod'].'","nama":"'.$row['nama'].'"},';  



   

		   }  
  
  
      $output .= '';  
	  $output=rtrim($output,",");
      echo $output; 
 
 ?>  

]


<?php } ?>