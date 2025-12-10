<?php
require_once __DIR__ . "/../../Model/admin/pengguna_model_admin.php";
require_once __DIR__ . "/crud/crud_pengguna_controller.php";

function pengguna_index_admin(){
    session_start();
    $_SESSION["halaman"] = "Pengguna";

    $action = $_GET['action'] ?? 'index';
    $msg    = $_GET['msg'] ?? '';
    $error  = '';

    crud_pengguna_handle($action, $error);

    if (isset($_GET["cari"]) && trim($_GET["cari"]) !== "") {
        $ls_data_pengguna = ambil_data_detail_pengguna($_GET["cari"]);
    } else {
        $ls_data_pengguna = ambil_data_detail_pengguna();
    }

    $sekolah_list = ambil_opsi_sekolah();

    $edit_data = null;
    if ($action === 'edit') {
        $id = (int)($_GET['id'] ?? 0);
        $edit_data = ambil_pengguna_by_id($id);
        if (!$edit_data) {
            $action = 'index';
            $msg = 'notfound';
        }
    }

    $active = 'pengguna';
    $pageTitle = 'Pengguna';
    require __DIR__ . "/../../View/admin/pengguna_view_admin.php";
}
