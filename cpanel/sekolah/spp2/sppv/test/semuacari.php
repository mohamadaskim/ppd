<?php session_start(); include 'db.php'; @$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; @$namasekolah=$_SESSION['SESS_NAMASEKOLAH']; ?>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

       <script>











function showUser(id) {
   //line added for the var that will have the result

    var result = false;
    $.ajax({
        type: "GET",
        url: 'test/get_murid2.php',
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
var KODSEKOLAH = "<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
    for (i = 0; i < clientkp.length; i++) { 
      html += (i+1) + " : [ "+clientkp[i]+" ] " +showUser(clientkp[i])+ " <button type='button' onclick='del2("+i+");'>X</button><br>";
    }

  $("#modal-body").html(html);
  $("#myModalx").modal();
}   


function showfor()
{
              // create an array
  var KODSEKOLAH = "<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
  var html="Jumlah Murid dipilih : "+clientkp.length + "<button onclick='showfor2();' type='button'>Papar</button>";

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
   
}


function cari()
{
  getmurid();
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

<link rel="stylesheet" type="text/css" href="test/css3.css">




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
var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
      $.ajax({
          type: 'GET',
          url: 'test/get_murid.php',
          data: 'term='+txt +'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
           
              insDetails +='<div class="scrollbar" >      Senarai Nama Carian<br>';
              $.each(json, function(i, data) {       
              insDetails +=' <button type="button" onclick=addcari2("'+ data.nokp+'"); >Tambah</button>'+'['+data.nokp+']'+data.nama+'<br>';
                });
              insDetails +='<div>';
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
var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
if (tingkatanv.checked){

        $.ajax({
          type: 'GET',
          url: 'test/get_murid2.php',
          data: 'kelas='+kelas +'&tingkatan='+tingkatan+'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
         

              insDetails +='<div class="scrollbar" style="padding: 5px;"><center><input type="checkbox" data-id="'+kelas+'" value="'+tingkatan+'" onclick=getkelas(this,this); name="checkbox" id="select_all"  />Select All</center><br>';
              $.each(json, function(i, data) {
              var index = clientkp.indexOf(data.nokp);
              insDetails +=' <input  type="checkbox" ' +checked(data.nokp)+' onclick=addcari(this,"'+ data.nokp+'"); name="checkbox_murid" id="checkbox_murid"  />&nbsp;&nbsp;&nbsp;'+'['+data.nokp+'] '+data.nama+' <br>';
               
                });


              insDetails +='<div>';
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
          url: 'test/get_murid2.php',
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
          showfor(); 
          }
        });
}

      }

function getkelas(kelass,tingkatanv){
chkall(tingkatanv);
var kelas = $(kelass).attr("data-id");
var tingkatan = tingkatanv.value;
var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
if (tingkatanv.checked){


        $.ajax({
          type: 'GET',
          url: 'test/get_murid2.php',
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
          url: 'test/get_murid2.php',
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
     display: block;
 }

   .bt {
     display: none;
 }
 .bt.active {
     display: block;

 }
</style>

<?php 

$connect = new PDO("mysql:host=localhost;dbname=mgkkjoho_kaunseling", "mgkkjoho_kaunsel", "areyang")or die ("Pengkalan Data Tidak Dapat Dipilih.");
session_start();
$_SESSION['KODSEKOLAH']=$_SESSION['SESS_KODSEKOLAH'];
function fill_tingkatan($connect,$id)
{ 
 $output = '';
 $query = "select * from `murid` where kodsekolah='$_SESSION[KODSEKOLAH]' group by tingkatan order by tingkatan desc ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<div class="col-lg-4 "><table border=1 width="100%"><tr><td>'.$row["tingkatan"].'<ul>';
  $output .= ''.fill_kelas($connect,$row["tingkatan"]).'';

     $output .= '</ul></td></tr></table></div>';

 }
 return $output;
}
function fill_kelas($connect,$id)
{ 
 $output = '';
 $query = "select * from `murid` where kodsekolah='$_SESSION[KODSEKOLAH]' and tingkatan='$id' group by nama_kelas ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {

    $output .= '<input type="checkbox" data-id="'.$row["nama_kelas"].'" value="'.$id.'" onclick=getmurid2(this,this); name="checkbox" id="checkbox" /><font onclick="getmurid2(0);">   '.$row["nama_kelas"].'</font><br>';

 }
 return $output;
}

?>

<table width="600" height="125" border="1" align="center">
    <tr>
    <td height="42" bgcolor="#00CC00">      
  <div id="forr" ></div></td>
  </tr>
  <tr>     
    <td height="26" align="center">
      <input type="text" name="txt" id="txt"/>
      <button type='button' onclick="cari();">
   Cari No K/P atau Nama</button>

    </td>
  </tr>
  <tr >
    <td height="23" align="left" bgcolor="#33CCCC">       <p  id="carian"></p></td>
  </tr>



      <tr id="bt" class="bt active" >
    <td width="600" align="left" bgcolor="#33CCCC"><center><button type='button'  onclick="aktif();"  >Carian Kelas</button></center></td>
  </tr>
    <tr  id="tab1" class="tab" >
    <td height="23" align="left" bgcolor="#33CCCC"><center><button type='button'  onclick="daktif();"  >Tutup Carian Kelas</button></center><div class="row">
    <?php echo fill_tingkatan($connect,0); ?>

  </div></td>
  </tr>

</table>

<script type="text/javascript"> 
showfor();

</script>






<div class = "modal fade" id = "myModalx" tabindex = "-1" role = "dialog" aria-hidden = "true">
  
   <div class = "modal-dialog" s>

      <div class = "modal-content">
        <center><h3>Senarai</h3></center>
                       <div style="  padding-top: 10px;
  padding-right: 30px;
  padding-bottom: 30px;
  padding-left: 80px;" id = "modal-body">
        
         </div>
      <span  class = "close" data-dismiss = "modal" style ="    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;"  title="Close PopUp">&times;</span>

  

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

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