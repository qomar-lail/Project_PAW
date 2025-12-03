<?php
require_once __DIR__. "../../../Model/user/sekolah_model_user.php";

function sekolah_index(){
    $ls_data = ambil_data_sekolah();
    include "../Project_PAW/View/user/sekolah_view_user.php";
}

?>