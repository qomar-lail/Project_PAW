<?php
require_once __DIR__. "../../../Model/user/pengguna_model_user.php";
session_start();
function pengguna_index(){
    if(!isset($_SESSION["login"])){
        header("location:form_login.php");
        exit;
    }  
    $ls_data = ambil_data_pengguna();
    include "View/user/pengguna_view_user.php";
}

?>