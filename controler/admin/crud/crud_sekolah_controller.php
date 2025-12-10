<?php
require_once __DIR__ . "/../../../Model/admin/crud/crud_sekolah_model_admin.php";

function crud_sekolah_handle($action, &$error){
    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = crud_sekolah_create();
    }

    if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_GET['id'] ?? 0);
        $error = crud_sekolah_update($id);
    }

    if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['id'] ?? 0);
        crud_sekolah_delete($id);
    }
}
