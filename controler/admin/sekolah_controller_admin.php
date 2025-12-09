<?php
require_once __DIR__. "../../../Model/admin/sekolah_model_admin.php";

function sekolah_index_admin(){
    $ls_data_sekolah = [];
    if(isset($_GET["cari"]) && $_GET["cari"] !== " "){
        echo "masuk sini";
        $ls_data_sekolah = ambil_data_detail_sekolah($_GET["cari"]);
    }else{
        $ls_data_sekolah = ambil_data_sekolah();
    }
    include "../Project_PAW/View/admin/sekolah_view_admin.php";
}


?>