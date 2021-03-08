<?php session_start(); include 'db.php'; @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>
 
        
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://ftkluang.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




<?php

$_SESSION['SESS_USERNAME']='PPD';




if(isset($_POST["s_klien"])&&$_POST["tarikh"]!=''){
 for($count = 0; $count < count($_POST["s_klien"]); $count++)
 {  
$nokpp=$_POST["s_klien"][$count];
$catatan=mysqli_real_escape_string($conn,$_POST["catatan"]);

$tarikh=$_POST["tarikh"];
$phpdate = strtotime($tarikh);
$mysqldate = date( 'Y-m-d', $phpdate );

          //  mysqli_query($conn,"INSERT INTO `spp`( `kodsekolah`, `tarikh`,catatan) VALUES ('$nokpp','$mysqldate',NULLIF('$catatan',''))");

 //$duplicated=mysqli_query($conn,"SELECT kodsekolah,MONTH(tarikh),count(id) a FROM `spp` where kodsekolah='$nokpp' group by kodsekolah,MONTH(tarikh) HAVING COUNT(id) > 1");
   //if(mysqli_num_rows($duplicated)!=0) {
     ?>
<script>
 alert("Duplicated Detected <?php echo $nokpp; ?>");
   //alert("Login first");
window.location.href = '" . base_url() . "';
  window.location.href='http://ftkluang.com/spp/';
  </script>
<?php
//}
 }
 
 
     ?>
<script>
 alert("Tambah Berjaya");
   //alert("Login first");
window.location.href = '" . base_url() . "';
  window.location.href='http://ftkluang.com/spp/semuacari.php';
  </script>
<?php
 
}




?>


       <script>











function showUser(id) {
   //line added for the var that will have the result

    var result = false;
    $.ajax({
        type: "GET",
        url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid2.php',
        data: ({ term : id}),
        dataType: "html",
        //line added to get ajax response in sync
        async: false,
        success: function(data) {
            //line added to save ajax response in var result
            result = data;
        },
        error: function() {
            alert('Error occured');
        }
    });
    //line added to return ajax response
    return result.trim();

}
</script>
<script>

              // create an array
var clientkp = [];



function showfor2()
{
    
              // create an array
var html = "";
var KODSEKOLAH = "JBD2047";
    for (i = 0; i < clientkp.length; i++) { 
      html += (i+1) + " : [ "+clientkp[i]+" ] " +showUser(clientkp[i])+ " <button type='button' onclick='del2("+i+");'><i class='fa fa-trash-o'></i></button><br>";
    }

  $("#modal-body").html(html);
  $("#myModalx").modal();
}   


function showfor()
{
              // create an array
  var KODSEKOLAH = "JBD2047";
  var html="<button onclick='showfor2();' class='btn btn-primary btn-lg btn-block' type='button'><i class='fa fa-user'></i> "+clientkp.length + " MURID YANG DIPILIH</button>";

    for (i = 0; i < clientkp.length; i++) { 
      html += '<input type="hidden" name="s_klien[]" value="'+clientkp[i]+'">';
    }

document.getElementById("forr").innerHTML = html;
}





function addcari2(data)
{     
    
              //alert (chk.checked);            // get the input value
                 // var txt = document.getElementById('txt').value;
                  // add the value to the array
  
    var index = clientkp.indexOf(data);              
                   // if the element exist
    if(index !== -1 )
    {    
                       // remove the element from the array
                       // splice(start index, count)
                     //   clientkp.splice(index ,1);
    }
    else
    {             
    clientkp.push(data);
    }
}



function addcari(chk,data)
{     
   // alert(data);
              //alert (chk.checked);            // get the input value
                 // var txt = document.getElementById('txt').value;
                  // add the value to the array
    if (chk.checked)
    {
          var index = clientkp.indexOf(data);
                   // if the element exist
          if(index !== -1 )
          {}
          else
          {
          clientkp.push(data);
          }

    document.getElementById('carian').innerHTML = "";
    showfor(); 
    }
    else
    {
    var index = clientkp.indexOf(data);
             // if the element exist
    del(index);
    }
    
    
    
}
function addcari2(data)
{     
   //alert(data);
              //alert (chk.checked);            // get the input value
                 // var txt = document.getElementById('txt').value;
                  // add the value to the array
  
          var index = clientkp.indexOf(data);
                   // if the element exist
          if(index !== -1 )
          {}
          else
          {
          clientkp.push(data);
          }

    document.getElementById('carian').innerHTML = "";
    showfor(); 
   //showfor2()
}


function cari()
{
  getmurid();
}
                     
function cicir()
{
  getcicir();
}




              // search and delete array element

function del(x)
{
  clientkp.splice(x,1);
  showfor();
}

function del2(x)
{

 clientkp.splice(x,1);
 showfor();
 showfor2();
}

function checked(x)
{
  var index = clientkp.indexOf(x);
  if(index!='-1'){
  return 'checked';
  }
}


        </script>






<script>





function chkall(source) {
    var checkboxes = document.querySelectorAll('input[name="checkbox_murid"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

function getmurid(){  
var txt = document.getElementById('txt').value;
var KODSEKOLAH="JBD2047";
      $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid.php',
          data: 'term='+txt +'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
           
              insDetails +='<div class="col-md-12 alert alert-warning  input-group bootstrap-timepicker"> <div class="col-md-offset-1">     Senarai Nama Carian<br>';
              $.each(json, function(i, data) {       
              insDetails +=' <button type="button" class="badge bg-info" onclick=addcari2("'+ data.nokp+'"); ><i class="fa fa-plus-square"></i>+</button>'+'['+data.nokp+']'+data.nama+'<br>';
                });
              insDetails +='</div><div>';
            }
            else
            {
               var insDetails = 'no data';

            }
                //document.getElementById('carian').innerHTML = "dsa";

            document.getElementById('carian').innerHTML = insDetails;
          }
        });

      }

function getcicir(){  
var txt = document.getElementById('txt').value;
var KODSEKOLAH="JBD2047";
      $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_cicir.php',
          data: 'term='+txt +'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
           
             insDetails +='<div class="col-md-12 alert alert-warning  input-group bootstrap-timepicker"> <div class="col-md-offset-1">     Senarai Nama Carian Cicir/Berisiko Cicir<br>';
              $.each(json, function(i, data) {       
              insDetails +=' <button type="button" class="badge bg-info" onclick=addcari2("'+ data.nokp+'"); ><i class="fa fa-plus-square"></i></button>'+'['+data.nokp+']'+data.nama+'<br>';
                });
               insDetails +='</div><div>';
            }
            else
            {
               var insDetails = 'no data';

            }
                //document.getElementById('carian').innerHTML = "dsa";

            document.getElementById('carian').innerHTML = insDetails;
          }
        });

      }
function getmurid2(kelass,tingkatanv){
var kelas = $(kelass).attr("data-id");
var tingkatan = tingkatanv.value;
var txt ='';
var KODSEKOLAH="JBD2047";
if (tingkatanv.checked){

        $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid2.php',
          data: 'kelas='+kelas +'&tingkatan='+tingkatan+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
         

              insDetails +='<center><input type="checkbox" data-id="'+kelas+'" value="'+tingkatan+'" onclick=getkelas(this,this); name="checkbox" id="select_all"  />Select All</center><br>';
              $.each(json, function(i, data) {
              var index = clientkp.indexOf(data.nokp);
              insDetails +=' <input  type="checkbox" ' +checked(data.nokp)+' onclick=addcari(this,"'+ data.nokp+'"); name="checkbox_murid" id="checkbox_murid"  />&nbsp;&nbsp;&nbsp;'+'['+data.nokp+'] '+data.nama+' <br>';
               
                });


              //insDetails +='<br><center><button type="button" class = "close" data-dismiss = "modal" >Teruskan</button></center><div>';
              }
              else
              {
                var insDetails = 'no data';

              }
                //document.getElementById('carian').innerHTML = "dsa";

                $("#modal-body").html(insDetails);

                $("#myModalx").modal();
          }
        });

}
else
{

          $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid2.php',
          data: 'kelas='+kelas +'&tingkatan='+tingkatan+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              $.each(json, function(i, data) {
               var index = clientkp.indexOf(data.nokp);
                   
                   // if the element exist
                             if(index !== -1 )
          {del(index);}
          else
          {
          //clientkp.push(data);
          }
                
                });
  
            }
          showfor(); 
          }
        });
}

      }

function getkelas(kelass,tingkatanv){
chkall(tingkatanv);
var kelas = $(kelass).attr("data-id");
var tingkatan = tingkatanv.value;
var KODSEKOLAH="JBD2047";
if (tingkatanv.checked){


        $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid2.php',
          data: 'kelas='+kelas +'&tingkatan='+tingkatan+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){

           

              $.each(json, function(i, data) {

              addcari2(data.nokp);

               
              });
  
          }
                //document.getElementById('carian').innerHTML = "dsa";

              showfor(); 


          }
    });


}
else
{

          $.ajax({
          type: 'GET',
          url: '/ppdkluang/cpanel/sekolah/spp2/sppv/test/get_murid2.php',
          data: 'kelas='+kelas +'&tingkatan='+tingkatan+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){

           

              $.each(json, function(i, data) {


               var index = clientkp.indexOf(data.nokp);
                   
                   // if the element exist
del(index);
                });
  
            }
                //document.getElementById('carian').innerHTML = "dsa";

showfor(); 


          }
        });
 
}

      }






</script>
<style>
  .tab {
     display: none;
 }
 .tab.active {
     display: table;
    margin: 10px 0;
    width: 100%;

 }

   .bt {
     display: none;
 }
 .bt.active {
     display: table;
    margin: 10px 0;
    width: 100%;
 }
</style>

<?php 


 
$connect = new PDO("mysql:host=localhost;dbname=ppdkluang", "root", "")or die ("Pengkalan Data Tidak Dapat Dipilih.");



$_SESSION['KODSEKOLAH']='JBD2047';
function fill_tingkatan($connect,$id)
{ 





$output ='<table><tr>';

  $output .= '<td><div class="alert alert-info  col-xs-6 col-md-3">SM<br>';
  $output .= ''.fill_kelas($connect,SM).'';
   $output .= '</div></td>';
   
     $output .= '<td><div class="alert alert-info  col-xs-6 col-md-3">SK<br>';
  $output .= ''.fill_kelas($connect,'SK').'';
   $output .= '</div></td>';
   
  $output .= '<td><div class="alert alert-info  col-xs-6 col-md-3">SJK(T)<br>';
  $output .= ''.fill_kelas($connect,'SJK(T)').'';
   $output .= '</div></td>';
   
     $output .= '<td><div class="alert alert-info  col-xs-6 col-md-3">SJK(C)<br>';
  $output .= ''.fill_kelas($connect,'SJK(C)').'';
   $output .= '</div></td>';
$output .='</tr></table>';   
  //$output .= '</table>';
 return $output;
}
function fill_kelas($connect,$id)
{ 
 $output = '';
 //$query = "select * from `murid` where kodsekolah='$_SESSION[KODSEKOLAH]' and tingkatan='$id' group by nama_kelas ";
   $query = "select *,SUBSTRING(NamaSekolah, 4) a from `tssekolah` where NamaSekolah like '$id%'  ";
 
 
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {

    $output .= '<button type="button" class="badge bg-info" onclick=addcari2("'. $row["KodSekolah"].'"); ><i class="fa fa-plus-square"></i>+</button>'.'['. $row["KodSekolah"].']'. $row["a"].'<br>';

 }
 return $output;
}

?>


<form method=post>


           <div class="row mt">
          <!--  DATE PICKERS -->
          <div class="col-lg-12">
            <div class="form-panel">
              <div  class="form-horizontal style-form">
                <div class="form-group">
                                         <div class="col-md-8 col-md-offset-2">
                   
<div id="forr" ></div>

                       

                  
                  </div>
                </div>
                <div class="form-group">
  <div class="col-md-8 col-md-offset-2">
                    <div class="input-group bootstrap-timepicker">
                       
                    <input class="form-control form-control-inline input-medium " size="16" name="txt" id="txt"  placeholder="Carian No KP/Nama" type="text" value="">
                  
                

                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="cari();"><i class="fa fa-search"></i> Cari</button>
                        

                        
                        </span>




                    </div>

                    <p  id="carian"></p>
                  </div>
                </div>



                <div class="form-group bt active" id="bt" >
    <div class="col-md-8 col-md-offset-2">
<button onclick="aktif();"  type="button" class="btn btn-primary btn-lg btn-block">Carian Kelas</button>
                  </div>
                </div>
                
                <div class="form-group tab" id="tab1" >
    <div class="col-md-8 col-md-offset-2">




<button type="button" onclick="daktif();" class="btn btn-primary btn-lg btn-block">Tutup Carian Kelas</button>

<?php echo fill_tingkatan($connect,0); ?>

                  </div>
                </div>

                <div class="form-group"  >
    <div class="col-md-8 col-md-offset-2">

<input class="form-control form-control-inline input-medium " required=required id="datepicker" name="tarikh" autocomplete="off" placeholder="Tarikh" type="text" value="">



<textarea  name="catatan" rows="4" cols="50"></textarea>


                  </div>
                </div>




              </div>
            </div>
       
            <!-- /form-panel -->
          </div>  
</div>
        





<script type="text/javascript"> 
showfor();

</script>



              <div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Senarai Murid</h4>
                    </div>
                    <div class="modal-body" id="modal-body">
                      Papar
                    </div>
                    <div class="modal-footer">
                      
                      <!--<button type="button" class="btn btn-primary" >Cancel</button>-->
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Teruskan</button>
                    </div>
                  </div>
                </div>
              </div>

<button type="submit" class="btn btn-primary" data-dismiss="modal">hantar</button>

</form>
</div><!-- /.modal -->

<script>

function  aktif(){
document.getElementById('carian').innerHTML = "";
    document.getElementById("tab1").className+=" active";
    document.getElementById("bt").className="bt";

}

function  daktif(){

    document.getElementById("tab1").className="tab";
     document.getElementById("bt").className+=" active";

}



</script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
