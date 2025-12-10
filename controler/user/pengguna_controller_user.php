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

require_once __DIR__ . "/../../Model/user/pengguna_model_user.php";

function pengguna_index(){
    $ls_data = ambil_data_pengguna();
    include "View/user/pengguna_view_user.php";
}
?>