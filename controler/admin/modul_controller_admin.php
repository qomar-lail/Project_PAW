<?php
require_once __DIR__ . "/../../Model/admin/modul_model_admin.php";
require_once __DIR__ . "/crud/crud_modul_controller.php";

function modul_index_admin(){
    session_start();
    $_SESSION["halaman"] = "Modul";

    $action = $_GET['action'] ?? 'index';
    $msg    = $_GET['msg'] ?? '';
    $error  = '';

    crud_modul_handle($action, $error);

    if (isset($_GET["cari"]) && trim($_GET["cari"]) !== "") {
        $ls_data_modul = ambil_data_detail_modul($_GET["cari"]);
    } else {
        $ls_data_modul = ambil_data_detail_modul();
    }

    $edit_data = null;
    if ($action === 'edit') {
        $id = (int)($_GET['id'] ?? 0);
        $edit_data = ambil_modul_by_id($id);
        if (!$edit_data) {
            $action = 'index';
            $msg = 'notfound';
        }
    }

    $active = 'modul';
    $pageTitle = 'Modul';

    require __DIR__ . "/../../View/admin/modul_view_admin.php";
}
