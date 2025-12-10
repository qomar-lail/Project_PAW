<?php
require_once __DIR__. "../../../Model/user/sekolah_model_user.php";
session_start();

function sekolah_index(){
    if(!isset($_SESSION["login"])){
        header("location:form_login.php");
        exit;
    }  
    $ls_data = ambil_semua_sekolah();

    $id_sekolah = isset($_GET["id"]) ? $_GET["id"] : null;
    $ls_data_detail = ambil_siswa_sekolah($id_sekolah);

    include "View/user/sekolah_view_user.php";
}

?>