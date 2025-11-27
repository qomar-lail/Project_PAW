<?php
require_once __DIR__. "../../Model/pengguna_model.php";

function pengguna_index(){
    $ls_data = ambil_data_pengguna();
    include "View/user/pengguna_view.php";
}

?>