<?php session_start();  @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>
 [

 <?php  
  $connect = mysqli_connect("localhost", "root", "", "ppdkluang"); 
 

      $output = '';  
      $query = "SELECT *,KodSekolah ID FROM `tssekolah` WHERE (`NamaSekolah` LIKE '%".$_GET["term"]."%' or KodSekolah LIKE '%".$_GET["term"]."%'  )   limit 10";  
      $result = mysqli_query($connect, $query);  
      $output = '';  
	  $i = 1;
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
           {  
	
	   if ($i == mysqli_num_rows($result))
   {
	                   $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['NamaSekolah'].'","nokp":"'.rtrim($row['KodSekolah'], ' ').'","seoURI":"?u_ID='.$row['ID'].'"}';  

   }
   else{
                $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['NamaSekolah'].'","nokp":"'.rtrim($row['KodSekolah'], ' ').'","seoURI":"?u_ID='.$row['ID'].'"},';  
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

