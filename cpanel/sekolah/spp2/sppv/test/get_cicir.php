<?php session_start(); include 'db.php'; @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>


 [

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

      $output = '';  
      $query = "SELECT * FROM `murid_cicir` WHERE (`NOKP` LIKE '%".$_GET["term"]."%' or NAMA LIKE '%".$_GET["term"]."%'  ) and KODSEKOLAH= '".$_GET["KODSEKOLAH"]."'   ";  
      $result = mysqli_query($connect, $query);  
      $output = '';  
	  $i = 1;
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
           {  
	
	   if ($i == mysqli_num_rows($result))
   {
	                   $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['NAMA'].'","nokp":"'.$row['NOKP'].'","seoURI":"?u_ID='.$row['ID'].'"}';  

   }
   else{
                $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['NAMA'].'","nokp":"'.$row['NOKP'].'","seoURI":"?u_ID='.$row['ID'].'"},';  
   }
   
   $i ++;
		   }  
      }  
      else  
      {  
           $output .= '';  
      }  
      $output .= '';  
      echo $output;  
 
 ?>  

]

