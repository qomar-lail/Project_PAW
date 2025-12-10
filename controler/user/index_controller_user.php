<?php
session_start();
require_once __DIR__ . "../../../Model/user/dashboard_model_user.php";
function dasboard_user(){

    if(!isset($_SESSION["login"])){
        header("location:form_login.php");
        exit;
    }   
    require_once __DIR__ . "../../../View/user/dasboard_view_user.php";
}


?>