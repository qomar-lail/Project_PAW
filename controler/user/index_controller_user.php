<?php
session_start();
require_once __DIR__ . "../../../Model/user/dashboard_model_user.php";

function dasboard_user(){
    if(!isset($_SESSION["login"])){
        header("location:form_login.php");
        exit;
    }
    $data_bukan_siswa = ambil_bukan_siswa(); 
    $data_siswa = ambil_data_siswa(); 
    require_once __DIR__ . "../../../View/user/dasboard_view_user.php";
}


?>