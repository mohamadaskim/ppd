

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
    $page = 'inbox';
    include($_SERVER['DOCUMENT_ROOT']."/ppdkluang/cpanel/sekolah/header.php");


       

        $view = '2';



    if(isset($_GET['tahun'])){
        $tahunq = htmlspecialchars($_GET['tahun']);
    } else {
        $tahunq = date('Y');
    }

    if(isset($_GET['page'])){
        $page = htmlspecialchars($_GET['page']);
        $offset = (htmlspecialchars($_GET['page'])*20)-20;
    } else {
        $offset = 0;
        $page = 1;
    }

    $sektor = '%%';
    $pegawai = '%%';
    $tahun = '%'.$tahunq.'%';
    $edaran = '%%';
    $keyword = '%%';
    
    if($view=='primary'){
        $baca = '=';
    } else if($view=='telahbaca') {
        $baca = '<>';
    } else if($view=='search') {
        $sektor = ($_GET['sektor']=='all'?'%%':'%'.$_GET['sektor'].'%');
        $pegawai = ($_GET['pegawai']==''?'%%':'%'.$_GET['pegawai'].'%');
        $tahun = ($_GET['tahun']=='all'?'%%':'%'.$_GET['tahun'].'%');
        $keyword = ($_GET['keyword']==''?'%%':'%'.$_GET['keyword'].'%');
    } else if($view=='edaran') {
        $edaran = '%'.$_GET['edaran'].'%';
        $tahun = '%%';
    }

    if($view=='2'||$view=='telahbaca'){
        include 'proc/query-normal.php';
    } else if($view=='padam') {
        include 'proc/query-padam.php';
    } else {
        include 'proc/query-search.php';
    }
    
    $jumpage = ceil($kaun/20);

    $kuri = $PPD->prepare("SELECT COUNT(*) AS bil FROM sts2020 WHERE kodsekolah = ? and status=0");
    $kuri->execute([USER]);
    $xbaca = $kuri->fetch(PDO::FETCH_ASSOC)['bil'];

//$m='08';
$months = array (1=>'Januari',2=>'Februari',3=>'Mac',4=>'April',5=>'Mei',6=>'Jun',7=>'Julai',8=>'Ogos',9=>'September',10=>'Oktober',11=>'November',12=>'Disember');
//echo $months[(int)$m];


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scriptable &gt; Line | Chart.js sample</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>




<div class="main">
    
    <h3 class="card mt-4 font-weight-bold p-2 text-center bg-dark text-light">SENARAI SIJIL PENGUJIAN DAN PENTAULIAHAN</h3>
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
</div>
<input type="hidden" id="status" value="<?= $_GET['status']??'no' ?>">

<!-- START FOOTER -->
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js" integrity="sha256-/7FLTdzP6CfC1VBAj/rsp3Rinuuu9leMRGd354hvk0k=" crossorigin="anonymous"></script>
    <script src="cpanel/js/global.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        
        let stat = $('#status').val();
        if(stat!='no'){
            if(stat=='unread'){alert('Surat telah ditetapkan kepada status belum baca. Bil baca dan bil muat turun telah ditetapkan semula kepada 0.');}
            window.location.replace("cpanel/sekolah/inbox/");
        }
        $('#btn-cari').click(function(e){
            let a = $('#keyword').val();
            let b = $('#pegawai').val();
            let c = $('#tapis-tahun').val();
            let d = $('#sektor').val();
            if(a==''&&b==''&&c=='all'&&d=='all'){
                alert('Sila isi sekurang-kurangnya carian kata kunci atau pegawai, atau buat pilihan sektor atau tahun.');
                e.preventDefault();
            }
        })
    </script>




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
      html += (i+1) + " : [ "+clientkp[i]+" ] " +showUser(clientkp[i])+ " <button type='button' onclick='del2("+i+");'><i class='fa fa-trash-o'></i></button><br>";
    }

  $("#modal-body").html(html);
  $("#myModalx").modal();
}   


function showfor()
{
              // create an array
  var KODSEKOLAH = "<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
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
var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
      $.ajax({
          type: 'GET',
          url: 'test/get_murid.php',
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
var KODSEKOLAH="<?php echo $_SESSION['SESS_KODSEKOLAH']; ?>";
      $.ajax({
          type: 'GET',
          url: 'test/get_cicir.php',
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
          url: 'test/get_murid2.php',
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



  </body>

</html>