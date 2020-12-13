<?php
require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/auth/auth.php");
//session_start();
if(defined('USER')) {
    require($_SERVER['DOCUMENT_ROOT']."/ppdkluang/dbcon/ppd.php");
    $chk = USER;
    $kuri = $PPD->query("SELECT realname,userlevel,gambar,jawatan,sektor FROM users WHERE username='{$chk}' LIMIT 1");
    $data = $kuri->fetch();
    if(!$data){
        $kuri = $PPD->query("SELECT realname,userlevel FROM users_sekolah WHERE username='{$chk}' LIMIT 1");
        $data = $kuri->fetch();
    }
    define('LEVEL',$data['userlevel']);
    define('NAMA',$data['realname']);
    if(LEVEL>49){
        define('JAWATAN',$data['jawatan']);
        define('GAMBAR',$data['gambar']);
        define('SEKTOR',$data['sektor']);
    }
    unset($data);
}