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
 
 
if(isset($_GET["term"])){
      $output = '';  
      $query = "SELECT `NAMAPENJAGA1`, `NOTELPENJAGA1`, `NAMAPENJAGA2`, `NOTELPENJAGA2`,ALAMATMURID,POSKODMURID,BANDAR FROM `murid_cicir` WHERE `NOKP` LIKE '".$_GET["term"]."'  limit 10";  
      $result = mysqli_query($connect, $query);  
        $rows = mysqli_fetch_array($result);

        // Important to echo the record in JSON format




?>

<table cellpadding="5" cellspacing="0" border="1" width="60%" style="padding-left:50px;">
  <tr>
    <td colspan="2" align="center">PENJAGA 1</td>
    <td colspan="2" align="center">PENJAGA 2</td>
  </tr>
  <tr>
    <td width="16%">Nama</td>
    <td width="33%"><?php echo $rows['NAMAPENJAGA1']; ?></td>
    <td width="16%">Nama</td>
    <td width="35%"><?php echo $rows['NAMAPENJAGA2']; ?></td>
  </tr>
  <tr>
    <td>No Tel</td>
    <td><?php echo $rows['NOTELPENJAGA1']; ?></td>
    <td>No Tel</td>
    <td><?php echo $rows['NOTELPENJAGA2']; ?></td>
  </tr>
  <tr>
    <td colspan="4">Alamat Murid : <?php echo $rows['ALAMATMURID'].', '.$rows['POSKODMURID'].', '.$rows['BANDAR']; ?></td>
  </tr>
</table>


<?php



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
      $query = "SELECT *,SUBSTR(nama,1,35) as nama2 FROM `murid` WHERE kodsekolah= '".$_SESSION["SESS_KODSEKOLAH"]."' and tingkatan like '%".$_GET["tingkatan"]."%' and nama_kelas like '%".$_GET["kelas"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '';  
	  $i = 1;
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
           {  
	
	   if ($i == mysqli_num_rows($result))
   {
	                   $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['nama2'].'","nokp":"'.$row['nokp'].'","seoURI":"?u_ID='.$row['ID'].'"}';  

   }
   else{
                $output .= '{"ID":"'.$row['ID'].'","nama":"'.$row['nama2'].'","nokp":"'.$row['nokp'].'","seoURI":"?u_ID='.$row['ID'].'"},';  
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