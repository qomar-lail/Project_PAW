<?php
require_once __DIR__ . "/../../../Model/admin/crud/crud_pengguna_model_admin.php";

function crud_pengguna_handle($action, &$error){
    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = crud_pengguna_create();
    }

    if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_GET['id'] ?? 0);
        $error = crud_pengguna_update($id);
    }

    if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['id'] ?? 0);
        crud_pengguna_delete($id);
    }
}
