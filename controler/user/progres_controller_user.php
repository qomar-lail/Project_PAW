<?php
require_once __DIR__. "../../../Model/user/progres_model_user.php";
session_start();
function progres_index(){
    $ls_data = ambil_data_progres($_SESSION["id"]);
    include "View/user/progres_view_user.php";
}

?>