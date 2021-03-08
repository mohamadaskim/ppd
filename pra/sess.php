<?php 
session_start();

//ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
//session_set_cookie_params(3600);


if((isset($_SESSION['SESS_USERNAME']) && $_SESSION['SESS_USERNAME']=='')||(empty($_SESSION['SESS_USERNAME']))){
    
    
        if(isset($_COOKIE["SESS"])&&$_COOKIE["SESS"]!='')
{
    // echo " lepas tu run";
   // echo $_COOKIE["SESS"];
        $conn=mysqli_connect("localhost","mgkkjoho_kaunsel","areyang");
        $dbb=mysqli_select_db($conn,"mgkkjoho_var");
    $sess=$_COOKIE["SESS"];
           $sql = "SELECT u.*,n.select_db2 FROM mgkkjoho_var.users u inner join mgkkjoho_var.tknegeri n on n.kodnegeri=u.kodnegeri WHERE md5(username) = '$sess' limit 1";
        $result = mysqli_query($conn,$sql);
        
        
        
        $count = mysqli_num_rows($result);
        

        
        if($count==1){
                 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $userlevel = $row['userlevel'];
        $userlevel2 = $row['userlevel2'];
        $realname = htmlspecialchars($row['realname']);
        $myusername = $row['username'];
$negeri=$row['kodnegeri']; 
    
             session_regenerate_id();
         $_SESSION['SESS_USERNAME'] = $myusername;
         $_SESSION['SESS_USERLEVEL'] = $userlevel;
         $_SESSION['SESS_KODSEKOLAH'] = $row['kodsekolah']; 
         $_SESSION['SESS_REALNAME'] = $realname;
         $_SESSION['SESS_NEGERI']=intval($row['kodnegeri']);
         $_SESSION['SESS_NEGERI2']=$row['kodnegeri'];
         $_SESSION['SESS_DB']=$row['select_db2'];
         
         
         //$_SESSION['SESS_NEGERI2']=$row['kodnegeri'];
         $logtime = time();
         $ip=$_SERVER['REMOTE_ADDR'];
        // mysqli_query($conn,"UPDATE mgkkjoho_var.users SET timestamp = '$logtime',lastlogin = now(), lastip = '$ip' WHERE username = '$myusername'");

         //if($userlevel==10) { $_SESSION['SESS_KODSEKOLAH'] = $row['kodsekolah']; session_write_close(); header("location: /e/"); }   
            
        }
        



    
}
  else 
  {
               header("location: ../pra/login");
    exit;   
  }






}


if((isset($_SESSION['SESS_USERNAME']) && $_SESSION['SESS_USERNAME']=='')||(empty($_SESSION['SESS_USERNAME']))){
    
    
  
    
            header("location: ../pra/login");
    exit;





}




if(isset($_SESSION['SESS_USERNAME']) && $_SESSION['SESS_USERLEVEL']>30){
             if($_SESSION['SESS_USERLEVEL']==90) {  header("location: /erekodv2/admin_kpm.php"); }
                      if($_SESSION['SESS_USERLEVEL']==80) { header("location: /erekodv2/admin_jpn.php"); }
             if($_SESSION['SESS_USERLEVEL']==50) { header("location: /erekodv2/admin_ppd.php"); }


    
    exit;

}

if((isset($_SESSION['SESS_KODSEKOLAH']) && $_SESSION['SESS_KODSEKOLAH']=='')||(empty($_SESSION['SESS_KODSEKOLAH']))){
    
    
  
    
            header("location: ../pra/login/logout.php");
    exit;





}



include 'db.php'; 

@$username = $_SESSION['SESS_USERNAME']; @$userlevel=$_SESSION['SESS_USERLEVEL']; @$realname=$_SESSION['SESS_REALNAME']; @$kodsekolah=$_SESSION['SESS_KODSEKOLAH']; 

if(isset($_SESSION['SESS_USERNAME'])){
    define('USER',$_SESSION['SESS_USERNAME']);
}

//session_write_close();


?>