<?php
require_once __DIR__ . "/../../Model/admin/sekolah_model_admin.php";
require_once __DIR__ . "/crud/crud_sekolah_controller.php";

function sekolah_index_admin(){
    $action = $_GET['action'] ?? 'index';
    $msg    = $_GET['msg'] ?? '';
    $error  = '';

    crud_sekolah_handle($action, $error);

    if (isset($_GET["cari"]) && trim($_GET["cari"]) !== "") {
        $ls_data_sekolah = ambil_data_detail_sekolah($_GET["cari"]);
    } else {
        $ls_data_sekolah = ambil_data_detail_sekolah();
    }

    $edit_data = null;
    if ($action === 'edit') {
        $id = (int)($_GET['id'] ?? 0);
        $edit_data = ambil_sekolah_by_id($id);
        if (!$edit_data) {
            $action = 'index';
            $msg = 'notfound';
        }
    }

    $_SESSION["halaman"] = "Sekolah";
    $active = 'sekolah';
    $pageTitle = 'Sekolah';

    require __DIR__ . "/../../View/admin/sekolah_view_admin.php";
}
