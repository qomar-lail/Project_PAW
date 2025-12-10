<?php
if (!isset($conn)) {
    if (file_exists(__DIR__ . "/../../Model/koneksi.php")) {
        include_once __DIR__ . "/../../Model/koneksi.php";
    } elseif (file_exists(__DIR__ . "/../../koneksi.php")) {
        include_once __DIR__ . "/../../koneksi.php";
    } else {
        $conn = mysqli_connect("localhost", "root", "", "diary_learning_db");
    }
}

require_once __DIR__ . "/../../Model/user/sekolah_model_user.php";

function sekolah_index(){
    $ls_data = ambil_semua_sekolah();

    $id_sekolah = isset($_GET["id"]) ? $_GET["id"] : null;
    $ls_data_detail = ambil_siswa_sekolah($id_sekolah);

    include "View/user/sekolah_view_user.php";
}
?>