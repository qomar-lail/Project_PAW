<?php
require_once __DIR__. "../../../Model/user/sekolah_model_user.php";
session_start();

function sekolah_index(){
    if(!isset($_SESSION["login"])){
        header("location:form_login.php");
        exit;
    }  
    $ls_data = ambil_data_sekolah();
    if(isset($_GET["id"])){
        $ls_data_detail = ambil_data_detail_sekolah($_GET["id"]);
    }
    include "../Project_PAW/View/user/sekolah_view_user.php";
}

?>