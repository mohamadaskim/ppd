<!DOCTYPE html>
<html>
    <head>
        <title>JavaScript: Add - Search - Remove Array Element</title>
        <meta charset="iso-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

       <script>













function showUser(id) {
   //line added for the var that will have the result

    var result = false;
    $.ajax({
        type: "GET",
        url: 'get_murid2.php',
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



   


function showfor()

{

              // create an array
    document.getElementById("forr").innerHTML = "";
var KODSEKOLAH = "JEA8001";

for (i = 0; i < clientkp.length; i++) { 
   document.getElementById("forr").innerHTML += (i+1) + " : [ "+clientkp[i]+" ] " +showUser(clientkp[i])+ " <button  onclick='del("+i+");'>Padam</button><br>";




}


}







              function addcari(data)
              {
                   // get the input value
                 // var txt = document.getElementById('txt').value;
                  // add the value to the array
                  clientkp.push(data);
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













        </script>


    </head>
    <body>


</head>
<body>
<script>

     function getmurid(){

    
 var txt = document.getElementById('txt').value;
var KODSEKOLAH="JEA8001";

        $.ajax({
          type: 'GET',
          url: 'get_murid.php',
          data: 'term='+txt +'&KODSEKOLAH='+KODSEKOLAH,
          dataType: 'json',
          success : function(json) {
            if(json){
              var insDetails = '';
           
              insDetails +='<div class="scrollbar" >      Senarai Nama Carian<br>';
              $.each(json, function(i, data) {
                
                  //logo path
  
  //  alert(isi) ;          
insDetails +=' <button onclick=addcari("'+ data.nokp+'"); >Tambah</button>'+'['+data.nokp+']'+data.nama+'<br>';
               
                });
              insDetails +='<div>';
            }else{
                var insDetails = 'no data';

            }
                //document.getElementById('carian').innerHTML = "dsa";

 document.getElementById('carian').innerHTML = insDetails;
          }
        });

      }

</script>
<table width="40%" height="125" border="1" align="center">
    <tr>
    <td height="42" bgcolor="#00CC00">      Senarai Nama Murid
  <div id="forr" ></div></td>
  </tr>
  <tr>     
    <td height="26" align="center">
      <input type="text" name="txt" id="txt"/>
      <input type="submit"  onclick="cari();" name="button" id="button" value="Cari No K/P atau Nama">
   

    </td>
  </tr>
  <tr>
    <td height="23" align="left" bgcolor="#33CCCC">       <p id="carian"></p></td>
  </tr>

</table>
<script type="text/javascript"> 
showfor();

</script>
    </body>
</html>