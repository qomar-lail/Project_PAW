<?php
require_once __DIR__. "../../Model/sekolah_model.php";

function sekolah_index(){
    $ls_data = ambil_data_sekolah();
    include "View/user/sekolah_view.php";
}

?>