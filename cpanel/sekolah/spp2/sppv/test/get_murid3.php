<?php session_start();  @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>
 <?php  
  $connect = mysqli_connect("localhost", "root", "", "ppdkluang"); 
 
 if(isset($_SESSION['SESS_NEGERI'])){
    if($_SESSION['SESS_NEGERI']!=1){
 $connect = mysqli_connect("localhost", "root", "", "ppdkluang"); 
    }
    else
    {
        
        
    }
 }
 
 
if(isset($_GET["term"])){
      $output = '';  
      $query = "SELECT * FROM `murid` WHERE `nokp` LIKE '".$_GET["term"]."'  limit 10";  
      $result = mysqli_query($connect, $query);  
        $rows = mysqli_fetch_array($result);

        // Important to echo the record in JSON format
echo $rows['nama'];
        // Important to stop further executing the script on AJAX by following line
   


}


if(isset($_GET["tahun"])){

      $output = "<option value=''>Semua Kelas</option>";  
      $query = "SELECT nama_kelas FROM `murid` WHERE `tingkatan` LIKE '".$_GET["tahun"]."' and kodsekolah= '".$_SESSION["SESS_KODSEKOLAH"]."' group by nama_kelas ";  
      $result = mysqli_query($connect, $query);  
        while($rows = mysqli_fetch_array($result))
{
        // Important to echo the record in JSON format
 $output .= '<option value="'.$rows["nama_kelas"].'" ';

   $output .= '">'.$rows["nama_kelas"].'</option>';
        // Important to stop further executing the script on AJAX by following line
  } 
echo $output;

}
if(isset($_GET["kelas"])){
 ?>  


[

 <?php  
  

      $output = '';  
      $query = "SELECT * FROM `murid` WHERE kodsekolah= 'JBD2047' and tingkatan like '%".$_GET["tingkatan"]."%' and nama_kelas like '%".$_GET["kelas"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '';  
	  $i = 1;
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
           {  
	
	   if ($i == mysqli_num_rows($result))
   {
	                   $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['nama'].'","nokp":"'.$row['nokp'].'","seoURI":"?u_ID='.$row['ID'].'"}';  

   }
   else{
                $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['nama'].'","nokp":"'.$row['nokp'].'","seoURI":"?u_ID='.$row['ID'].'"},';  
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


<?php } ?>