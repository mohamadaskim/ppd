<?php  
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost","mgkkjoho","k+MJX\.8)C@4vM@*","mgkkjoho_pipk");  
      $query = "SELECT *,b_tajuk as tajuk,b_isi as perkara FROM a_mohon WHERE ID = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Tajuk</label></td>  
                     <td width="70%">'.$row["tajuk"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Perkara</label></td>  
                     <td width="70%">'.$row["perkara"].'</td>  
                </tr>  
 
           ';  
      }  
      $output .= '  
           </table>  
           <a  onclick=return confirm("Are you sure?") href="permohonan.php?sah='.$_POST['employee_id'].'" ><input class="btn btn-success btn-sm pull-left" type="submit"   type="button" name="submit" value="Sahkan Permohonan"/></a> 
      </div>  
      ';  
      echo $output;  
 }  
 ?>