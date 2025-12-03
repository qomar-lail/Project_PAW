<?php
require_once __DIR__. "../../../Model/user/pengguna_model_user.php";

function pengguna_index(){
    $ls_data = ambil_data_pengguna();
    include "View/user/pengguna_view_user.php";
}

?>